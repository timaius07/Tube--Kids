<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class VideoPlaylist extends Model
{
  //muestra los campos que trae de la BD
  protected $fillable = ['name', 'url','id_playlis'];
}
