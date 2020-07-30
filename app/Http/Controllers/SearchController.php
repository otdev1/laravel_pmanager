<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function find(Request $request)
    {
        $search = $request->get('q');

        $result = Company::where('name', 'LIKE', '%'.$search. '%')->get();

        return response()->json($result);
    }

    public function projectfind(Request $request)
    {
        $search = $request->get('q');

        $result = Project::where('name', 'LIKE', '%'.$search. '%')->get();

        return response()->json($result);
    }

    public function userfind(Request $request)
    {
        $search = $request->get('q');

        $result = User::where('name', 'LIKE', '%'.$search. '%')->orWhere('first_name', 'LIKE', '%'.$search. '%')
                  ->orWhere('last_name', 'LIKE', '%'.$search. '%')->get();

        return response()->json($result);
    }

    public function findmycompanies(Request $request)
    {
        $search = $request->get('q');

        $result = Company::where([
                                    ['name', 'LIKE', '%'.$search.'%'],
                                    ['user_id', '=', Auth::user()->id]
                                    
                                ])->get();

        return response()->json($result);
    }
}
