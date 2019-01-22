@extends('layout')

@section('title', 'Orders')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span><a href="{{route('orders.index')}}">My Orders</a></span>
        </div>
    </div>

    <br>
        <div class="container">
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="products-section container">
            <div class="sidebar">
                <ul>
                    <li><a href="{{route('users.edit')}}">My Profile</a></li>
                    <li class="active"><a href="{{route('orders.index')}}">My Orders</a></li>
                </ul>
            </div> <!-- end sidebar -->
            <div class="my-profile">
                <div class="products-header">
                    <h1 class="stylish-heading">My Orders</h1>
                </div>
                <div class="container">
                    @foreach ($orders as $order)
                        <div>Order id :{{ $order->id }}</div>
                        <div><a href="{{route('orders.show',$order->id)}}">Order Details</a></div>
                        <div>Order Total :{{ $order->billing_total }}</div>
                        @foreach ($order->products as $product)
                                <div>Product :{{$product->name}}</div>
                            {{--<div><img src="{{ asset($product->image) }}" alt="Product Image"></div>--}}
                            {{--<div>{{ asset($product->image) }}</div>--}}
                            <div>{{$product->details}}</div>
                            @endforeach
                        <div class="spacer"></div>
                    @endforeach
                </div> <!-- end products -->
                <div class="spacer"></div>
            </div>

    </div>



@endsection
