<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('home', ['companies'=> $companies]);  

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( Auth::check() ){

            return view('companies.create');
        }

        return view('auth.autologin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check())
        {
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);

            if($company){
                return redirect()->route('companies.show', ['company'=> $company->id])
                ->with('success' , 'Company created successfully');
            }

        }
        
        return back()->withInput()->with('errors', 'Error creating new company');
    }

    /**
     * Display the specified resource(i.e a single resource i.e company).
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id); 

        return view('companies.showcompany', ['company' => $company]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {

        if( Auth::check() ){
            $company = Company::find($company->id);

            return view('companies.edit', ['company' => $company]);
        }
        
        return view('auth.autologin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        
        $companyUpdate = Company::where('id', $company->id)
                                  ->update([
                                        'name'=> $request->input('name'), 
                                        'description'=> $request->input('description') 
                                  ]);

        if($companyUpdate){
            return redirect()->route('companies.show', ['company'=> $company->id]) 
            ->with('success' , 'Company updated successfully'); 
            
        }

        return back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $findCompany = Company::find( $company->id);

		if($findCompany->delete()){
            
            return redirect()->route('companies.index')->with('success' , 'Company deleted successfully');
        }

        return back()->withInput()->with('error' , 'Company could not be deleted');
    }

    public function my_companies()
    {
        if( Auth::check() ){ 
            $companies = Company::where('user_id', Auth::user()->id)->get(); 
            
            return view('companies.mycompanies', ['companies'=> $companies]);  
        }

        return view('auth.autologin'); 
    }

    public function showCompany( $company_id )
    {
        $company = Company::find($company_id); 

        return view('companies.showcompany', ['company' => $company]);   
    }
}
