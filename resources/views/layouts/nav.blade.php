<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('index') }}">
            Playdates R'Us
      </a>
    </div>

    <ul class="nav navbar-nav">

    @guest @else
      <li>
        <a class="navbar-brand" href="{{ route('home') }}">
                Home
        </a>
      </li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profiles <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('profile.index')}}">My Profile</a></li>
          <li><a href="/profile/edit">Edit profile</a></li>
          <li><a href="#">Search</a></li>
          <li><a href="#">Rate</a></li>
        </ul>
      </li>
    @endguest
      </ul>
    <ul class="nav navbar-nav navbar-right">
      @guest
        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> {{ __('Sign up') }}</a></li>
        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> {{ __('Login') }}</a></li>
      @else
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->name }}<span class="caret"></span></a>
          <ul class="dropdown-menu">
              @if(Auth::user()->isAdmin())
                <li>
                  <a class="dropdown-item" href="{{route('admin')}}">
                          {{ __('Admin') }}
                  </a>
                </li>
              @endif
              <li>
                  <a class="dropdown-item" href="{{ route('chat.index') }}">
                          {{ __('Chat') }}
                  </a>
              </li>
            
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
              </li>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form> 
          </ul>
        </li>
      @endguest
    </ul>
  </div>
</nav>