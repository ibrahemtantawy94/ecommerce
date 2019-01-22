@extends('layout')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')
    <head>
        <style>
            #bttn{
                color: #f10053;
                border-radius: 5px;
            }
            #bttn:hover{
                background-color: #f10053;
                color: white;
            }
        </style>
    </head>

   <div class="thank-you-section">
       <h1>Thank you for <br> Your Order!</h1>
       <p>Your Order Will Be Shipped As Soon As Possible</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/') }}" class="button" id="bttn">Home Page</a>
       </div>
   </div>




@endsection
