@extends('layouts.app')

@section('content')

<p style="display:none">This template is used to display a list of all roles</p>

<div class="unit-5 overlay" style="background-image: url('images/img-2.jpg'); z-index: 1;">
      <div class="container text-center">
        <h2 class="mb-0">Roles</h2>
      </div>
</div>

<div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3" style="padding-top: 7em; padding-bottom: 7em;">
  <div class="card border-primary">
    <div class="card-header bg-primary" style="color: #fff">
      {{$role->name}}s 
    </div>
    <div class="card-body">
      <ul class="list-group">
        @foreach($users as $user)
        <li class="list-group-item">
          <span style="margin-right: 2%" >{{ $user->name }}</span> 
          <span>{{ $user->first_name }}</span>
          <span>{{ $user->last_name }}</span>

              <div style="float: right; display: inline;">
                <a style="margin-right: 8px" href="/users/{{$user->id}}">View</a>
                @if( Auth::user()->id == 1 || $user->id == Auth::user()->id )
                  <a style="margin-right: 8px" href="/users/{{$user->id}}/edit">Edit</a>
                  @if ($user->id == 4)
                  @else      
                  <div style="float: right;">
                    <form id="delete-form" action="/users/delete"  method="POST">
                      @csrf 
                      <input type="hidden" name="uid" value="{{$user->id}}">
                      <input type="submit"
                            class="input-submit-link"

                            value="Delete Profile"

                            onclick="
                              var result = confirm('Are you sure you wish to delete this user?');
                              if( result ){ 
                                      this.form.submit();}
                              else{
                                return false;
                              }"
                      />        
                    </form>
                  </div>
                  @endif
                @endif
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
            url: '/userfind?q=%QUERY%',
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
        
        name: 'userList',

        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            header: [
                '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function (data) {
                
                return '<a href="/users/'+  data.id +'" class="list-group-item">' + data.name + '</a>'
            }
        }
    });
  });
</script>

@endsection
