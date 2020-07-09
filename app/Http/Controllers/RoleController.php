<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin_auth');
  }
  
  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
   */
    public function index()
    {
      $roles = Role::all();
      return view('role.index', compact('roles'));
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('role.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Role::create($request->all());
    return redirect()->route('roles.index')
                     ->with('success', __('messages.add_success', ['item' => 'role']));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role)
  {
    //
  }
}