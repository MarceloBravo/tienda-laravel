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

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>
		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>
		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>

        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />
        <!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/skins/default.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme-custom.css') }}" />

        <link rel="stylesheet" href="{{ asset('css/admin/home.css') }}" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

        <!-- Head Libs -->
		<script src="{{ asset('admin/assets/vendor/modernizr/modernizr.js') }}"></script>

        @yield('style')

    </head>
	<body>	            
        @include('includes.admin.header')

        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">
            
            <div class="sidebar-header">
                <div class="sidebar-title">
                    Navegación
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    <span>Cuadro de mando</span>
                                </a>
                            </li>                            
                            <li class="nav-parent">
                                <a>
                                    <i class="fa fa-copy" aria-hidden="true"></i>
                                    <span>Páginas</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li>
                                        <a href="/admin/categorias">
                                                Categorías
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/marcas">
                                                Marcas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/productos">
                                                Productos
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-parent">
                                <a>
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                    <span>Administración</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li>
                                        <a href="/admin/pantallas">
                                                <i class="fa fa-group"></i>Pantallas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/roles">
                                                <i class="fa fa-group"></i>Roles
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/usuarios">
                                                <i class="fa fa-user"></i>Usuarios
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </aside>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
        @yield('Content')
        </section>

		<!-- FOOTER -->
		@include('includes.admin.footer')
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
        <script src="{{ asset('admin/assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		

        <!-- Vendor -->
        <script src="{{ asset('admin/assets/javascripts/theme.js') }}"></script>
        <script src="{{ asset('admin/assets/javascripts/theme.custom.js') }}"></script>
        <script src="{{ asset('admin/assets/javascripts/theme.init.js') }}"></script>
		@yield('script')

	</body>
</html>
