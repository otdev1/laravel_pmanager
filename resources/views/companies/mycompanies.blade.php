@extends('layouts.app')

@section('content')   
<div class="site-blocks-cover" style="background-image: url({{ asset('/images/hero_img1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
  <div style="padding-left: 5%; padding-top: 24%;">   
    <h1 class="mb-2 caption-color"><span class="font-weight-bold">The Largest and Most Comprehensive Business Directory </span> Site On The Net</h1>  
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-start text-left mb-5">
      <div class="col-md-9" data-aos="fade">
        <h2 class="font-weight-bold text-black">Companies</h2>
      </div>
      <div class="col-md-3" data-aos="fade" data-aos-delay="200">
        <a href="{{route('companies.create')}}" class="btn btn-primary py-3 btn-block"><span class="h5"></span> Add Company</a>
      </div>
    </div>
    <div class="row justify-content-start text-left mb-5">
      <div style="padding-left: 15px" data-aos="fade">
        <form class="typeahead" role="search">
            <div class="form-group">
              <input type="search" name="q" class="form-control search-input" placeholder="Search Companies..." autocomplete="off">
            </div>
        </form>
      </div>
    </div>
    @foreach($companies as $company)
    <div class="row" data-aos="fade">
      <div class="col-md-12">
        <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
          <div class="mb-4 mb-md-0 mr-5">
            <div class="job-post-item-header d-flex align-items-center">           
              <a href="/companies/{{ $company->id }}"><h2 class="mr-3 text-black h4">{{ $company->name }}</h2></a>             
            </div>
          </div> 
          <div class="ml-auto">     
            @guest
            <a href="/companies/{{ $company->id }}" class="btn btn-primary py-2 link-spacing">View</a>
            @else
              @if( Auth::user()->role_id === 1 || Auth::user()->id == $company->user_id)
              <a href="/companies/{{ $company->id }}" class="btn btn-primary py-2 link-spacing">View</a>
              <a href="/companies/{{ $company->id }}/edit" class="btn btn-primary py-2">Edit</a>
              @endif
            @endguest
          </div>
        </div>
      </div>
    </div>
    @endforeach
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
            url: '/findmycompanies?q=%QUERY%',
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
        name: 'mycompaniesList',
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
