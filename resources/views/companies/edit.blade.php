@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 col-lg-9 col-sm-9 float-left card border-primary jumbotron " style= "margin-top: 15px; border-color: transparent !important;">
      <h1>Update company </h1>
        <div class="row col-md-12 col-lg-12 col-sm-12 card-body" style="margin: 10px;">            
          <form style="width: 100%" method="post" action="{{ route('companies.update',[$company->id]) }}">                
            @csrf 
            <input type="hidden" name="_method" value="put"> 

            <div class="form-group">
                <label for="company-name">Name<span class="required">*</span></label>
                <input placeholder="Enter name"
                      id="company-name"
                      required
                      name="name"
                      spellcheck="false"
                      class="form-control"
                      value="{{ $company->name }}" 
                      />
            </div>
            <div class="form-group">
                <label for="company-content">Description</label>
                <textarea placeholder="Enter description" 
                            style="resize: vertical" 
                            id="company-content"
                            name="description"
                            rows="5" spellcheck="false"
                            class="form-control autosize-target text-left">
                            {{ $company->description }}</textarea>
            </div>
            @if( Auth::user()->id != $company->user_id)
              <div class="form-group">
                  <a href="#" class="btn btn-secondary" style="cursor:auto">
                  Submit</a>
              </div>
            @else
              <div class="form-group">
                  <input type="submit" class="btn btn-primary"
                          value="Submit"/>
              </div>
            @endif               
          </form>
        </div>          
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 float-right" style="margin-top: 15px;" >        
      <div class="sidebar-module">
        <h4>Actions</h4>
        <ol class="list-unstyled">
          <li><a href="/companies/{{$company->id}}">View company</a></li> 
          <li><a href="/companies">All companies</a></li>
          <li><a href="/companies/mycompanies">My Companies</a></li>
          <li><a href="/companies/create">Create new company</a></li>

          <br>

          <li>
            @if( Auth::user()->id === $company->user_id || Auth::user()->id === 1)
              <a   
                href=""
                    onclick="
                    var result = confirm('Are you sure you wish to delete this Company?');
                        if( result ){ 
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                        }
                        else
                        {
                          return false
                        }"
              >
                    Delete
              </a>
            @endif
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