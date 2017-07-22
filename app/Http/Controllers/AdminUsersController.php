<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles =Role::lists('name','id')->all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

//        below commented code is for the password ........

//        if(trim($request->password) == '' ){
//
//            $input = $request->except('password');
//
//        } else{
//
//            return $request->all();
//
//        }

        $input =$request->all();

        if($file = $request->file('photo_id')){

            $name= time() . $file->getClientOriginalName();

            $file->move('images',$name);

            $photo =Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;

        }

        $input['password']=bcrypt($request->password);

        User::create($input);

//        User::create($request->all());

        return redirect('/admin/users/');

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
        $user =User::findOrFail($id);

        $roles =Role::lists('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //

//        if(trim($request->password) == '' ){
//
//            $input = $request->except('password');
//
//        } else{
//
//            return $request->all();
//
//        }



        $user=User::findOrFail($id);

        $input = $request->all();

        if($file= $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        $input['password']= bcrypt($request->password);

        $user->update($input);

        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//         +++++++++ SIMPLE WAY TO DELETE THE USER FROM THE DB AND THE IMAGE WILL NOT BE DELETED HERE +++++++++++++++++++
//        User::findOrFail($id)->delete();
//        return redirect('/admin/users');

//          SO WE USE THE ANOTHER METHODS TO DELETE THE USER PHOTOS FROM THE IMAGE DIRECTORY ALSO ++++++++++++





//  +++++++++++      Deleting the data from the database and image but the image will be in the public folder and we use seesion flush function to show the message....

//        User::findOrFail($id)->delete();
//
//        Session::flash('deleted_user','The User has been deleted.');
//
//        return redirect('/admin/users');

//  +++++++++++++++++++++++++      Finish  ++++++++++++++++++++++++++





//        WE delete the image form the database also see here ..............


        $user=User::findOrFail($id);


        unlink(public_path() . $user->photo->file);

        $user->delete();

        Session::flash('deleted_user','The user is deleted.');

        return redirect('/admin/users');

//        Finish code.............................


    }
}
