<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\StaffNextOfKin;
use Illuminate\Http\Request;

class StaffNextOfKinController extends Controller
{
    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Staff Variable to Staff Model
        $this->staff = new StaffNextOfKin;
    }
   
    public function index(Request $request)
    {
        $user_token = $request->token;
        $user = auth('users')->authenticate($user_token);
        $user_id = $user->id;
        
        $staff = $this->staff->get()->load(['staff'])->toArray();
        try {
            return response()->json([
                'success'=>true,
                'count'=>count($staff),
                'data'=> $staff,
                
            ], 200);
        } catch (Exception $err) {
                return response()->json([
                'success'=>false,
                'message'=>$err->getMessage()
            ], 500);
        }
    }

   
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),
        [
            'surname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phoneNumber1' => 'required',
            'address' => 'required',
            'relationship' => 'required',
            'staffId' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->toArray()
            ], 400);
        }

        try {

            $this->staff->surname = $request->surname;
            $this->staff->firstname = $request->firstname;
            $this->staff->middlename = $request->middlename;
            $this->staff->gender = $request->gender;
            $this->staff->email = $request->email;
            $this->staff->phoneNumber1 = $request->phoneNumber1;
            $this->staff->phoneNumber2 = $request->phoneNumber2;
            $this->staff->address = $request->address;
            $this->staff->relationship = $request->relationship;
            $this->staff->staffId = $request->staffId;
            $this->staff->save();

            $staff = $this->staff->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Record Saved Successfully',
                'data'=> $staff
            ], 201);

        } catch (Exception $err) {
            return response()->json([
                'success'=>false,
                'message'=> $err->getMessage()
            ], 500);
        }
    }

    public function getById($id)
    {
         $staff = $this->staff->find($id)->load(['staff']);

        if(is_null($staff)){
            return response()->json([
                'success'=>false,
                'message'=> "Next of Kin doesn't exist"
            ], 400);
        }

         return response()->json([
            'success'=> true,
            'data'=> $staff
        ], 200);
    }

  
    public function update(Request $request, $id)
    {
          $staff = $this->staff->find($id);

            if(is_null($staff)){
                return response()->json([
                    'success'=>false,
                    'message'=> "Next of Kin doesn't exist"
                ], 400);
            }

            try {
                $staff->update($request->all());

                return response()->json([
                    'success'=>true,
                    'message'=> 'Record was Updated Successfully',
                    'data'=> $staff
                ], 200);

            } catch (Exception $err) {
                return response()->json([
                    'success'=>false,
                    'message'=> $err->getMessage()
                ], 500);
            }
    }

    
    public function delete($id)
    {
        $staff = $this->staff->find($id);

        if(is_null($staff)){
            return response()->json([
                'success'=> false,
                'message'=> "Next of Kin doesn't exist"
            ], 400);
        }

        $staff->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Operation was successful"
        ], 200);
    }
}
