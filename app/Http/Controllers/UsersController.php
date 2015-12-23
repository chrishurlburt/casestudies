<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Helpers\Helpers;

use \Sentinel;

use App\User;
use Cartalyst\Sentinel\Roles\EloquentRole;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('authorize');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get()->all();

        return view('layouts.admin.users.manage')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Sentinel::getRoleRepository()->all();

        return view('layouts.admin.users.create')->with('roles', $roles);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $StoreUserRequest)
    {
        $input = $StoreUserRequest->all();

        if( !$role = Sentinel::findRoleById($input['role']) ) {
            // Invalid role was provided
            return redirect(route('admin.users.create'))->withErrors('Not a valid role.');
        } else {

            // check for matching passwords
            if($input['password'] != $input['password_confirm']) {
                // not matching
                $StoreUserRequest->flash();
                return redirect(route('admin.users.create'))->withErrors('The passwords provided did not match.');
            } else {

                // setup credentials
                $credentials = [
                    'email'      => $input['email'],
                    'password'   => $input['password'],
                    'first_name' => $input['first_name'],
                    'last_name'  => $input['last_name']
                ];

                // check creation validity
                if( Sentinel::validForCreation($credentials) ){
                    // create the user, attach the role
                    $user = Sentinel::register($credentials);
                    $role->users()->attach($user);

                    Helpers::flash('User successfully created.');
                    return redirect(route('admin.users.index'));

                } else {
                    return redirect(route('admin.users.create'))->withErrors('Something went wrong, please try again.');
                }

            }
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
        $user = User::findOrFail($id);
        $roles = Sentinel::getRoleRepository()->all();

        return view('layouts.admin.users.edit')->with('user', $user)->with('roles', $roles);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $UpdateUserRequest, $id)
    {

        // @TODO: this shit is fucked

        $user = User::findOrFail($id);

        $user->update($UpdateUserRequest->all());

        $this->updateRole($id, Sentinel::findRoleById($UpdateUserRequest->role));

        Helpers::flash('The user has been successfully updated');
        return redirect(route('admin.users.index'));
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

    /**
     * Sync a role to a user.
     *
     * @param  User  $user
     * @param  array $role
     * @return null
     */
    private function updateRole($user, $role)
    {
        // detach old role
        // attach new role

        $oldRole = $user->roles()->first();
         dd( $oldRole );

        $role->users()->attach($user);
    }
}
