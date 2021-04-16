<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['is_admin']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required',
            'phone_number' => 'required|numeric',
        ]);
        User::create($validatedData);

        return redirect('/users')->with('success', 'The user is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));//Todo: show.blade.php
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
        if(!(auth()->user()->is_admin)){
            return redirect('/home')->with('error', 'Unauthorized page');
        }
        return view('users.edit', compact('user'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ]);
        User::whereId($id)->update($validatedData);

        return redirect('/users')->with('success', "User's Data is successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(!(auth()->user()->is_admin)) {
            return redirect('/home')->with('error', 'Unauthorized Page');
        } else if (auth()->user()->is_admin && $user->is_admin) {
            return redirect('/users')->with('error', "You are not allowed to delete an admin");
        } else {
            $user->delete();
            return redirect('/users')->with('success', "User's Data is successfully deleted");
        }
    }
}
