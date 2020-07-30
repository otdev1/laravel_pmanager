@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 float-left" style= "margin-top: 15px;">  
    <div class="jumbotron">
        <h1>{{ $company->name }}</h1>
        <p class="lead">{{ $company->description }}</p>
    </div>
    <div class="row col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;">
    @foreach($company->projects as $project)
        
    @endforeach

    
    </div>

            
</div>

    <div class="col-sm-3 col-md-3 col-lg-3 float-right" style="margin-top: 15px;" >
        
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
            
              <li><a href="/companies/{{$company->id}}/edit">Edit</a></li> 
              
              <li><a href="/companies/mycompanies">My Companies</a></li>
              <li><a href="/companies/create">Create new company</a></li>
              
                          
                <li>
                  
                  <a   
                    href="#"
                        onclick="
                        var result = confirm('Are you sure you wish to delete this Company?');
                            if( result ){ 
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();
                            }
                                "
                                >
                        Delete
                  </a>

                  <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}" 
                    method="POST" style="display: none;"> 
                            
                            <input type="hidden" name="_method" value="delete">
        
                  </form>
                     
                </li>
            </ol>
          </div>

          
        </div>

@endsection