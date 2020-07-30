@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3" style="margin-top: 15px;">
    <form class="typeahead" role="search">
        <div class="form-group">
          <input type="search" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
        </div>
    </form>
    <style>
        .input-group > .twitter-typeahead {
          flex: 1 1 auto;
          width: auto;
        }      
    </style>
    <div class="card border-primary">
      <div class="card-header bg-primary">
        Companies <a class="float-right btn btn-primary btn-sm" href="/companies/create">Create new company</a>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @foreach($companies as $company)
            <li class="list-group-item"> 
              <a href="/companies/{{ $company->id }}">{{ $company->name }}</a>
              <div style="float: right;">
                <a href="/companies/{{$company->id}}/edit">Edit</a>
                <a   
                    href=""
                    onclick="
                        var result = confirm('Are you sure you wish to delete this Company?');
                        if( result ){ 
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                        }"
                >
                    Delete
                </a>
                <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}" 
                  method="POST" style="display: none;">            
                  <input type="hidden" name="_method" value="delete">            
                  @csrf  
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins  and Typeahead) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<!-- Typeahead.js Bundle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>


<!-- Typeahead Initialization -->
<script>
  jQuery(document).ready(function($){
    var engine = new Bloodhound({
        remote: {
            url: '/find?q=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 2
      },
      {
        source: engine.ttAdapter(),       
        name: 'companyList',     
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            header: [
                '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function (data) {
                return '<a href="/companies/'+  data.id +'" class="list-group-item">' + data.name + '</a>'
            }
        }
      });
  });
</script>
@endsection
