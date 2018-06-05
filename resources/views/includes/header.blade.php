<nav class="navbar navbar-expand-md navbar-dark bg-dark  mb-2">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
           SAPS Circulation
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('about.us') }}">About Us</a></li>
                    <li><a class="nav-link" href="{{ route('contact.us') }}">Contact Us</a></li>
                    <li><a class="nav-link" href="{{ route('login') }}">Home</a></li>


                @else
                    <li><a class="nav-link" href="{{ route('dashboard') }}">Entry</a></li>
                    <li><a class="nav-link" href="{{ route('circulations') }}">Circulations</a></li>
                    <li><a class="nav-link" href="{{ route('reports') }}">Access Reports</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>