<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ config('app.name') }} | 404 Page not found</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/vendor/bootstrap/css/bootstrap.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/fonts/font-awesome-4.7.0/css/font-awesome.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/fonts/iconic/css/material-design-iconic-font.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/vendor/animate/animate.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/vendor/select2/select2.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/css/util.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('splash/css/main.css') !!}">
<!--===============================================================================================-->
</head>
<body>



	<div class="flex-w flex-str size1 overlay1">
		<div class="flex-w flex-col-sb wsize1 bg0 p-l-65 p-t-37 p-b-50 p-r-80 respon1">
			<div class="wrappic1">
				<a href="{!! route('home') !!}">
					<img src="{!! asset('img/logo-black.png') !!}" alt="{{ config('app.name') }}">
				</a>
			</div>

			<div class="w-full flex-c-m p-t-80 p-b-90">
				<div class="wsize2">
					<h1 class="l2-txt1 p-b-34 respon3">
						404
					</h1>

					<p class="m2-txt1 p-b-46">
						Sorry for the inconvenience but it seems like the page you are looking for does not exist.
					</p>

					<p class="m2-txt1 p-b-46">
						<a href="{!! route('home') !!}" class="color-black">< Go back home</a>
					</p>

					{{-- <form class="contact100-form validate-form m-t-10 m-b-10">
						<div class="wrap-input100 validate-input m-lr-auto-lg" data-validate = "Email is required: ex@abc.xyz">
							<input class="s2-txt1 placeholder0 input100 trans-04" type="text" name="email" placeholder="Email address to get notified">

							<button class="flex-c-m ab-t-r size2 hov1">
								<i class="zmdi zmdi-long-arrow-right fs-30 cl1 trans-04"></i>
							</button>
						</div>
					</form> --}}
				</div>
			</div>

			<div class="flex-w">
				<a href="#" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10">
					<i class="fa fa-facebook"></i>
				</a>

				<a href="#" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10">
					<i class="fa fa-twitter"></i>
				</a>

				<a href="#" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10">
					<i class="fa fa-youtube-play"></i>
				</a>
			</div>
		</div>


		<div class="wsize1 simpleslide100-parent respon2">
			<!--  -->
			<div class="simpleslide100">
				<div class="simpleslide100-item bg-img1" style="background-image:
                url('{!! asset('splash/images/bg01.jpg') !!}');"></div>
				<div class="simpleslide100-item bg-img1" style="background-image:
                url('{!! asset('splash/images/bg02.jpg') !!}');"></div>
				<div class="simpleslide100-item bg-img1" style="background-image:
                url('{!! asset('splash/images/bg03.jpg') !!}');"></div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="{!! asset('splash/vendor/jquery/jquery-3.2.1.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('splash/vendor/bootstrap/js/popper.js') !!}"></script>
	<script src="{!! asset('splash/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('splash/vendor/select2/select2.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('splash/vendor/tilt/tilt.jquery.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('splash/js/main.js') !!}"></script>

</body>
</html>
