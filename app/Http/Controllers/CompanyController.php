<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->company_id == 1 && auth()->user()->isAdmin()){
            $companies = Company::all();

            return view('company.index', compact('companies'));
        } else {
            die();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->company_id == 1 && auth()->user()->isAdmin()){
            return view('company.create');
        } else {
            die();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->company_id == 1 && auth()->user()->isAdmin()){
            $company = Company::create([
                'company' => $request->company,
                'free_budget' => $request->free_budget,
            ]);

            \Session::flash('message', 'Company created');
            \Session::flash('alert-class', 'alert-success');

            return redirect()->route('company.show', $company);
        } else {
            die();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->company_id == 1 && auth()->user()->isAdmin()){
            $company = Company::find($id);

            return view('company.show', compact('company'));
        } else {
            die();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->company_id == 1 && auth()->user()->isAdmin()){
            $company = Company::find($id);

            return view('company.edit', compact('company'));
        } else {
            die();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->company_id == 1 && auth()->user()->isAdmin()){
            $company = Company::find($id);

            $company->update([
                'company' => $request->company,
                'free_budget' => $request->free_budget
            ]);

            \Session::flash('message', 'Company updated');
            \Session::flash('alert-class', 'alert-success');

            return redirect()->route('company.show', $company);
        } else {
            die();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
