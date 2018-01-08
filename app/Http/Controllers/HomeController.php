<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\GetInTouchFormRequest;
use App\Booking;
use App\Event;
use Auth;
use Cache;
use Laracasts\Flash\Flash;
use Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'], ['except'=>'get_in_touch']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Auth::user()->is_verified){
            return view('auth.verification');
        }
        $events = Cache::get('events', function(){
            return Event::whereNotIn('status_is', ['Pending'])->orderBy('created_at','desc')->get();
        });
        return view('backend.dashboard', compact('events'));
    }


    public function verification()
    {
     return view('auth.verification');
    }

    public function get_in_touch(GetInTouchFormRequest $request)
    {

        // ToDo use mailable and queues
        $email = 'info@kwdforex.com';
        $sender_email = $request['email'];
        $subject = $request['subject'];
        $parameters = array(
            'to' => 'Admin',
            'name' => $request['name'],
            'phone' => $request['phone'],
            'subject' => $request['subject'],
            'mail' => $request['email'],
            'bodymessage' => $request['bodymessage'],
        );

        Mail::send('mail.get-in-touch', $parameters, function ($message)
        use ($email, $sender_email, $subject) {
            $message->from($sender_email);
            $message->to($email)->subject($subject);
        });

        flash('Thank You! Your message was sent successfuly.', 'success');

        return back();

    }
}
