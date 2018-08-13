<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserKid extends Model
{
  protected $table, "userskids"

  protected $fillable = ['namefull', 'username','age','pin','id_user' ];

  public function userkid()
  {
    return  $this-> belongsTo('App\UserKid')
  }
}
