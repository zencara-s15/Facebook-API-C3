<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request){
        $user = $request->user();

        $validateData = $request->validated();

        $user->update($validateData);
        $user = $user->refresh();

        $success['user'] = $user;
        $success['success'] = true;
    }
}
