<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPlaylist extends Model
{
  //muestra los campos que trae de la BD
  protected $fillable = ['name', 'url','id_playlis'];
}
