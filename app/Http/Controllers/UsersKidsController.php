<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Playlis;
use App\Videoplaylist;
use App\UserKid;

class UsersKidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.userKids.create');
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

        $userKids = new UserKid($request->all());
        $userKids->pin = bcrypt($request->password);
        $userKids->id_user=$iduser;
        $validator = Validator::make($request->all(), [
        'namefull' => 'required',
        'username' => 'required',
        'age' => 'required',
        'pin' => 'required',
        ]);
        if ($validator->fails()) {
                  return redirect('admin/videoplaylist/create')
                  ->withErrors($validator)
                  ->withInput();
        }else{
        $userKids->save();
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
      $userKids= UserKid::find($id);
      return view ('admin.userkids.edit')->with ('userkid', $userKids);
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
        $userKids=UserKid::find($id);
        $userKids->namefull = $request->namefull;
        $userKids->username = $request->username;
        $userKids->age = $request->age;
        $userKids->pin = $request->pin;

        $validator = Validator::make($request->all(), [
        'namefull' => 'required',
        'username' => 'required',
        'age' => 'required',
        'pin' => 'required',
        ]);
        if ($validator->fails()) {
                  return redirect('admin/userkids/edit')
                  ->withErrors($validator)
                  ->withInput();
        }else{
        $userKids->save();
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
        $userKids = UserKid::find($id);
        $userKids->delete();
    }
}
