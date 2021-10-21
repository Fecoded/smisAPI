<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\Staff;
use App\Models\Classes;
use App\Models\ClassesStaff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $class;

    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Staff Variable to Staff Model
        $this->staff = new Staff;

        // Class Variable to Class Model
        $this->class = new Classes;
    }

    public function index(Request $request)
    {
        $user_token = $request->token;
        $user = auth('users')->authenticate($user_token);
        $user_id = $user->id;
        
        $staff = $this->staff->get()->load(['staffnextofkin'])->toArray();
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
            'dob' => 'required',
            'houseAddress' => 'required',
            'placeOfBirth' => 'required',
            'religion' => 'required',
            'nationality' => 'required',
            'stateOfOrigin' => 'required',
            'dateOfEmployment' => 'required',
            'dateOfRegistration' => 'required',
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
            $this->staff->dob = $request->dob;
            $this->staff->houseAddress = $request->houseAddress;
            $this->staff->placeOfBirth = $request->placeOfBirth;
            $this->staff->religion = $request->religion;
            $this->staff->nationality = $request->nationality;
            $this->staff->stateOfOrigin = $request->stateOfOrigin;
            $this->staff->dateOfEmployment = $request->dateOfEmployment;
            $this->staff->dateOfRegistration = $request->dateOfRegistration;
            $this->staff->save();

            $staff = $this->staff->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Staff Saved Successfully',
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
        $staff = $this->staff->find($id)->load(['staffnextofkin']);

        if(is_null($staff)){
            return response()->json([
                'success'=>false,
                'message'=> "Staff doesn't exist"
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
                    'message'=> "Staff doesn't exist"
                ], 400);
            }

            try {
                $staff->update($request->all());

                return response()->json([
                    'success'=>true,
                    'message'=> 'Staff Updated Successfully',
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
                'message'=> "Staff doesn't exist"
            ], 400);
        }

        $staff->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Staff was removed"
        ], 200);
    }

    public function search($name)
    {
        
        $staff = $this->staff->where('firstname', 'like', '%'.$name.'%')->get();

        return response()->json([
            'success'=> true,
            'data' => $staff
        ], 200);
    }

    public function getStaffAndClassById($id)
    {
        $staff = $this->staff->find($id);

        if(is_null($staff)) {
            return response()->json([
                'success'=> false,
                'message'=> "Staff doesn't exist"
            ], 400);
        }

        $staffAndClass = $staff->classes;

        return response()->json([
            'success'=> true,
            'data'=> $staffAndClass
        ], 200);
    }

    public function assignTeacherToClass(Request $request, $id) 
    {
        $staff = $this->staff->find($id);
        $class = $this->class->find($request->classId);

        if(is_null($staff)){
            return response()->json([
                'success'=>false,
                'message'=> "Staff doesn't exist"
            ], 400);
        }

        if(is_null($class)){
            return response()->json([
                'success'=>false,
                'message'=> "Class doesn't exist"
            ], 400);
        }

         $class->staff()->attach($staff);

          return response()->json([
            'success'=>true,
            'message'=> 'Operation was successful',
        ], 200);
    }

    public function updateClassAssignToStaff(Request $request, $id)
    {
        $staff = $this->staff->find($id);
        $class = $this->class->find($request->classId);

        $attributes = ['classId' => $request->newClassId];

        $staff->classes()->updateExistingPivot($request->classId, $attributes);

        return response()->json([
            'success'=> true,
            'data'=> 'Class was updated'
        ]);
    }


    public function deleteClassAssignToStaff(Request $request, $id)
    {
        $staff = $this->staff->find($id);
        $class = $this->class->find($request->classId);
        $classIds = $this->class->where('id', $class->id)
                    ->pluck('id')->toArray(); 
        
        $staff->classes()->detach($classIds);

        return response()->json([
            'success'=>true,
            'data'=> 'Class was removed'
        ]);
    }
}
