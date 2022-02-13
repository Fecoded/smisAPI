<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $payment;

    public function __construct()
    {
        $this->middleware('auth');

        $this->payment = new Payment;
    }
  
    public function index()
    {
        $payment = $this->payment->get()->load(['payment_type']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($payment),
                'data'=> $payment,
                
            ], 200);
        } catch (Exception $err) {
                return response()->json([
                'success'=>false,
                'errors'=>$err->getMessage()
            ], 500);
        }
        
    }

    public function getPaymentsBySchoolName(Request $request, $id)
    {
        $user = User::find($id);
        $payment = $this->payment->where('schoolName', $user->schoolName)->get()->load(['payment_type']);

        try {
            return response()->json([
                'success'=>true,
                'count'=>count($payment),
                'data'=> $payment,
                
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
            'fullname' => 'required|string',
            'class' => 'required|string',
            'paidDate' => 'required|string',
            'paymentTypeId' => 'required|string',
            'amount' => 'required|string',
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

            $this->payment->fullname = $request->fullname;
            $this->payment->class = $request->class;
            $this->payment->paidDate = $request->paidDate;
            $this->payment->paymentTypeId = $request->paymentTypeId;
            $this->payment->amount = $request->amount;
            $this->payment->schoolName = $request->schoolName;
            $this->payment->sessionId = $request->sessionId;
            $this->payment->save();

            $payment = $this->payment->refresh();

            return response()->json([
                'success'=>true,
                'message'=> 'Payment Saved Successfully',
                'data'=> $payment
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
        $payment = $this->payment->find($id);

        if(is_null($payment)){
            return response()->json([
                'success'=>false,
                'errors'=> "Payment doesn't exist"
            ], 400);
        }

         return response()->json([
            'success'=> true,
            'data'=> $payment
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $payment = $this->payment->find($id);

        if(is_null($payment)){
            return response()->json([
                'success'=>false,
                'errors'=> "Payment doesn't exist"
            ], 400);
        }

        try {
            $payment->update($request->all());

            return response()->json([
                'success'=>true,
                'message'=> 'Payment Updated Successfully',
                'data'=> $payment
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
        $payment = $this->payment->find($id);

        if(is_null($payment)){
            return response()->json([
                'success'=> false,
                'errors'=> "Payment doesn't exist"
            ], 400);
        }

        $payment->delete();

        return response()->json([
            'success'=> true,
            'message'=> "Payment was removed"
        ], 200);
    }
}
