<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Show a list of the users based on the current logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($companyid) {
        $company = Company::find($companyid);

        return view('users.index', [
            'company' => $company
        ]);
    }


    public function create()
    {
        $user = User::all();
        $user = new User();

        return view('users.create', [
            'user' => $user
        ]);

    }

    protected function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create(request(['name','email','password']));

        $user->company_id = auth()->user()->company_id;

        $user->save();

        return redirect()->to('users/' . $user->company_id)->with('message', 'You Successfully Created a New User.');
        
    }

    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update($data);

        return redirect('users/user/' . $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('users/' . $user->company_id)->with('message', 'You Successfully Deleted a User.');
    }
}
