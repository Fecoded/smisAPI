<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    protected $session;

       public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Session Variable to Session Model
        $this->session = new Session;
    }

    public function index()
    {
        $user_token = $request->token;
        $user = auth('users')->authenticate($user_token);
        $user_id = $user->id;
        
        $session = $this->session->get()->load(['staff', 'student', 'parent'])->get();

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($session),
                'data'=> $session,
                
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
            'name' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'errors'=>$validator->errors()->all()
            ], 400);
        }

        try {

            $this->session->name = $request->name;
            $this->session->from = $request->from;
            $this->session->to = $request->to;
            $this->session->save();

            $session = $this->session->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Session Saved Successfully',
                'data'=> $session
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
        $session = $this->session->find($id)->load(['staff', 'student', 'parent']);

        if(is_null($session)){
            return response()->json([
                'success'=> false,
                'errors'=> "Session doesn't exist"
            ], 400);
        }

         return $session;
    }

    public function update(Request $request, $id)
    {
        $session = $this->getById($id);

        try {
            $session->update($request->all());

            return response()->json([
                'success'=>true,
                'message'=> 'Session Updated Successfully',
                'data'=> $session
            ], 200);

        } catch (Exception $err) {
            return response()->json([
                'success'=>false,
                'errors'=> $err->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $session = $this->getById($id);

        $session->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Session was removed"
        ], 200);
    }
}
