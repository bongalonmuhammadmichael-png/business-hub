@extends('layouts.app')

@section('title', 'Business Hub — Home')

@section('content')

<section>

    <p>BUSINESS MANAGEMENT PLATFORM</p>

    <h1>
        Manage your business.
        <br>
        Move forward with confidence.
    </h1>

    <p>
        Business Hub brings clients, employees, projects,
        tasks and business activities together in one organized platform.
    </p>

    <div>
        <a href="{{ url('/login') }}">
            Get Started
        </a>

        <a href="{{ url('/about') }}">
            Learn More
        </a>
    </div>

</section>

@endsection