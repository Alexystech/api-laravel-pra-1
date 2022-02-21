<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;

class Contact extends Controller
{
    public function index() {
        $contact = auth()->user()->contact;
        return response()->json([
            'success'=>tre,
            'data'=>$contact
        ]);
    }

    public function show($id) {
        $contact = auth()->user()->contact()->find($id);

        if(!$contact) {
            return response()->json([
                'success'=>false,
                'message'=>'Blog is not avaible!'
            ],400);
        }

        return response()->json([
            'success'=>true,
            'data'=>$contact->toArray()
        ],400);
    }

    public function add(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'number'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Valiadtion Error.',$validator->errors());
        }

        $contact=Contact::create($input);

        return response()->json([
            'success'=>true,
            'data'=>$contact->toArray()
        ],200);
    }
    
    public function update(Request $request) {
        $input=$request->all();

        $validator=Validator::make($input, [
            'name'=>'required',
            'number'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.',$validator->errors());
        }

        $product=Product::find($request->product_id);
        $product->name=$input['name'];
        $product->number=$input['number'];
        $product->save();

        return response()->json([
            'success'=>true,
            'data'=>$contact->toArray()
        ],200);
    }
}
