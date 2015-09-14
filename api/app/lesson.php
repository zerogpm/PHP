<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    protected $table = 'lesson';
    protected $fillable = ['title', 'body','confirmed','Added_on'];
}
