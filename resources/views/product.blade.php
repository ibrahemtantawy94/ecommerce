@extends('layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')
<head>
    <style>
        #add{
            border: 1px solid #00B9B7;
            background-color: white;
            color: #00B9B7;
            border-radius: 10px;
        }
        #add:hover{
            background-color: #00B9B7;
            color: white;
        }
    </style>
</head>
    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('shop.index') }}">Shop</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Macbook Pro</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="product-section container">
        <div>
            <div class="product-section-image">
                <img src="{{ productImage($product->image) }}" alt="product" id="current-image" class="active">

                {{--<img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product">--}}
            </div>
            <div class="product-section-images">

                <div class="product-section-thumbnail selected">
                    <img src="{{ productImage($product->image) }}" alt="Product">
                </div>

                @if($product->images)
                    @foreach(json_decode($product->images , true) as $image)
                        <div class="product-section-thumbnail">
                            <img src="{{ productImage($image) }}" alt="Product">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>

            <p>
                {!! $product->description !!}
            </p>

            <p>&nbsp;</p>

            <form action="{{ route('cart.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <button type="submit" class="button" id="add">Add to Cart</button>
            </form>
        </div>
    </div> <!-- end product-section -->

    @include('partials.might-like')


@endsection

@section('extra-js')
    <script>
        (function () {
            const currentImage = document.querySelector('#current-image');
            const images = document.querySelectorAll('.product-section-thumbnail');

            images.forEach((element) => element.addEventListener('click',thumbnailClick));
            
            function thumbnailClick(e) {

                currentImage.classList.remove('active');

                currentImage.addEventListener('transitionend',()=>{
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                });

                images.forEach((element)=>element.classList.remove('selected'));
                this.classList.add('selected');
            }
        })();
    </script>
@endsection
