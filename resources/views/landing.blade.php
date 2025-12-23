<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'THE CONTENANTAL') }} - Guild Quest System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>

    <!-- Background layer -->
    <div class="bg-blur"></div>

    <!-- Main Hero Box -->
    <div class="OuterDiv">
        <div class="InnerDiv">

            <!-- Top Navigation Bar -->
            <div class="Navbar">
                <!-- Logo -->
                <div class="Logo">
                    <i class="fas fa-torii-gate"></i>
                    <span>THE CONTENANTAL</span>
                </div>

                <!-- Center Navigation Links -->
                <div class="NavLinks">
                    <a href="#about">About</a>
                    <a href="#features">Features</a>
                    <a href="#contact">Contact</a>
                </div>

                <!-- Right Buttons -->
                <div class="TopButtons">
                    <button class="joinGuild" onclick="window.location.href='{{ url('register') }}'">
                        Join Guild
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrollable Content Below -->
    <div class="ScrollableContent">

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="container">
                <h2 class="section-title">What is The Contenantal?</h2>
                <p class="section-subtitle">A gamified quest management system where skills meet rewards</p>

                <div class="about-content-simple">
                    <p class="about-description">
                        The Contenantal is a revolutionary task management platform where <strong>Hunters</strong>
                        take on challenging quests and <strong>Clients</strong> post bounties. Everyone earns
                        rewards for their contributions.
                    </p>
                    <p class="about-description">
                        Rise through the ranks from F to S-Class, earn gold and experience points, and become
                        a legendary hunter. Every completed quest brings you closer to glory!
                    </p>

                    <div class="about-benefits">
                        <div class="benefit-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Complete quests and earn rewards</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Climb from F-Rank to S-Rank</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Track your progress in real-time</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section" id="features">
            <div class="container">
                <h2 class="section-title">Choose Your Path</h2>
                <p class="section-subtitle">Two unique roles to suit your playstyle</p>

                <div class="features-grid-two">
                    <!-- Hunter Card -->
                    <div class="feature-card">
                        <div class="feature-icon hunter-icon">
                            <i class="fas fa-user-ninja"></i>
                        </div>
                        <h3 class="feature-title">Hunters</h3>
                        <p class="feature-description">
                            Accept quests, complete challenges, and earn XP & Gold.
                            Rise through the ranks and become a legendary S-Class Hunter.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-star"></i> Accept quests from the board</li>
                            <li><i class="fas fa-star"></i> Submit proof of completion</li>
                            <li><i class="fas fa-star"></i> Earn XP and Gold rewards</li>
                            <li><i class="fas fa-star"></i> Climb the ranking system</li>
                        </ul>
                        <a href="{{ url('register') }}?role=hunter" class="feature-btn">Become a Hunter</a>
                    </div>

                    <!-- Client Card -->
                    <div class="feature-card">
                        <div class="feature-icon client-icon">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <h3 class="feature-title">Clients</h3>
                        <p class="feature-description">
                            Post bounties and quests for Hunters to complete.
                            Set rewards and track progress on your requests.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-star"></i> Create custom quests</li>
                            <li><i class="fas fa-star"></i> Set difficulty & rewards</li>
                            <li><i class="fas fa-star"></i> Track quest progress</li>
                            <li><i class="fas fa-star"></i> Review submissions</li>
                        </ul>
                        <a href="{{ url('register') }}?role=client" class="feature-btn">Post Quests</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <h2 class="cta-title">Ready to Begin Your Adventure?</h2>
                <p class="cta-text">Join the guild and start your journey today!</p>
                <a href="{{ url('register') }}" class="btn-cta">
                    <i class="fas fa-bolt"></i>
                    Register Now
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer" id="contact">
            <div class="container">
                <div class="footer-simple">
                    <div class="footer-brand">
                        <h4>THE CONTENANTAL</h4>
                        <p>The ultimate guild quest management system.</p>
                    </div>
                    <div class="footer-links">
                        <a href="#about">About</a>
                        <a href="#features">Features</a>
                        <a href="{{ url('login') }}">Login</a>
                        <a href="{{ url('register') }}">Register</a>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} The Contenantal Guild. By Raja Moiez & Tashfeen Liaqat.</p>
                </div>
            </div>
        </footer>

    </div>

</body>

</html>