<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Parents;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    protected $parent;

    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Parent Model
        $this->parent = new Parents;
    }

    public function index(Request $request)
    {
        
        $parent = $this->parent->get()->load(['student']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($parent),
                'data'=> $parent,
                
            ], 200);
        } catch (Exception $err) {
                return response()->json([
                'success'=>false,
                'errors'=>$err->getMessage()
            ], 500);
        }
    }

    public function getParentsBySchoolName(Request $request, $id)
    {
        $user = User::find($id);
        $parent = $this->parent->where('schoolName', $user->schoolName)->get()->load(['student']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($parent),
                'data'=> $parent,
                
            ], 200);
        } catch (Exception $err) {
                return response()->json([
                'success'=>false,
                'errors'=>$err->getMessage()
            ], 500);
        }
    }

   
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'occupation' => 'required|string',
            'email' => 'required|string|email',
            'phoneNumber1' => 'required|string',
            'houseAddress' => 'required|string',
            'workAddress' => 'required|string',
            'schoolName' => 'required|string',
            'sessionId' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'errors'=>$validator->messages()->all()
            ], 400);
        }

        try {

            $this->parent->firstname = $request->firstname;
            $this->parent->middlename = $request->middlename;
            $this->parent->lastname = $request->lastname;
            $this->parent->occupation = $request->occupation;
            $this->parent->email = $request->email;
            $this->parent->phoneNumber1 = $request->phoneNumber1;
            $this->parent->phoneNumber2 = $request->phoneNumber2;
            $this->parent->houseAddress = $request->houseAddress;
            $this->parent->workAddress = $request->workAddress;
            $this->parent->schoolName = $request->schoolName;
            $this->parent->sessionId = $request->sessionId;
            $this->parent->save();

            $parent = $this->parent->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Parent Saved Successfully',
                'data'=> $parent
            ], 201);

        } catch (Exception $err) {
            return response()->json([
                'success'=>false,
                'errors'=> $err->getMessage()
            ], 500);
        }
    }

   
    public function getById($id)
    {
        $parent = $this->parent->find($id)->load(['student']);

        if(is_null($parent)){
            return response()->json([
                'success'=>false,
                'errors'=> "Parent doesn't exist"
            ], 400);
        }

         return response()->json([
            'success'=> true,
            'data'=> $parent
        ], 200);
    }

 
    public function update(Request $request, $id)
    {
       $parent = $this->parent->find($id);

        if(is_null($parent)){
            return response()->json([
                'success'=>false,
                'errors'=> "Parent doesn't exist"
            ], 400);
        }

        try {
            $parent->update($request->all());

            return response()->json([
                'success'=>true,
                'message'=> 'Parent Updated Successfully',
                'data'=> $parent
            ], 200);

        } catch (Exception $err) {
            return response()->json([
                'success'=>false,
                'errors'=> $err->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $parent = $this->parent->find($id);

        if(is_null($parent)){
            return response()->json([
                'success'=> false,
                'errors'=> "Parent doesn't exist"
            ], 400);
        }

        $parent->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Parent was removed"
        ], 200);
    }
}
