
@extends('layouts.app')

@section('content')

<section class="page-header about-page-header">
    <div class="container">

        <div class="section-label">
            About Business Hub
        </div>

        <h1>
            Clarity for the work that keeps business moving.
        </h1>

        <p>
            Business Hub brings essential business management
            activities into one organized workspace, helping
            administrators manage people, track projects and
            understand what is happening across their team.
        </p>

        <div class="about-header-tags">
            <span>Team Management</span>
            <span>Project Tracking</span>
            <span>Business Reporting</span>
        </div>

    </div>
</section>

<section class="section about-purpose-section">
    <div class="container">

        <div class="about-purpose-grid">

            <div class="about-purpose-copy">

                <div class="section-label">
                    Our purpose
                </div>

                <h2 class="section-title">
                    Less scattered information. More organized work.
                </h2>

                <p>
                    Managing a business often means keeping track of
                    different people, projects, deadlines and records.
                    When that information is spread across separate
                    tools, it can be harder to stay organized.
                </p>

                <p>
                    Business Hub provides a centralized place to manage
                    user accounts, maintain project records, review
                    activity history and access business reports.
                </p>

            </div>

            <div class="about-purpose-panel">

                <div class="about-panel-label">
                    THE BUSINESS HUB APPROACH
                </div>

                <div class="about-approach-item">
                    <span class="about-approach-number">01</span>

                    <div>
                        <h3>Bring information together</h3>
                        <p>
                            Keep user and project records organized
                            in one application.
                        </p>
                    </div>
                </div>

                <div class="about-approach-item">
                    <span class="about-approach-number">02</span>

                    <div>
                        <h3>Maintain clear oversight</h3>
                        <p>
                            Use role-based access and activity records
                            to support administration.
                        </p>
                    </div>
                </div>

                <div class="about-approach-item">
                    <span class="about-approach-number">03</span>

                    <div>
                        <h3>Make information useful</h3>
                        <p>
                            Review project summaries and export
                            project data for further analysis.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<section class="section about-principles-section">
    <div class="container">

        <div class="section-header">

            <div class="section-label">
                What matters to us
            </div>

            <h2 class="section-title">
                Built around everyday business needs.
            </h2>

            <p class="section-text">
                Business Hub focuses on practical tools that make
                everyday administration clearer and more manageable.
            </p>

        </div>

        <div class="about-principle-grid">

            <article class="about-principle-card">
                <div class="feature-icon">01</div>

                <h3>Organization</h3>

                <p>
                    Structure project information, dates and statuses
                    so records are easier to review and maintain.
                </p>
            </article>

            <article class="about-principle-card">
                <div class="feature-icon">02</div>

                <h3>Accountability</h3>

                <p>
                    Review recorded user and project actions through
                    an activity history designed for administrators.
                </p>
            </article>

            <article class="about-principle-card">
                <div class="feature-icon">03</div>

                <h3>Visibility</h3>

                <p>
                    Access project summaries and downloadable reports
                    to better understand the current workspace.
                </p>
            </article>

        </div>

    </div>
</section>

<section class="about-cta-section">
    <div class="container">

        <div class="about-cta-content">
            <div>
                <h2>A more organized way to work starts here.</h2>

                <p>
                    Explore Business Hub and see how its tools
                    can help organize your everyday workflow.
                </p>
            </div>

            <a href="{{ route('register') }}" class="btn btn-primary">
                Get Started
            </a>
        </div>

    </div>
</section>

@endsection
