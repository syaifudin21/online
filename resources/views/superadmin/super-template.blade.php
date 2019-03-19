<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="{{env('APP_DESKRIPSI')}}">
   
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{env('APP_NAME')}}">
    <meta property="og:title" content="{{env('APP_NAME')}}">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="{{env('APP_DESKRIPSI')}}">
    <title>{{env('APP_NAME')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="icon" href="{{asset(env('APP_LOGO'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!-- Font-icon css-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
  <header class="app-header" style="background-color: {{env('THEME_COLOR_1')}}">
    <a class="app-header__logo"  style="font-size: 12px;"  href="{{url('outlet')}}">{{env('APP_NAME')}}</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <form action="{{url('invoice.cari')}}" method="post"> @csrf
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search" name="invoice">
          <button class="app-search__button" type="submit"><i class="fa fa-search"></i></button>
        </li>
        </form>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">You have 4 new notifications.</li>
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Lisa sent you a mail</p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div></a>
              </li>
              </div>
            </div>
            <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            {{-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li> --}}
            <li><a class="dropdown-item" href="{{ route('superadmin.profil') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('superadmin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i>  {{ __('Logout') }}</a></li>
            <form id="logout-form" action="{{ route('superadmin.logout') }}" method="POST">
                    {{ csrf_field() }}
            </form>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar" style="background-color: {{env('THEME_COLOR_3')}}">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{asset(env('APP_LOGO'))}}" alt="User Image" style="max-height: 64px; max-width: 64px">
        <div>
          <p class="app-sidebar__user-name">Admin</p>
       
          <p class="app-sidebar__user-name"><small>Super Admin</small></p>
        </div>
      </div>
      <ul class="app-menu">

        <li><a class="app-menu__item {{(Request::is('superadmin'))? 'active': ''}}" href="{{route('superadmin.home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        
        <li><a class="app-menu__item {{(Request::is('superadmin/kurikulum') OR \Request::is('superadmin/kurikulum/*'))? 'active': ''}}" href="{{route('superadmin.kurikulum.home')}}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Kurikulum</span></a></li>

        <li><a class="app-menu__item {{(Request::is('superadmin/ta') OR \Request::is('superadmin/ta/*'))? 'active': ''}}" href="{{route('superadmin.ta.home')}}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Tahun Ajaran</span></a></li>

      </ul>
    </aside>
    @yield('content')

    <!-- Essential javascripts for application to work-->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('js/plugins/pace.min.js')}}"></script>
    <!-- Page specific javascripts-->
    
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    
    <!-- Google analytics script-->
    @yield('script')
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
      $("form").submit(function(){
           $(this).find(':submit').prop('disabled', true);
      });
    </script>
    
    @if(Session::has('alert'))
    <script>
        swal({
          {!!Session::get('alert')!!}
        });
    </script>
    @endif
  </body>
</html>