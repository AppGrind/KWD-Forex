<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Event;
use App\Item;
use App\Http\Requests\EventsFormRequest;
use Auth;
use Carbon\Carbon;
use PDF;
use Gate;


class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('su', ['except' => ['show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::orderBy('created_at','desc')->paginate(10);

        $addBtn = ['title'=>'Create Event', 'action' => 'events/create', 'icon' => 'icon md-plus'];
        $buttons =[];
        array_push($buttons, $addBtn);
        return view('backend.events.index', compact('events', 'buttons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $items=Item::get()->pluck('item_name', 'id');
        $statuses = Event::$statuses;
        $listBtn = ['title'=>'Events List', 'action' => 'events', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $listBtn);
        return view('backend.events.create',compact('items', 'statuses', 'buttons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventsFormRequest $request)
    {
        $event = $request->all();
        $event['status_is'] = 'Pending';
        $event['reference'] = 'EV'.Carbon::now()->timestamp;
        $event['attendees'] = '';

        Event::create($event);
        flash('Event created successfully', 'success');
        return redirect('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        $addBtn = ['title'=>'Add Event', 'action' => 'events/create', 'icon' => 'icon md-plus'];
        $editBtn = ['title'=>'Edit Event', 'action' => 'events/' . $event->id . '/edit', 'icon' => 'icon md-edit'];
        $listBtn = ['title'=>'All Events', 'action' => 'events', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $addBtn, $editBtn, $listBtn);

        $bookings = Booking::where('event_id', $event->id)->get();
        return view('backend.events.show', compact('event', 'bookings', 'buttons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        $addBtn = ['title'=>'Add Event', 'action' => 'events/create', 'icon' => 'icon md-plus'];
        $listBtn = ['title'=>'All Events', 'action' => 'events', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $addBtn, $listBtn);
        $items=Item::get()->pluck('item_name', 'id');
        $statuses = Event::$statuses;
        return view('backend.events.edit', compact('event','items', 'statuses', 'buttons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventsFormRequest $request, Event $event)
    {
        // Update the existing account
        $event->update($request->all());
        flash('Event has been updated!', 'success');
        return redirect('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        if ($event->status_is == 'Pending'){
            // Delete an event
            $event->delete();
            flash('Event has been deleted!', 'success');
        }else{
            flash('You can only delete pending events', 'error');
        }

        $events = Event::get();
        $bookings = Booking::whereIn('event_id', $events->pluck('id'))->select('id', 'user_id', 'event_id', 'status_is', 'created_at', 'updated_at')->get();
        return redirect('events');
    }

    /**
     *
     *
     *
     */
    public function publish(Event $event){

        $event->status_is = "Open";
        $event->save();

        flash('Event published and opened to public for booking', 'success');
        return back();
    }
}
