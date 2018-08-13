<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaylistController extends Controller
{
  protected function create(array $data)
  {
    $id_user=$user->id;
    Playlist::create([
      '$id_user' => $id_user,
    ]);
  }
}
