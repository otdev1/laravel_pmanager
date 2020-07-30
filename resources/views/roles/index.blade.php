@extends('layouts.app')

@section('content')



<div class="unit-5 overlay" style="background-image: url('images/img-2.jpg'); z-index: 1;">
      <div class="container text-center">
        <h2 class="mb-0">Roles</h2>
      </div>
</div>

<div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3" style="padding-top: 7em; padding-bottom: 7em;">
  <div class="card border-primary">
    <div class="card-header bg-primary" style="color: #fff">
      Roles 
    </div>
    <div class="card-body">
      <ul class="list-group">
        @foreach($default_roles as $default_role)
        <li class="list-group-item"> 
          <span>{{ $default_role->name}}s</span> 
          <div style="float: right;">
            <a href="/roles/{{ $default_role->id }}">View</a> 
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
                url: '/rolefind?q=%QUERY%',
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
            
            name: 'roleList',

            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function (data) {
                    return '<a href="/roles/'+  data.id +'" class="list-group-item">' + data.name + '</a>'
                }
            }
        });
    });
</script>
@endsection
