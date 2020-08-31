<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\RoleUser;

class PermissionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->authorizeResource(RoleUser::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->name || $request->email){
      $users = User::with('roles')->whereRaw(
        "LOWER(name) LIKE ? AND LOWER(email) LIKE ?", ['%'.strtolower($request->name).'%', '%'.strtolower($request->email).'%']
      )->get();
    } else {
      $users = User::with('roles')->get();
    }
    $roles = Role::all();
    return view('permission.index', compact('users', 'roles'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
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
  public function destroy($id)
  {
    //
  }
}
