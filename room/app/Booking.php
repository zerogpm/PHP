<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Booking extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'booking';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'room_id', 'start_date', 'end_date'];

    /**
     * Get the room.
     */
    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get duration of booking in format 00:00:00.
     */
    public function getDurationAttribute()
    {
        return $this->end_date->diffForHumans($this->start_date, true);
    }

    public function getStartAttribute()
    {
        return $this->start_date->format('j M Y, g:i a');
    }

    public function getEndAttribute()
    {
        return $this->end_date->format('j M Y, g:i a');
    }
}
