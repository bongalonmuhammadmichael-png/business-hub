
@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <div class="hero-layout">

            {{-- Hero introduction --}}
            <div class="hero-content hero-copy">

                <div class="eyebrow">
                    Business Management Platform
                </div>

                <h1>
                    Your business,
                    <span>organized.</span>
                </h1>

                <p class="hero-text">
                    Manage your team, track projects, review activity
                    and keep important business information organized
                    in one centralized workspace.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Get Started
                    </a>

                    <a href="{{ url('/about') }}" class="btn btn-secondary">
                        Learn More
                    </a>
                </div>

            </div>

            {{-- Visual workspace preview --}}
            <div class="hero-preview">
                <div class="preview-window">

                    <div class="preview-window-header">
                        <div class="preview-window-dots" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <span class="preview-window-label">
                            WORKSPACE PREVIEW
                        </span>
                    </div>

                    <div class="preview-window-body">

                        <div class="preview-heading">
                            <span class="preview-eyebrow">
                                YOUR WORKSPACE
                            </span>

                            <h2>Everything in view.</h2>

                            <p>
                                The tools you need to stay organized.
                            </p>
                        </div>

                        <div class="preview-feature">
                            <div class="preview-feature-icon preview-icon-blue">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="10" cy="7" r="4"/>
                                    <path d="M20 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>

                            <div class="preview-feature-copy">
                                <strong>Team management</strong>
                                <span>Users and access roles</span>
                            </div>

                            <span class="preview-arrow" aria-hidden="true">↗</span>
                        </div>

                        <div class="preview-feature">
                            <div class="preview-feature-icon preview-icon-purple">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
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

                            <div class="preview-feature-copy">
                                <strong>Project tracking</strong>
                                <span>Statuses and scheduled dates</span>
                            </div>

                            <span class="preview-arrow" aria-hidden="true">↗</span>
                        </div>

                        <div class="preview-feature">
                            <div class="preview-feature-icon preview-icon-green">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                                    <path d="M8 7h8"/>
                                    <path d="M8 11h8"/>
                                </svg>
                            </div>

                            <div class="preview-feature-copy">
                                <strong>Reports and activity</strong>
                                <span>History and CSV exports</span>
                            </div>

                            <span class="preview-arrow" aria-hidden="true">↗</span>
                        </div>

                        <div class="preview-footer">
                            <span class="preview-status-dot"></span>
                            Designed for a more organized workflow
                        </div>

                    </div>
                </div>
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
                The essentials, all in one place.
            </h2>

            <p class="section-text">
                Business Hub helps you manage people, organize projects
                and understand what's happening across your workspace.
            </p>

        </div>

        <div class="feature-grid">

            <div class="feature-card">
                <div class="feature-icon">01</div>

                <h3>Manage Your Team</h3>

                <p>
                    Organize user accounts, manage employee access
                    and maintain clear administrator permissions.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">02</div>

                <h3>Track Projects</h3>

                <p>
                    Create projects, update statuses, search records
                    and keep important project dates organized.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">03</div>

                <h3>Review Activity</h3>

                <p>
                    Follow recorded user and project actions through
                    a dedicated activity history.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">04</div>

                <h3>Understand Your Business</h3>

                <p>
                    Review live project and team summaries and export
                    project reports as CSV files.
                </p>
            </div>

        </div>

    </div>
</section>

@endsection
