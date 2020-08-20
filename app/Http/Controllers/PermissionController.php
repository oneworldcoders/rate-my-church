<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\RoleUser;

class PermissionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::all();
    $roles = Role::all();
//    $permissions = RoleUser::all();
  //  dd($permissions->first());
    return view('permission.index', compact('users', 'roles'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $users = User::all();
    $roles = Role::all();
    return view('permission.create', compact('users', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->authorize('create', User::class);
    $user = User::find($request->input('user'));
//    dd($request->input('role'));
    $role = Role::find($request->input('role'));
    $user->roles()->attach($role);
    return redirect()->route('permissions.index')
                     ->with('success', __('messages.add_success', ['item' => 'permission']));
  }

  public function save(Request $request)
  {
    $permissions = $request->input('permissions');
    foreach($permissions as $permission){
      $permission = json_decode($permission, true);
      if($permission['checked']){
        RoleUser::create($permission);
      }else{
        $user_id = $permission['user_id'];
        $role_id = $permission['role_id'];
        RoleUser::where(['user_id' => $user_id, 'role_id' => $role_id])->delete();
      }
    }

    return redirect()->route('permissions.index')
                   ->with('success', __('messages.add_success', ['item' => 'permissions']));
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
  public function destroy(Request $request)
  {
    //
  }
}
