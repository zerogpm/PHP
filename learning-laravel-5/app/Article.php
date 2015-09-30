<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
      'title',
      'body',
      'published_at'
    ];

    //it will merge whatever we set as Carbon date. it convert into Carbon object instead of String
    protected $dates = ['published_at'];

    //change data before insert into database
    //setName Attribute follow the name rule
    public function setPublishedAtAttribute($date) {
        /**
         * I've found that you should should not use createFromFormat,
         * unless the second paramater $date is also a Carbon object,
         * but if it's not and it's just a string you can just use
         */
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    /**
     * Query Scope function
     * you need to put scope follow by the fucntion EX: Published is the function name
     */
    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnPublished($query) {
        $query->where('published_at', '>', Carbon::now());
    }
}
