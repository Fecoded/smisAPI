<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Student Model
        $this->student = new Student;
    }

    public function index(Request $request)
    {
        
        $student = $this->student->get()->load(['classes','parent']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($student),
                'data'=> $student,
                
            ], 200);
        } catch (Exception $err) {
                return response()->json([
                'success'=>false,
                'errors'=>$err->getMessage()
            ], 500);
        }
    }

    public function getStudentsBySchoolName(Request $request, $id)
    {
        $user = User::find($id);
        $student = $this->student->where('schoolName', $user->schoolName)->get()->load(['classes','parent']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($student),
                'data'=> $student,
                
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
            'surname' => 'required|string',
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|string',
            'houseAddress' => 'required|string',
            'placeOfBirth' => 'required|string',
            'religion' => 'required|string',
            'nationality' => 'required|string',
            'stateOfOrigin' => 'required|string',
            'emergencyContact' => 'required|string',
            'dateOfRegistration' => 'required|string',
            'parentId' => 'required|string',
            'classId' => 'required|string',
            'sessionId' => 'required|string',
            'schoolName' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'errors'=>$validator->messages()->all()
            ], 400);
        }

        try {

            $this->student->surname = $request->surname;
            $this->student->firstname = $request->firstname;
            $this->student->middlename = $request->middlename;
            $this->student->gender = $request->gender;
            $this->student->dob = $request->dob;
            $this->student->houseAddress = $request->houseAddress;
            $this->student->placeOfBirth = $request->placeOfBirth;
            $this->student->religion = $request->religion;
            $this->student->nationality = $request->nationality;
            $this->student->stateOfOrigin = $request->stateOfOrigin;
            $this->student->emergencyContact = $request->emergencyContact;
            $this->student->dateOfRegistration = $request->dateOfRegistration;
            $this->student->parentId = $request->parentId;
            $this->student->classId = $request->classId;
            $this->student->sessionId = $request->sessionId;
            $this->student->schoolName = $request->schoolName;
            $this->student->save();

            $student = $this->student->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Student Saved Successfully',
                'data'=> $student
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
        $student = $this->student->find($id)->load(['classes','parent']);

        if(is_null($student)){
            return response()->json([
                'success'=>false,
                'errors'=> "Student doesn't exist"
            ], 400);
        }

         return $student;
    }

 
    public function update(Request $request, $id)
    {
       $student = $this->getById($id);

        try {
            $student->update($request->all());

            return response()->json([
                'success'=>true,
                'message'=> 'Student Updated Successfully',
                'data'=> $student
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
        $student = $this->getById($id);


        $student->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Student was removed"
        ], 200);
    }

    public function promote(Request $request, $id)
    {
        $student = $this->getById($id);

         try {
            $student->classId = $request->classId;
            $student->save();

            return response()->json([
                'success'=>true,
                'message'=> 'Promotion was Successfully',
                'data'=> $student
            ], 200);

        } catch (Exception $err) {
            return response()->json([
                'success'=>false,
                'errors'=> $err->getMessage()
            ], 500);
        }
    }
}
