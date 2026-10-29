
@extends('layouts.app')

@section('content')

<section class="page-header contact-page-header">
    <div class="container">

        <div class="section-label">
            Contact & Support
        </div>

        <h1>
            Let's make your workspace work better.
        </h1>

        <p>
            Need help getting started with Business Hub?
            Find the right next step for your account, your projects
            or your workspace.
        </p>

        <div class="contact-header-tags">
            <span>Account Access</span>
            <span>Project Management</span>
            <span>Getting Started</span>
        </div>

    </div>
</section>

<section class="section contact-options-section">
    <div class="container">

        <div class="section-header">
            <div class="section-label">
                How can we help?
            </div>

            <h2 class="section-title">
                Start with the right information.
            </h2>

            <p class="section-text">
                Choose the support option that best matches what
                you need help with.
            </p>
        </div>

        <div class="contact-options-grid">

            <article class="contact-option-card">
                <div class="contact-option-icon contact-option-blue">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>
                </div>

                <span class="contact-option-number">01 / ACCOUNT</span>

                <h3>Account & Access</h3>

                <p>
                    Having trouble accessing your account or need a
                    role or permission change? Contact your
                    Business Hub administrator.
                </p>

                <a href="{{ route('login') }}" class="contact-option-link">
                    Go to Log In
                    <span aria-hidden="true">→</span>
                </a>
            </article>

            <article class="contact-option-card">
                <div class="contact-option-icon contact-option-purple">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <path d="M8 8h8"/>
                        <path d="M8 12h5"/>
                        <path d="M8 16h8"/>
                    </svg>
                </div>

                <span class="contact-option-number">02 / WORKSPACE</span>

                <h3>Projects & Records</h3>

                <p>
                    Questions about project details, statuses or
                    workspace records? Ask your administrator to
                    review the information.
                </p>

                <a href="{{ url('/about') }}" class="contact-option-link">
                    Learn About Business Hub
                    <span aria-hidden="true">→</span>
                </a>
            </article>

            <article class="contact-option-card">
                <div class="contact-option-icon contact-option-green">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M12 3v12"/>
                        <path d="m7 10 5 5 5-5"/>
                        <path d="M5 21h14"/>
                    </svg>
                </div>

                <span class="contact-option-number">03 / GET STARTED</span>

                <h3>New to Business Hub?</h3>

                <p>
                    Explore the platform's current features and
                    create an account to get started with a more
                    organized workspace.
                </p>

                <a href="{{ route('register') }}" class="contact-option-link">
                    Create an Account
                    <span aria-hidden="true">→</span>
                </a>
            </article>

        </div>

    </div>
</section>

<section class="contact-help-section">
    <div class="container">

        <div class="contact-help-panel">

            <div class="contact-help-copy">
                <div class="section-label">
                    Need more information?
                </div>

                <h2>
                    Get to know Business Hub.
                </h2>

                <p>
                    Learn about the platform's purpose, available
                    tools and approach to organized business
                    management.
                </p>
            </div>

            <a href="{{ url('/about') }}" class="btn btn-primary">
                Explore About Us
            </a>

        </div>

    </div>
</section>

@endsection
