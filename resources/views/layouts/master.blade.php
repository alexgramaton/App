<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('assets/css/dataTables.min.css')}}">
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="blue">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
        <div class="logo">
            <a href="#" class="simple-text logo-normal">
                Portugal Foods
            </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <ul class="nav">
								<li class="{{ 'users' == request()->path() ? 'active' : ''}}">
                    <a href="/users">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Customer Profiles</p>
                    </a>
                </li>
                <li class="{{ 'categories' == request()->path() ? 'active' : ''}}">
                    <a href="/categories">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Category List</p>
                    </a>
								</li>
								<li class="{{ 'subcategories' == request()->path() ? 'active' : ''}}">
                    <a href="/subcategories">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>List of subcategories</p>
                    </a>
								</li>
								<li class="{{ 'claims' == request()->path() ? 'active' : ''}}">
                    <a href="/claims">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>List of claims</p>
                    </a>
								</li>
								<li class="{{ 'companies' == request()->path() ? 'active' : ''}}">
                    <a href="/companies">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Companies</p>
                    </a>
								</li>
								<li class="{{ 'howItWorks' == request()->path() ? 'active' : ''}}">
                    <a href="/howItWorks">
                        <i class="now-ui-icons travel_info"></i>
                        <p>How it Works</p>
                    </a>
								</li>
								<li class="{{ 'termsOfUsage' == request()->path() ? 'active' : ''}}">
                    <a href="/termsOfUsage">
                        <i class="now-ui-icons text_align-center"></i>
                        <p>Terms of usage</p>
                    </a>
								</li>
								<li class="{{ 'privacyPolicy' == request()->path() ? 'active' : ''}}">
                    <a href="/privacyPolicy">
                        <i class="now-ui-icons text_align-left"></i>
                        <p>Privacy policy</p>
                    </a>
								</li>
            </ul>
        </div>
    </div>

    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
												<li class="nav-item dropdown">
													<a class="nav-link dropdown-toggle" id="navbarDropdown" class="nav-link dropdown-toggle" 		href="#" role="button" data-toggle="dropdown" 			aria-haspopup="true" aria-expanded="false" v-pre>
														 <i class="now-ui-icons users_single-02"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                      {{ __('Logout') }}
														</a>
														<form id="logout-form" action="{{ route('logout') }}" 		method="POST" style="display: none;">
                                        @csrf
                            </form>
                          </div>
												</li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="panel-header panel-header-sm">
        </div>

        <div class="content">
            @yield('content')
        </div>

        <footer class="footer">

        </footer>
    </div>
</div>

<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="{{asset('assets/js/dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
<script>
	@if (session('status'))
		swal({
  		title: '{{session('status')}}',
			icon: '{{session('statuscode')}}',
			timer: 2500,
		});
  @endif
</script>
@yield('scripts')
</body>

</html>
