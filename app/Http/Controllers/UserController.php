<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	protected $request;

    public function __construct(Request $request)
    {
    	$this->request = $request;
    	$this->middleware('redirect_not_admin');
    	$this->middleware('redirect_if_admin_is_used')->only(['editUser', 'removeUser']);
    }

    public function index()
    {
    	if($this->request->isMethod('get'))
	    	return view('user_administration', [
	    		'title' => 'User Administration',
	    		'users' => User::all()
	    	]);

	    elseif($this->request->isMethod('post'))
        {
        	$this->request->validate([
        		'username' => 'bail|required|min:3|max:20|unique:users,username|alpha_dash',
        		'password' => 'bail|required|min:6|max:30|confirmed'
        	]);

        	$user = new User;
        	$user->username = $this->request->username;
        	$user->password = bcrypt($this->request->password);
        	$user->is_admin = false;
        	$user->save();

        	return back()->with('success', ['header' => 'New user added successfully.']);
        }

        else
            return response(null, 405);
    }

    public function editUser(User $user)
    {
    	if($this->request->isMethod('get'))
    		return view('edit_user', [
	    		'title' => 'Edit User',
	    		'user' => $user
	    	]);

    	elseif($this->request->isMethod('patch'))
    	{
    		$this->request->validate([
        		'username' => "bail|required|min:3|max:20|unique:users,username,{$user->user_id},user_id|alpha_dash",
        		'password' => 'bail|nullable|min:6|max:30|confirmed'
        	]);

        	$user->username = $this->request->username;
        	$user->password = $this->request->password != null ? bcrypt($this->request->password) : $user->password;
        	$user->save();

        	return back()->with('success', ['header' => 'User updated successfully.']);
    	}

    	else
            return response(null, 405);
    }

    public function removeUser(User $user)
    {
    	$user->delete();
    	return back();
    }
}
