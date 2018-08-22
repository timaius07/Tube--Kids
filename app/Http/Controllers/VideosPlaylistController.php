<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Collective\Html\Eloquent\FormAccessible;
use App\User;
use App\Playlis;
use App\Videoplaylist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class VideosPlaylistController extends Controller

{
  public function index()
  {

  }
  /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
  public function create()
  {
      return view('admin.videoplaylist.create');
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {

     //datos del usuario
     $iduser = Auth::id();
     //datos de los playlist
    $playlist = Playlis::orderBy('id', 'ASC') -> pluck ('id', 'id_user') ;
    $results = DB::select('select * from playlis where id_user = :id', ['id' => $iduser]);
     //validar si la url esta vacia guardar el path con la ruta del archivo
     //dd($results);
     $indice = $results[0]->id;
     $videoplaylist = new Videoplaylist($request->all());

      if ($request->url== null) {
        $file = $request->file('video');
        $path =  public_path() . '\videos\Playlist';
        $extension = $request->file('video')->getClientOriginalExtension();
        $name = $videoplaylist->name . '.' . $extension;
        $url = ($path.'\\'.$name);
        $videoplaylist->url=$url;
        $videoplaylist->id_playlis=$indice;
        $videoplaylist->save();
        $file->move($path.'\\'.$name);
      }else{
        $videoplaylist->url= $request->url;
        $videoplaylist->id_playlis=$indice;
        $videoplaylist->save();
      }

      // $file->move($path, "video");
      // $url = $request->input('url');
      // $videoplaylist->url = $url;
      // dd($videoplaylist);
       //$videoplaylist -> save();
    // }



   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
       //
   }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
      //
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {

   }

   public function __construct()
   {
    $this->middleware('auth');
   }



}
