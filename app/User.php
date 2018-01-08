<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'is_verified',
        'is_subscribed',
        'code',
        'status_is',
        'firstname',
        'lastname',
        'displayname',
        'contactnumber',
        'address',
        'town',
        'province',
        'postalcode',
        'email',
        'password',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'lastloggedin_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_verified' => 'boolean',
        'is_subscribed' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // A User belongsToMany Role
    public function role()
    {
        return $this->belongsToMany('App\Role');
    }

    // Find out if A User has Role
    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->role->contains('name', $role);
        }

        return !! $role->intersect($this->role)->count();
    }

    // Assign Role to A User
    public function actAs($role)
    {
        return $this->role()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function getFullNameAttribute() {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function getFullAddressAttribute() {
        return ucfirst($this->address) . ' ' . ucfirst($this->town) . ' ' . ucfirst($this->province) . ', ' . $this->postalcode;
    }

    public function getUserVerifiedAttribute() {
        return $this->is_verified;
    }

    // A User has many Bookings
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }


    // A User has many Events
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    // A User has many Invoices
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
