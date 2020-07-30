@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-8 mb-5" style= "margin-top: 15px;">       
      <div class="jumbotron">
          <h1>{{ $company->name }}</h1>
          <p class="lead">{{ $company->description }}</p>
      </div>
    </div>
    <div class="col-lg-4" style= "margin-top: 15px;">
      <div class="sidebar-module">
        <h4>Actions</h4>
        <ol class="list-unstyled">    
          <li><a href="/companies/{{$company->id}}/edit">Edit</a></li>  
          <li><a href="/companies">All companies</a></li>
          <li><a href="/companies/mycompanies">My Companies</a></li>
          <li><a href="/companies/create">Create new company</a></li>
          
          <br>

          <li> 
            @guest
            @else
            @if( Auth::user()->id === $company->user_id)
            <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this Company?');
                      if( result ){ 
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                      else
                      {
                        return false
                      }
                          "
                          >
                  Delete
            </a>
            @endif
            @endguest
            <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}" 
              method="POST" style="display: none;">  
                <input type="hidden" name="_method" value="delete">
                  @csrf  
            </form>  
          </li>
        </ol>
      </div>
    </div>            
  </div>
</div>   
@endsection