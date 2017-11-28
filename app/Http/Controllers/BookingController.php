<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Event;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
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
        //
        if(Auth::user()->hasRole('admin')){
            $bookings = Booking::paginate(10);
        }else{
            $bookings = Booking::where('user_id', Auth::id())->get();
        }

        return view('backend.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Creates a new booking for logged in user using the event id
     *
     * @return \Illuminate\Http\Response
     */
    public function createEventBooking($eventId)
    {
        //
        $event = Event::where('id', $eventId)->first();
        $bookings = Booking::where('event_id', $event->id)->select('id', 'event_id', 'user_id', 'status_is', 'created_at', 'updated_at')->get();

        if($bookings->where('user_id', Auth::id())->count() > 0){
            flash('You\'ve already booked a seat for this event!', 'info');
            return back();
        }
        if ($bookings->count() == $event->number_of_seats && $event->status_is == "FullyBooked"){
            flash("Sorry this event is fully booked.","error");
            return redirect('/home');
        }

        $booking = Booking::create(['user_id'=>Auth::user()->id,
            'event_id'=>$eventId,
            'reference'=>'BO'.str_random(9),
            'status_is'=>'Pending']);

        $email = Auth::user()->email;
        $name = Auth::user()->username;

        $parameters = array(
            'username' => Auth::user()->username,
            'callout_button' => 'View Booking',
            'callout_url' => url('/view-event/'.$eventId),
            'booking_ref' => $booking->reference,
            'booking_date_time' => $booking->created_at,
            'user' => Auth::user()
        );


        if(Auth::user()->subscription){
            // Send email to show booking has been created
            Mail::send('emails.booking_created', $parameters, function ($message)
            use ($email, $name) {
                $message->from('noreply@goforex.co.za');
                $message->to($email, $name)->subject('GoForex - Your booking was created successfully!');
            });
        }

        if(!Auth::user()->hasRole('admin')){
            $parameters = [ 'username' => 'Admin',
                'user' => Auth::user(),
                'bookings' => $bookings,
                'booking' => $booking,
                'event' => $event,
                'callout_button' => 'Login to Dashboard',
                'callout_url' => url('/login')];

            Mail::send('emails.booking_created_notify_admin', $parameters, function ($message)
            use ($email, $name) {
                $message->from('noreply@goforex.co.za');
                $message->to($email, $name)->subject('GoForex - A user has created a new Booking.');
            });
        }

        $message = '<p>You have created a booking of <b>Ref# '.$booking->reference.'</b></p>
                    <p>Please make a payment to below details, and update your online booking by uploading proof of payment:</p>
                    <br/>
                    <p><i>Banking Details :</i><br>
                        Bank : <b> First National Bank</b><br>
                        Acc Holder : <b> Go Forex Wealth Creation SA</b><br>
                        Acc Number : <b> 62715445658</b><br>
                        Branch Code : <b> 250655 </b></p>
                    <p><b>Booking Date/Time : '. $booking->created_at .'</b></p>';

        $this->saveNotification($message,'notification',Auth::user(), 'Booking Created');
        flash("You have successfully created a booking, please make payment to complete your reservations.", "success");

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if event number of available seats is not less than 0,
        //Add Booking info to Bookings table
        //subtract 1 from event number of available seats
        //Send email & notification message to user with payment steps
        //Send Email to admin
        //Redirect to Bookings index via route with message to upload proof of payment
        $user = User::findOrFail($request['user']);
        $event = Event::where('id', $request['event'])->first();

        if($event->number_of_seats > 0){
            $reference = 'BO'.Carbon::now()->timestamp;
            if(Booking::where(['user_id' => $user->id, 'event_id' => $event->id])->count() == 0){
                $booking=$user->bookings()->create([
                    'reference' => $reference,
                    'event_id' => $event->id,
                    'status_is' => 'Pending'
                ]);
                flash('success', 'Thank you! Your booking was successful.');
            }else{
                flash('warning', 'You are already booked for this event.');
            }
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
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
        $booking->delete();
        flash()->success('Booking has been deleted!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $bookingId)
    {
        //
        $booking = Booking::where('id', $bookingId)->first();

        if ($booking){
            $booking->update(['status_is'=>'Paid']);

            $event = Event::where('id', $booking->event_id)->first();

            $attendees = explode(',', $event->attendees);



            $bookings = Booking::whereIn('user_id', $attendees)->where('event_id', $event->id)->get();

            // Add Paid Invoice
            $this->addInvoice($booking);

            flash("Booking approved successfully.", "success");

            $user = User::where('id', $booking->user_id)->first();

            $email = $user->email;
            $name = $user->username;

            $parameters = array(
                'username' => $user->username,
                'callout_button' => 'View Event',
                'callout_url' => url('/view-event/'.$event->id),
                'event_name' => $event->name,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'start_time' => $event->start_time,
                'address' => $event->address,
                'host' => $event->host,
                'booking_ref'=> $booking->reference,
                'user' => $user,
            );
            // TODO add queue

            if($user->subscription){

                // Send email to confirm successful registration
                Mail::send('emails.booking_confirmed', $parameters, function ($message)
                use ($email, $name) {
                    $message->from('noreply@goforex.co.za');
                    $message->to($email, $name)->subject('GoForex - Booking Confirmed!');
                });

            }
            $message = '<h5><strong>Hey there!</strong></h5> <br><p>Congratulations, your booking for '. $event->name .' on '. $event->start_date .' @ '. $event->start_time .' has been approved.</p><br>
                        <p>Please be there at least 30min  before the specified start time.</p>';
            $this->saveNotification($message,'notification',$user, 'Booking Approved');

            return back();


        } else {
            flash("The booking you are searching for doesn't exist.", "error");
        }
    }

    /**
     * Add Paid Invoice.
     */
    public function addInvoice($booking)
    {
        // Create 'Pending' Invoice
        $invoice = Invoice::create([
            'user_id'=>$booking->user->id,
            'amount'=>$booking->event->item->price,
            'status_is'=>'Paid',
        ]);

        $items = Item::where('id',$booking->event->item->id)->get();
        foreach ($items as $item) {
            $invoice->items()->attach($item->id, ['quantity' => 1, 'price' => $item->price]);
        }
    }

    /**
     * Booking declined.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function decline($bookingId)
    {
        //
        $booking = Booking::where('id', $bookingId)->first();

        if ($booking){
            $user = User::where('id', $booking->user_id)->first();
            $booking_ref = $booking->reference;

            $event = Event::where('id', $booking->event_id)->first();

            $attendees = explode(',', $event->attendees);

            if (($key = array_search($user->id, $attendees)) !== false) {
                unset($attendees[$key]);
            }

            $event->update(['attendees'=>implode(',', $attendees),]);

            $booking->delete();

            $email = $user->email;
            $name = $user->username;

            $parameters = array(
                'username' => $user->username,
                'booking_ref'=> $booking_ref,
                'callout_button' => 'Sign In',
                'callout_url' => url('login'),
                'user' => $user
            );
            // TODO add queue

            if($user->subscription){

                // Send email to confirm successful registration
                Mail::send('emails.booking_declined', $parameters, function ($message)
                use ($email, $name) {
                    $message->from('noreply@goforex.co.za');
                    $message->to($email, $name)->subject('GoForex - Your booking is declined!');
                });

            }
            $message = '<h5><strong>Greetings '. $user->firstname .'!</strong></h5><p> It is in our deepest regrets to inform you that your booking for '. $event->name .' on '. $event->start_date .' @ '. $event->start_time .' has been declined. <br>This could be because your proof of payment could not be verified, please contact us for more info.</p> <br>
                            <p>If you are still interested in this event please create another booking if seats are still available.</p>';
            $this->saveNotification($message,'notification',$user, 'Booking Declined');

            $bookings = Booking::whereIn('user_id', $attendees)->where('event_id', $event->id)->get();

            flash("Booking declined, and " . $user->firstname . " has been notified!", "success");
            return back();

        }else {
            flash("Failed to decline booking.", "error");
            return back();
        }
    }

    /**
     *
     *
     *
     *
     *
     *
     */
    public function add_attendees(Event $event)
    {

        $event = $event;
        $events = Event::where('status_is', 'Open')->pluck('name', 'id');
        $bookings = Booking::where('event_id', $event->id)->select('id', 'user_id', 'event_id', 'status_is', 'created_at', 'updated_at')->get();
        $attendees = User::where(['status_is' => 'Active', 'verified' => 1])->orderBy('email', 'asc')->pluck('email', 'id');
        if($event->number_of_seats == $bookings->where('status_is', 'Paid')->count() || $event->status == "FullyBooked"){
            flash('The event is now fully booked!', 'info');
            return redirect('/home');
        }
        return view('backend.bookings.create', compact('event', 'events', 'bookings', 'attendees'));
    }

    /**
     *
     *
     *
     *
     *
     *
     */
    public function save_attendees(AttendeeFormRequest $request, Event $event)
    {

        $password = str_random(8);
        $username = $request['email'];

        // Generate new reference number
        $ref = rand(1000000, 9999999);
        $results = User::where('reference', $ref)->count();

        // Loop and regenerate $ref while $results is more than 0
        while ($results > 0) {
            $ref = rand(100000, 999999);
            $results = User::where('reference', $ref)->count();
        }

        $user = User::firstOrCreate([
            'reference' => $ref,
            'verified' => 0, // Not yet verified
            'code' => str_random(6),
            'username' => $username,
            'cell' => $request['cell'],
            'email' => $request['email'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'password' => bcrypt($password),
            'status_is' => User::$statuses['Active'],
            'location' => $request['location'],
            'sponsor' => '',
        ]);

        // Assign Role to User 'member'
        $user->actAs('member');

        $email = $user->email;
        $name = $user->username;

        $parameters = array(
            'username' => $user->username,
            'callout_button' => 'Sign In',
            'callout_url' => url('login'),
            'password' => $password,
            'user' => $user,
        );

        // Send email to confirm successful registration
        Mail::send('emails.attendee_account_created', $parameters, function ($message)
        use ($email, $name) {
            $message->from('noreply@goforex.co.za');
            $message->to($email, $name)->subject('Welcome To GoForex!');
        });

        //Add Booking
        $request['user'] = $user->id;
        $this->add_attendees_booking($request, $event);

        flash('Booking for ' . $user->firstname . ' ' . $user->lastname . ' was created successfully!', 'success');
        return back();
    }

    //Add Booking method, use both in this class and via routes
    public function add_attendees_booking(Request $request, Event $event)
    {
        $user = User::findOrFail($request['user']);
        $bookings = Booking::where('event_id', $event->id)->select('id', 'event_id', 'user_id', 'status_is', 'created_at', 'updated_at')->get();

        if($bookings->where('user_id', $user->id)->count() > 0){
            flash('A user with an identical email address is already booked a seat for this event!', 'info');
            return back();
        }
        $booking = Booking::create(['user_id'=> $user->id,
            'event_id'=>$event->id,
            'reference'=>'BO'.str_random(9),
            'status_is'=>'Pending']);

        $email = $user->email;
        $name = $user->username;

        $parameters = array(
            'username' => $user->username,
            'callout_button' => 'Sign In',
            'callout_url' => url('login'),
            'user' => $user,
            'booking' => $booking,
            'event' => $event,
        );

        // Send email to confirm successful booking
        Mail::send('emails.attendee_booking_created', $parameters, function ($message)
        use ($email, $name) {
            $message->from('noreply@goforex.co.za');
            $message->to($email, $name)->subject('Booking created on your behalf!');
        });

        if($bookings->count() >= $event->number_of_seats AND $booking->where('status_is', 'Pending')->count() > 0 ){
            flash('Booking created but ... Caution! This event is fully booked, with pending bookings.', 'info');
            return back();
        }elseif($bookings->count() >= $event->number_of_seats AND $booking->where('status_is', 'Pending')->count() == 0 ){
            flash('Event is fully booked, no further bookings allowed.', 'warning');
            return redirect('/home');
        }

        flash('Booking for ' . $user->firstname . ' ' . $user->lastname . ' was created successfully!', 'success');
        return redirect('/attendees/' . $event->id . '/add');

    }
}