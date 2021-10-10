<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profile;

    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Profile Variable to Profile Model
        $this->profile = new Profile;
    }

    public function index(Request $request)
    {
       $user_token = $request->token;
       $user = auth('users')->authenticate($user_token);
       $user_id = $user->id;

       $profile = $this->profile::where('userId', $user_id)->first();

       return $profile;
    }

    public function create(Request $request)
    {
       $user_token = $request->token;
       $user = auth('users')->authenticate($user_token);
       $user_id = $user->id;

       $profile = $this->profile::where('userId', $user_id)->first();
       if(is_null($profile))
       {
           $this->profile->phone = $request->phone;
           $this->profile->address = $request->address;
           $this->profile->dob = $request->dob;
           $this->profile->userId = $user_id;
           $this->profile->save();
    
           return response()->json([
                'success'=>true,
                'message'=> 'Profile Saved Successfully',
            ], 201);
       }else 
       {
          $profile->update($request->all());

           return response()->json([
                'success'=>true,
                'message'=> 'Profile Saved Successfully',
                'data'=> $profile
            ], 200);
       }

    }
}
