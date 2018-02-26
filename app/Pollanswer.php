<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pollanswer extends Model
{
    //
    protected $fillable = [
      'answer',
        'poll_id'
    ];

    public function polls(){
        return $this->belongsTo('App\Models\Poll');
    }
}


