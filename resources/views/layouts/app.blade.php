<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        @yield('style')

    </head>
	<body>
		<header>
			<!-- HEADER -->
			@include('includes.header')

			@yield('header')
			<!-- /HEADER -->
		</header>

		<!-- NAVIGATION -->
		@include('includes.navigation')
		<!-- /NAVIGATION -->

        @yield('Content')

		<!-- NEWSLETTER -->
		@include('includes.newsletter')
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		@include('includes.footer')
		<!-- /FOOTER -->

		@yield('script')

	</body>
</html>
