<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>@yield('title')</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/ion.rangeSlider.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/video-js.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.css') }}">

	{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet"> --}}

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body data-instant-intensity="mousedown">

<div class="bg-light top-header">
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				<a href="{{ route('front.home') }}" class="text-decoration-none">
					<span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
					<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
                @if (Auth::check())
                    <a href="{{ route('account.profile') }}" class="nav-link text-dark">My Account</a>
                    <a href="" class="nav-link text-info">{{ Auth::user()->email }}</a>
                @else
                    <a href="{{ route('account.login') }}" class="nav-link text-dark">Login/Register</a>
                @endif
				{{-- <a href="{{ route('account.profile') }}" class="nav-link text-dark">My Account</a> --}}
				<form action="{{ route('front.shop') }}" method="GET">
					<div class="input-group">
						<input value="{{ Request::get('search') }}" type="text" placeholder="Search For Products" class="form-control" name="search" id="search">
						<button type="submit" class="input-group-text">
							<i class="fa fa-search"></i>
					  	</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@include('front.layouts.header')
@yield('content')
@include('front.layouts.footer')


  <!-- Wish list Modal -->
  <div class="modal fade" id="wishlistModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Success</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
<script src="{{ asset('front_assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('front_assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
{{-- <script src="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}"></script> --}}
<script src="{{ asset('front_assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front_assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front_assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front_assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front_assets/js/custom.js') }}"></script>

<script src="{{ asset('fontawesome-free-6.5.1-web/js/all.js') }}"></script>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
<script>
    $.ajaxSetup({

        headers:
        {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }

    });
</script>


<script type="text/javascript">

    function addToCart(id)
    {
        // alert(id);

        $.ajax({

            url: '{{ route("front.addToCart") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function (response){


                if (response.status == true)
                {
                    window.location.href="{{ route('front.cart') }}";
                }
                else
                {
                    alert(response.message);
                }

            }


        });
    }

</script>


<script>
     function addToWishlist(id)
    {
        // alert(id);

        $.ajax({

            url: '{{ route("front.addToWishlist") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function (response){


                if (response.status == true)
                {
                    $("#wishlistModel .modal-body").html(response.message);
                    $("#wishlistModel").modal('show');
                }
                else
                {
                    window.location.href="{{ route('account.login') }}";
                    // alert(response.message);
                }

            }


        });
    }
</script>


@yield('customjs')
</body>
</html>


