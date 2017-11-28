<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'reference',
        'name',
        'host',
        'address',
        'description',
        'number_of_seats',
        'attendees',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status_is',
        'item_id'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date'
    ];
    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'Full' => 'Event Full', //red
        'Pending' => 'Pending', //orange
        'Open' => 'Open', // green
        'Closed' => 'Closed', // grey
    ];

    // A Booking belongsTo User
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Event belongsTo Item
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    // A Booking belongsTo User
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
