<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
   protected $payment_type;

    public function __construct()
    {
        $this->middleware('auth');

        $this->payment_type = new PaymentType;
    }

    public function index()
    {
        $payment_type = $this->payment_type->get()->load(['payment']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($payment_type),
                'data'=> $payment_type,
                
            ], 200);
        } catch (Exception $err) {
                return response()->json([
                'success'=>false,
                'errors'=>$err->getMessage()
            ], 500);
        }
    }

    public function getPaymentTypeBySchoolName(Request $request)
    {
        $user_token = $request->token;
        $user = auth('users')->authenticate($user_token);
        $user_id = $user->id;

        $user = User::find($user_id);
        $payment_type = $this->payment_type->where('schoolName', $user->schoolName)->get()->load(['payment']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($payment_type),
                'data'=> $payment_type,
                
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
            'name' => 'required|string',
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

            $this->payment_type->name = $request->name;
            $this->payment_type->description = $request->description;
            $this->payment_type->schoolName = $request->schoolName;
            $this->payment_type->save();

            $payment_type = $this->payment_type->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Payment Type Saved Successfully',
                'data'=> $payment_type
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
        $payment_type = $this->payment_type->find($id);

        if(is_null($payment_type)){
            return response()->json([
                'success'=>false,
                'errors'=> "Payment Type doesn't exist"
            ], 400);
        }

         return $payment_type;
    }

    public function update(Request $request, $id)
    {
        $payment_type = $this->getById($id);

        try {
            $payment_type->update($request->all());

            return response()->json([
                'success'=>true,
                'message'=> 'Payment Type Updated Successfully',
                'data'=> $payment_type
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
        $payment_type = $this->getById($id);

        $payment_type->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Payment Type was removed"
        ], 200);
    }
}
