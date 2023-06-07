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
    public function index($companyid = null) {
        if($companyid){
            $company = Company::find($companyid);
        } else {
            $company = null;
        }

        return view('users.index', [
            'company' => $company
        ]);
    }


    public function create()
    {
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

        $data['company_id'] = isset($request->company_id) ? $request->company_id : auth()->user()->company_id;

        $user = User::create(request(['name','email','password']));

        $user->company_id = isset($request->company_id) ? $request->company_id : auth()->user()->company_id;

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

    public function update(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data['company_id'] = isset($request->company_id) ? $request->company_id : auth()->user()->company_id;

        $user->update($data);

        \Session::flash('message', 'User updated');
		\Session::flash('alert-class', 'alert-success');

        return redirect()->action('UsersController@show', $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('users/' . $user->company_id)->with('message', 'You Successfully Deleted a User.');
    }

    public function createNew()
    {
        $user = new User();

        return view('users.create', [
            'user' => $user
        ]);

    }

    protected function storeNew()
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
}
