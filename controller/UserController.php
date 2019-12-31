<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function view()
    {
        $validation = $this->validate($this->request, [

        ]);

        $users = DB::table('users')
            ->where('id', '=', $this->request->user()->getAuthIdentifier());

        $count = $users->count();

        if($count === 1) {
            $user = new User((array)$users->first());

            $this->addResult('user', [
                'id' => $user->getAuthIdentifier(),
                'username' => $user->getAttribute('username'),
                'email' => $user->getAttribute('email'),
                'firstname' => $user->getAttribute('firstname'),
                'secondname' => $user->getAttribute('secondname'),
                'active' => $user->getAttribute('active'),
                'role' => $user->getRoleName(),
                'last_login' => $user->getLastLogin(),
            ]);
            $this->addMessage('success', 'Your User Data.');
        }
        else {
            $this->addMessage('success', 'User doesnt exists.');
        }

        return $this->getResponse();
    }
}
