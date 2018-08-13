<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class Playlis extends Model
{
    protected $fillable = ['id_user'];

    public function user()
    {
      return  $this-> belongsTo('App\User');
    }
}
