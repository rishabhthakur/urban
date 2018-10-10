@extends('layouts.public.app')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <section class="section mb-5 pb-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6 offset-md-3">
                    <div class="text-center">
                        <div class="user-img mb-5">
                            <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle" style="width: 80px">
                        </div>
                        <h6>Hello {{ Auth::user()->name }}</h6>
                        (not {{ Auth::user()->name }}? <a class="text-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>).
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <p class="mt-3">
                            From your account dashboard you can view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and edit your <a href="#">password and account details</a>.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-2 mb-5">
                    <ul class="nav flex-column">
                        @if (Auth::user()->admin)
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! route('admin') !!}">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link active" href="{!! route('account') !!}">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{!! route('account.details') !!}">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('account.addresses') !!}">Addresses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('account.wishlist') !!}">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('account.orders') !!}">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-8 mb-4">
                    @yield('section')
                </div>

                <div class="col-md-2 mb-4">
                    <div class="">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
