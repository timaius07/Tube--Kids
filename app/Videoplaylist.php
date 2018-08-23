<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Controllers\Controller;


class VideoPlaylist extends Model
{
  protected $table= "videoplaylist";
  //muestra los campos que trae de la BD
  protected $fillable = ['nombre_video', 'url_video','id_playlis'];
}
