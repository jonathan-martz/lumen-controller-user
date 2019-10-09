<?php

namespace App\Http\Controllers;

use \http\Env\Response;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param  Request  $request
     * @return Response
     */
    public function view(Request $request){
        $validation = $this->validate($request, [

        ]);

        $todo = DB::table('users')
            ->where('id','=',$request->user()->getAuthIdentifier());

        $count = $todo->count();

        if($count === 1){
            $this->addResult('user',$todo->first());
            $this->addMessage('success','Your User Data.');
        }
        else{
            $this->addMessage('success','User doesnt exists.');
        }

        return $this->getResponse();
    }
}
