<header>
    <nav class="d-flex justify-content-between align-items-center">
        <a href="http://127.0.0.1:8000/">
            <img class="ms_header-brand-logo" src="{{asset('images/logodone.svg')}}" alt="Toast-Rider Logo">
        </a>

        <ul class="mb-0">
            @guest
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
                @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}">Registrati</a>
                    </li>
                @endif
            @else
                <li>
                    <a id="navbarDropdown" class="d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if ($user->cover)
                            <div class="ms_profile-pic mr-2">
                                <img src="{{asset('storage/' . $user->cover)}}" alt="{{$user->business_name}}">
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center ms_profile-pic mr-2">
                                {{substr($user->business_name, 0, 1)}}
                            </div>
                        @endif
                        <span class="mr-1 ms_user-name-header">{{ Auth::user()->business_name }}</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
</header>