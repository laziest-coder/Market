<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('img/fr.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta charset="utf-8">
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />

		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/mixmarket.css') }}" rel="stylesheet">
		<script src="{{ asset('js/jquery.pjax.js') }}"></script>
		<script>
		$(document).pjax('li a','.pjax-container',{fragment: '.pjax-container'});
		</script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('market') }}"><center><img src="{{ asset('img/fr.png') }}" width="50px;" height="40px;"><center></a>
            </div>

            <ul class="nav">
                <li class="{{ Request::is('j-admin/orders*') ? "active" :""}} lia">
                    <a href="{{ url('j-admin/orders') }}">
                        <i class="fa fa-history"></i>
                       	<p>Заказы</p>
                    </a>
                </li>
                <li class="{{ Request::is('j-admin/category*') ? "active" :"" }} lia">
                    <a href="{{ route('addcategory') }}">
                        <i class="fa fa-list-alt"></i>
                        <p>Добавить категории</p>
                    </a>
                </li>
								<li>
                    <a href="{{ url('/market') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <p>Market</p>
                    </a>
                </li>
								<li class="{{ Request::is('j-admin/users*') ? "active" :"" }} lia">
                    <a href="{{ route('adminusers') }}">
                        <i class="fa fa-check"></i>
                        <p>Одобрение</p>
                    </a>
                </li>
								<li class="{{ Request::is('j-admin/allusers*') ? "active" :"" }} lia">
                    <a href="{{ route('allusers') }}">
                        <i class="fa fa-users"></i>
                        <p>Все Пользователи</p>
                    </a>
                </li>
								<li class="{{ Request::is('j-admin/allproducts*') ? "active" :"" }} lia">
                    <a href="{{ route('allproducts') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <p>Все Продукты</p>
                    </a>
                </li>
            </ul>
    	</div>
		</div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" id="tui">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>Выйти
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>
				<div class="pjax-container">
        	@yield('content')
				</div>
    </div>
</div>
</body>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="{{ asset('js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <!--  Google Maps Plugin    -->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ asset('js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="{{ asset('js/demo.js') }}"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('ul.nav li').click(function() {
			var that=$(this);
			$('ul.nav li').map(function (i,e) {
				if(that[0]!=e) $(this).removeClass('active')
				else $(this).addClass('active')
			})
		})
	</script>
</html>
