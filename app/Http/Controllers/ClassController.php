<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    protected $class;

    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Class Variable to Class Model
        $this->class = new Classes;

    }

    public function index()
    {
        $classes = $this->class->get()->load(['student'])->toArray();
        try {
            return response()->json([
                'success'=>true,
                'count'=>count($classes),
                'data'=> $classes,
                
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
            'name' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->toArray()
            ], 400);
        }

        try {

            $this->class->name = $request->name;
            $this->class->description = $request->description;
            $this->class->save();

            $class = $this->class->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Class Saved Successfully',
                'data'=> $class
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
        $class = $this->class->find($id)->load(['student']);

        if(is_null($class)){
            return response()->json([
                'success'=>false,
                'message'=> "Class doesn't exist"
            ], 400);
        }

        return $class;
    }

    public function update(Request $request, $id)
    {
         $class = $this->class->find($id);

            if(is_null($class)){
                return response()->json([
                    'success'=>false,
                    'message'=> "Class doesn't exist"
                ], 400);
            }

            try {
                $class->update($request->all());

                return response()->json([
                    'success'=>true,
                    'message'=> 'Class Updated Successfully',
                    'data'=> $class
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
       
        $class = $this->class->find($id);

        if(is_null($class)){
            return response()->json([
                'success'=> false,
                'message'=> "Class doesn't exist"
            ], 400);
        }

        $book->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Class was removed"
        ], 200);
    }

    public function search($name)
    {
        
        $class = $this->class->where('name', 'like', '%'.$name.'%')->get();

        return response()->json([
            'success'=> true,
            'data' => $class
        ], 200);
    }

    public function getClassAndStaffById($id)
    {
        $class = $this->class->find($id);

        if(is_null($class)) {
            return response()->json([
                'success'=> false,
                'message'=> "Class doesn't exist"
            ], 400);
        }

        $classAndStaff = $class->staff;

        return response()->json([
            'success'=> true,
            'data'=> $classAndStaff
        ], 200);
    }

}
