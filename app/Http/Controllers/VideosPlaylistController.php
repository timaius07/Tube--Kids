<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     //datos de los playlist para identificar el usuario dueño de la misma.
    $results = DB::select('select * from playlis where id_user = :id', ['id' => $iduser]);
     //dd($results);
     $indice = $results[0]->id;
     $videoplaylist = new Videoplaylist($request->all());
     //verifica que la url este vacia con esto damos por hecho que se carga un video de la pc
      $file = $request->file('video');
      //valida que contengan todos los datos solicitados
      $validator = Validator::make($request->all(), [
      'video' => 'required',
      'name' => 'required',
      ]);
      if ($validator->fails()) {
                return redirect('admin/videoplaylist/create')
                ->withErrors($validator)
                ->withInput();
      }
      if ($request->url== null) {
        $path =  public_path() . '\videos\Playlist';
        $extension = $request->file('video')->getClientOriginalExtension();
        $name = $request->name . '.' . $extension;
        $url = ($path.'\\'.$name);
        $videoplaylist->nombre_video=$request->name;
        $videoplaylist->url_video=$url;
        $videoplaylist->id_playlis=$indice;
        $videoplaylist->save();
        $file->move($path.'\\'.$name);
      }else{
        //de lo contrario se estaria guardando la url del video de youtube
        $validator = Validator::make($request->all(), [
        'url' => 'required',
        'name' => 'required',
        ]);
        if ($validator->fails()) {
                  return redirect('admin/videoplaylist/create')
                  ->withErrors($validator)
                  ->withInput();
        }
        $videoplaylist->nombre_video=$request->name;
        $videoplaylist->url_video= $request->url;
        $videoplaylist->id_playlis=$indice;
        $videoplaylist->save();
      }
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
     //realiza la busqueda del video en el playlist para mostrarlo
     $videoplaylist = Videoplaylist::find($id);
     return view ('videoplaylist.edit')->with('playlis', $videoplaylist);
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
      //datos del usuario
      $iduser = Auth::id();
      $results = DB::select('select * from playlis where id_user = :id', ['id' => $iduser]);
      //dd($results);
      $indice = $results[0]->id;
      $videoplaylist = Videoplaylist::find($id);
       //verifica que la url este vacia con esto damos por hecho que se carga un video de la pc
        if ($request->url== null) {
          //recibe el input del video que seleccinamos
          $file = $request->file('video');
          $path =  public_path() . '\videos\Playlist';
          //obtenemos la extension del archhivo
          $extension = $request->file('video')->getClientOriginalExtension();
          //contiene el nombre que le dimos al video y la extension de la misma.
          $name = $videoplaylist->name . '.' . $extension;
          $url = ($path.'\\'.$name);
          $videoplaylist->url=$url;
          $videoplaylist->id_playlis=$indice;
          //mueve el archivo a la carpeta que establecimos anteriormente
          $file->move($path.'\\'.$name);
          //enviamos los datos ya actualizados
          $videoplaylist->save();
        }else{
          //de lo contrario se estaria guardando la url del video de youtube
          $videoplaylist->url= $request->url;
          $videoplaylist->id_playlis=$indice;
          $videoplaylist->save();
        }
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      $videoplaylist = Videoplaylist::find($id);
      $videoplaylist->delete();
      flash("Se ha eliminado usuario de forma exitosa")->error();
      return redirect()->route('videoplaylist.index');
   }

   public function __construct()
   {
    $this->middleware('auth');
   }



}
