<?php

namespace App\Http\Controllers;
use App\GoogleSign;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GoogleSignController extends Controller
{
    public function store (Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $this->object_error($validator->errors());
            return ['status'=>false,'message' => $errors,'type' => 'object'];
        }

        $email = $request->email;
        $name = $request->name;

        $GoogleSign = GoogleSign::where('email',$request->email)->first();
        if (!empty($GoogleSign)) {
            if ($GoogleSign->status == '1') {
                return ['status'=>true,'message' => 'active','type' => 'string'];
            }else{
                return ['status'=>false,'message' => 'deactive','type' => 'string'];
            }
        }else{
            $GoogleSign = new GoogleSign();
            $GoogleSign->email = $email;
            $GoogleSign->name = $name;

            if ($GoogleSign->save()) {
                return ['status'=>true,'message' => 'active','type' => 'string'];
            } 
        }
                        
    }
}
