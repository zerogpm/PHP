<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified'
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->register_token = str_random(30);
        });
    }

    /**
     * Confirm the user after email verified.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->register_token = null;
        $this->save();
    }

     /**
     * Get user roles via pivot table
     *
     * @return collection of users' roles
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($roleName)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $roleName)
            {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get user booked room via pivot table
     *
     * @return collection of users' roles
     */
    public function hasBookedRoom()
    {
        return $this->belongsToMany('App\Room', 'booking')->withTrashed()->withPivot('start_date', 'end_date');
    }

    public function booking()
    {
        return $this->hasMny('App\Booking');
    }
}
