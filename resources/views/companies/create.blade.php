@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-9 col-lg-9 col-sm-9 float-left card border-primary jumbotron " style= "margin-top: 15px; border-color: transparent !important;">
        <h1>Create new company</h1>
            <div class="row col-md-12 col-lg-12 col-sm-12 card-body" style="margin: 10px;">
              <form style="width: 100%" method="post" action="{{ route('companies.store') }}">        
                @csrf 
                <div class="form-group">
                    <label for="company-name">Name<span class="required">*</span></label>
                    <input placeholder="Enter name"
                          id="company-name"
                          required
                          name="name"
                          spellcheck="false"
                          class="form-control" 
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
                                </textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary"
                            value="Submit"/>
                </div>
              </form>
            </div>        
      </div>
      <div class="col-sm-3 col-md-3 col-lg-3 float-right" style="margin-top: 15px;" > 
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/companies">All companies</a></li>
              <li><a href="/companies/mycompanies">My Companies</a></li>
            </ol>
          </div>      
      </div>
  </div>
</div>
@endsection