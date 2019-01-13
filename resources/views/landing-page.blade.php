<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Ecommerce Example</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <style>
            canvas{
                margin-top: -800px;
            }
            #viewMore{
                color: #00B9B7;
                border-radius: 10px;
                border: 1px solid #00B9B7;
            }
            #viewMore:hover{
                background-color: #18b6b6;
                color: white;
            }
        </style>

    </head>
    <body>
        <header class=""  id="particles-js" style="background-color: #18b6b6">
            <div class="top-nav container">
                <div class="logo">Laravel Ecommerce</div>
                <ul>
                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li><a href="#">About</a></li>
                    <li>
                        <a href="{{ route('cart.index') }}">Cart <span class="cart-count">
                            @if (Cart::instance('default')->count() > 0)
                            <span>{{ Cart::instance('default')->count() }}</span></span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div> <!-- end top-nav -->
            <div class="hero container">
                <div class="hero-copy">
                    <h1>Laravel Ecommerce Demo</h1>
                    <p style="margin-bottom:20px;">Includes multiple products, categories, <br>
                        a shopping cart and a checkout system with Stripe integration.</p>
                </div> <!-- end hero-copy -->

                <div class="hero-image">
                    <img src="img/macbook-pro-laravel.png" alt="hero image">
                </div> <!-- end hero-image -->
            </div> <!-- end hero -->
        </header>

        <div class="featured-section">

            <div class="container">
                <h1 class="text-center">Laravel Ecommerce</h1>

                <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.</p>

                <div class="text-center button-container">
                </div>

                <div class="products text-center">
                    @foreach ($products as $product)
                        <div class="product">
                            <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" alt="product"></a>
                            <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                            <div class="product-price">{{ $product->presentPrice() }}</div>
                        </div>
                    @endforeach

                </div> <!-- end products -->

                <div class="text-center button-container">
                    <a href="{{ route('shop.index') }}" class="button btn btn-success" id="viewMore">View more products</a>
                </div>

            </div> <!-- end container -->

        </div> <!-- end featured-section -->
        @include('partials.footer')

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.js"></script>
        <script>
            particlesJS.load('particles-js', 'js/particles.json', function() {
                console.log('callback - particles.js config loaded');
            });
        </script>
    </body>
</html>
