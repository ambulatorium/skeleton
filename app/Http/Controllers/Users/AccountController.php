<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image; 

class AccountController extends Controller
{
    public function edit()
    {
        return view('users.settings.account');
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, ['name' => 'required|string|max:255']);

        $user->fill($request->except('password'));
       
        if ($request->get('password')) {
            $this->validate($request, ['password' => 'required|string|min:6|confirmed']);

            $user->password = bcrypt($request->get('password'));
        }

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            $filename = time() . '.' . $avatar->getClientOriginalExtension(); 
            Image::make($avatar)->resize(60,60)->save( public_path('/img/' . $filename )); 

            $user->avatar = $filename; 
        }

        $user->save();
        
        flash('Successful! Your account updated.')->success();

        return redirect('/user/settings/account');
    }
}
