<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Event;
use App\Invoice;
use App\Item;
use App\Jobs\SendAttachmentUploadedAdminEmail;
use App\Jobs\SendAttachmentUploadedEmail;
use App\Jobs\SendBookingApprovedEmail;
use App\Jobs\SendBookingCreatedAdminEmail;
use App\Jobs\SendBookingCreatedEmail;
use App\Jobs\SendBookingDeclinedEmail;
use App\Jobs\SendWelcomeEmail;
use App\Notifications\NewBookingCreated;
use App\Notifications\NotifyAttachmentUploaded;
use App\Notifications\NotifyBookingApproved;
use App\Notifications\NotifyBookingDeclined;
use App\User;
use Auth;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use PDF;
use Storage;
use Validator;

class BookingController extends Controller
{
    // User Traits
//    use NotificationTraits;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->is_verified) {
            return redirect('/verification');
        }

        if(Gate::allows('admin')) {
            $bookings = Booking::paginate(10);
        }else{
            $bookings = Booking::where('user_id', Auth::id())->paginate(10);
        }


        return view('backend.bookings.index', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('admin')) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }
        $user = User::findOrFail($request['user']);
        $event = Event::where('id', $request['event'])->first();


        $reference = 'BO'.Carbon::now()->timestamp;
        if(Booking::where(['user_id' => $user->id, 'event_id' => $event->id])->first() == null){
            $booking=$user->bookings()->create([
                'reference' => $reference,
                'event_id' => $event->id,
                'status_is' => 'Pending'
            ]);

            //Notifications
            $user->notify(new NewBookingCreated($booking, $event));
            SendBookingCreatedEmail::dispatch($user, $booking, $event);
            SendBookingCreatedAdminEmail::dispatch($booking, $user);

            flash('Booking for '. $user->fullname .' was successful.', 'success');
        }else{
            flash( $user->fullname . ' is already booked for this event.', 'warning');
        }

        return back();
    }

    /**'
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //

        if(Gate::denies('owner-or-admin', $booking->user->id)) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }
        return view('backend.bookings.show', compact('booking'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        // Delete Booking

        if(Gate::denies('admin')) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }
        $booking->delete();
        flash('Booking has been deleted!', 'success');
        return back();
    }

    /**
     * Uploads attachments
     *
     * @param Request $request
     *
     */
    public function upload(Request $request, Booking $booking)
    {

        if(Gate::denies('owner-or-admin', $booking->user->id)) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        if($request['file'] == null){
            flash('Please select a file!', 'warning');
            return back();
        }
        $extension = $request->file->extension();
        $filename = Carbon::now()->timestamp.'.'.$extension;
        $path = 'users/'.$booking->event->id.'/'.$booking->user->id;

        $resource = $request->file('file')->storeAs($path, $filename, 'booking');

        if($booking->payment_img != null){
            Storage::disk('booking')->delete($path.'/'.$booking->payment_img);
        }
        $booking->update(['payment_img' => $filename, 'img_path' => $path]);

        //Notify Booking Owner via Email & Notification
        SendAttachmentUploadedEmail::dispatch($booking->user, $booking);
        $booking->user->notify(new NotifyAttachmentUploaded($booking));

        //Get Administrators
        $administrators = User::whereHas('role', function ($query) { $query->where('name', '=', 'admin'); })->get();

        //Notify info mail
        SendAttachmentUploadedAdminEmail::dispatch($booking);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function approve(Booking $booking)
    {
        //

        if(Gate::denies('admin')) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $user = User::findOrFail($booking->user_id);

        $booking->status_is = 'Approved';
        $booking->saveOrFail();

        $invoice = $this->add_invoice($booking);

        //ToDo Add System Settings: Delete Booking if declined


        // Notify user via Email, Notification
        SendBookingApprovedEmail::dispatch($user, $booking);
        $user->notify(new NotifyBookingApproved($booking));

        flash("Booking Approved, and " . $user->fullname . " has been notified!", "success");
        return back();
    }


    /**
     * Booking declined.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request, Booking $booking)
    {
        //


        if(Gate::denies('admin')) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $reason = $request['reason-'.$booking->id];

        $user = User::findOrFail($booking->user_id);

        $booking->status_is = 'Declined';
        $booking->saveOrFail();

        //ToDo Add System Settings: Delete Booking if declined


        // Notify user via Email, Notification
        SendBookingDeclinedEmail::dispatch($booking, $reason);
        $user->notify(new NotifyBookingDeclined($booking, $reason));

        flash("Booking declined, and " . $user->fullname . " has been notified!", "success");
        return back();
    }

    /**
     *
     *
     */
    public function add_invoice(Booking $booking)
    {

        // Create 'Paid' Invoice
        $invoice = Invoice::create([
            'user_id'=>$booking->user->id,
            'amount'=>$booking->event->item->price,
            'status_is'=>'Paid',
            'discount' => 0
        ]);

        $items = Item::where('id',$booking->event->item->id)->get();
        foreach ($items as $item) {
            $invoice->items()->attach($item->id, ['quantity' => 1, 'price' => $item->price]);
        }

        return $invoice;
    }

    /**
     *
     *
     *
     *
     *
     *
     */
    public function add_guest(Event $event)
    {

        if(Gate::denies('admin')) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $event = $event;
        $bookings = Booking::where('event_id', $event->id)->get();

        $guests = User::where(['status_is' => 'active', 'is_verified' => true])->orderBy('email', 'asc')->pluck('email', 'id');
        $listBtn = ['title'=>'Bookings', 'action' => 'bookings', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $listBtn);

        return view('backend.bookings.create', compact('event', 'bookings', 'guests', 'buttons'));
    }

    /**
     *
     *
     *
     *
     *
     *
     */
    public function save_guest(Request $request, Event $event)
    {


        if(Gate::denies('admin')) {
            flash('Unauthorized action attempt!');
            return redirect('/dashboard');
        }

        $user = null;

        //check which form submitted the request
        if($request->existing_user == 'false'){
            //add missing fields to request array
            $password = str_random(8);
            $request['is_verified'] = false;
            $request['status_is'] = 'inactive';
            $request['code'] = strtoupper(str_random(6));
            $request['displayname'] = $request->email;
            $request['password'] = bcrypt($password);

            //Add form validation rules
            $rules =[
                'firstname'      => 'required',
                'lastname'       => 'required',
                'displayname'    => 'unique:users',
                'contactnumber'  => 'required|numeric',
                'address'        => 'required',
                'town'           => 'required',
                'province'       => 'required',
                'postalcode'     => 'required|numeric',
                'email'          => 'email|unique:users'
            ];
            //Add form custom validation messages
            $messages = [
                'displayname.unique' => 'This Display Name is already taken.',
                'email.unique'       => 'Email address already exists'];
            //make the form validation against the request
            $validator = Validator::make($request->all(), $rules, $messages);
            //check if validation fails
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            //create the new user
            $user = User::create($request->all());

            // Assign Role to User 'member'
            $user->actAs('member');

            //Send email 'Profile created' to new user
            SendWelcomeEmail::dispatch($user);
        }else{
            //check if the user exists
            $user = User::findOrFail($request['user_id']);
            if($user == null){
                flash('A user with this email address does not exist. (' .$request['email'].')' , 'info');
                return back();
            }

            //Check if the user is not already booked for this event
            $bookings = Booking::where(['user_id'=>$user->id, 'event_id'=>$event->id])->first();
            if($bookings != null){
                flash('This user is already booked for this event!', 'info');
                return back();
            }
        }

        //generate a new reference number and create the booking
        $reference = 'BO'.Carbon::now()->timestamp;
        $booking=$user->bookings()->create([
            'reference' => $reference,
            'event_id' => $event->id,
            'status_is' => 'Pending'
        ]);

        //Notifications
        SendBookingCreatedEmail::dispatch($user, $booking, $event);

        flash('Booking for '. $user->fullname .' was successful.', 'success');
        return back();
    }

    /**
     *
     *
     *
     *
     */
    public function print_guests(Event $event)
    {

        if(Gate::denies('admin')) {
            flash('Unauthorized action attempt!');
            return redirect('/dashboard');
        }
//        $bookings = Booking::where('event_id', $event->id)->select('id', 'event_id', 'user_id', 'status_is', 'created_at', 'updated_at')->get();

//        return view('pdf.guest_list', compact('event'));
        $data=['event'=>$event];
        $pdf = PDF::loadView('pdf.guest_list', $data);

        return $pdf->download($event->start_date .' '. $event->start_time.'-attendee register- '.$event->name.'.pdf');

    }
}
