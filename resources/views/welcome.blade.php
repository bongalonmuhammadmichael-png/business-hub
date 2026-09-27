@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <div class="hero-content">

            <div class="eyebrow">
                Business Management Platform
            </div>

            <h1>
                Your business,
                <span>organized.</span>
            </h1>

            <p class="hero-text">
                Business Hub brings your clients, employees, projects,
                tasks and daily business activities together in one
                centralized workspace.
            </p>

            <div class="hero-actions">
                <a href="#" class="btn btn-primary">
                    Get Started
                </a>

                <a href="{{ url('/about') }}" class="btn btn-secondary">
                    Learn More
                </a>
            </div>

        </div>
    </div>
</section>


<section class="section">
    <div class="container">

        <div class="section-header">

            <div class="section-label">
                One organized workspace
            </div>

            <h2 class="section-title">
                Everything your business needs in one place.
            </h2>

            <p class="section-text">
                Business Hub is designed to make everyday business
                management simpler, clearer and more organized.
            </p>

        </div>


        <div class="feature-grid">

            <div class="feature-card">
                <div class="feature-icon">01</div>

                <h3>Manage Clients</h3>

                <p>
                    Keep important client information organized and
                    accessible from one central location.
                </p>
            </div>


            <div class="feature-card">
                <div class="feature-icon">02</div>

                <h3>Track Projects</h3>

                <p>
                    Organize projects, monitor progress and keep your
                    team's work moving forward.
                </p>
            </div>


            <div class="feature-card">
                <div class="feature-icon">03</div>

                <h3>Manage Tasks</h3>

                <p>
                    Create, assign and track tasks so nothing important
                    gets lost in the daily workflow.
                </p>
            </div>

        </div>

    </div>
</section>

@endsection