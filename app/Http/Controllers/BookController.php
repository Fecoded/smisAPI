<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $book;

    public function __construct()
    {
        // Middleware to Protect a Route
        $this->middleware('auth');

        // Contacts Variable to Contacts Model
        $this->book = new Book;

    }

    public function index()
    {
        $books = $this->book->get()->toArray();
        try {
            return response()->json([
                'success'=>true,
                'count'=>count($books),
                'data'=> $books,
                
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
        if (Gate::allows('access-users', auth()->user())) 
        {
            $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'authorName' => 'required',
                'publishedDate' => 'required',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'success'=>false,
                    'message'=>$validator->messages()->toArray()
                ], 400);
            }

            try {

                $this->book->name = $request->name;
                $this->book->authorName = $request->authorName;
                $this->book->publishedDate = $request->publishedDate;
                $this->book->save();

                $book = $this->book->refresh();

                return response()->json([
                    'success'=>true,
                    'message'=> 'Book Saved Successfully',
                    'data'=> $book
                ], 201);

            } catch (Exception $err) {
                return response()->json([
                    'success'=>false,
                    'message'=> $err->getMessage()
                ], 500);
            }
        } else 
        {
             return response()->json([
                    'success'=>false,
                    'message'=>"User not authorized to access this route"
                ], 403);
        }
       
    }

  
    public function getById($id)
    {
        $book = $this->book->find($id);

        if(is_null($book)){
            return response()->json([
                'success'=>false,
                'message'=> "Book doesn't exist"
            ], 400);
        }

        return $book;
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('access-users', auth()->user())) 
        {
                $book = $this->book->find($id);

            if(is_null($book)){
                return response()->json([
                    'success'=>false,
                    'message'=> "Book doesn't exist"
                ], 400);
            }

            try {
                $book->update($request->all());

                return response()->json([
                    'success'=>true,
                    'message'=> 'Book Updated Successfully',
                    'data'=> $book
                ], 200);

            } catch (Exception $err) {
                return response()->json([
                    'success'=>false,
                    'message'=> $err->getMessage()
                ], 500);
            }
        }
        else
        {
             return response()->json([
                'success'=>false,
                'message'=>"User not authorized to access this route"
            ], 403);
        }
       
    }

    public function delete($id)
    {
        if (Gate::allows('access-user', auth()->user())) 
        {
            $book = $this->book->find($id);

            if(is_null($book)){
                return response()->json([
                    'success'=> false,
                    'message'=> "Book doesn't exist"
                ], 400);
            }

            $book->delete();

            return response()->json([
                'success'=> true,
                'message'=> "Book was removed"
            ], 200);
        }
        else
        {
            return response()->json([
                'success'=>false,
                'message'=>"User not authorized to access this route"
            ], 403);
        }
        
    }

    public function search($name)
    {
        if (Gate::allows('access-users', auth()->user())) 
        {
            $book = $this->book->where('name', 'like', '%'.$name.'%')->get();
    
            return response()->json([
                'success'=> true,
                'data' => $book
            ], 200);
        }else
        {
            return response()->json([
                'success'=>false,
                'message'=>"User not authorized to access this route"
            ], 403);
        }

    }
}
