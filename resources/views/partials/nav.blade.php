<header style="background-color: #18b6b6;">
    <div class="top-nav container">
        <div class="logo"><a href="/">Bestseller</a></div>
        @if (! request()->is('checkout'))
        <ul>
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li>
                <a href="{{ route('cart.index') }}">Cart <span class="cart-count">
                    @if (Cart::instance('default')->count() > 0)
                            <span>{{ Cart::instance('default')->count() }}</span></span>
                    @endif
                </a>
            </li>
            @guest
            <li><a href="{{route('login')}}">Login</a></li>
            <li><a href="{{route('register')}}">Register</a></li>
            @else
                <li>
                    <a href="{{route('users.edit')}}">My Profile</a>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endguest
        </ul>
        @endif
    </div> <!-- end top-nav -->
</header>
