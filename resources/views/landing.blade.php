<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHAUTS - Chalimbana University Timetable System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #f472b6;
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-secondary: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url('{{ asset("hero-bg.png") }}');
            background-size: cover;
            background-position: center;
            padding: 2rem;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
        }

        .hero-content {
            position: relative;
            text-align: center;
            max-width: 900px;
            z-index: 10;
        }

        .hero-title {
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #fff, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeInDown 1s ease-out;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 3vw, 1.5rem);
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        /* Glassmorphism Buttons */
        .cta-container {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeIn 1s ease-out 0.4s both;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 99px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 10px 30px -10px var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -15px var(--primary);
        }

        .btn-glass {
            background: var(--glass);
            color: white;
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }

        /* Features Section */
        .features {
            padding: 8rem 2rem;
            background: var(--bg-dark);
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            padding: 3rem;
            border-radius: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            border-color: var(--primary);
            transform: translateY(-10px);
            background: rgba(99, 102, 241, 0.05);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            color: var(--primary);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-desc {
            color: var(--text-secondary);
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            text-decoration: none;
            color: white;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--primary);
        }

        /* Footer */
        footer {
            padding: 4rem 2rem;
            text-align: center;
            border-top: 1px solid var(--glass-border);
            color: var(--text-secondary);
        }

        .footer-logo {
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="#" class="logo">CHAU<span>TS</span></a>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-glass" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-glass" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Log In</a>
                @endauth
            @endif
        </div>
    </nav>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Intelligent Scheduling for a Brighter Future.</h1>
            <p class="hero-subtitle">Optimize your academic journey with the Chalimbana University Timetable System. Seamless, conflict-free, and designed for excellence.</p>
            <div class="cta-container">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
                        <a href="#features" class="btn btn-glass">Learn More</a>
                    @endauth
                @endif
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="section-header">
            <h2 class="section-title">Engineered for Efficiency</h2>
            <p style="color: var(--text-secondary)">Experience the next generation of academic management.</p>
        </div>
        <div class="grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <h3 class="feature-title">Smart Scheduling</h3>
                <p class="feature-desc">Automated timetable generation that eliminates conflicts between courses, lecturers, and rooms.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3 class="feature-title">Role-Based Access</h3>
                <p class="feature-desc">Dedicated interfaces for students, lecturers, and administrators with secure permission layers.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                </div>
                <h3 class="feature-title">Easy Data Import</h3>
                <p class="feature-desc">Bulk import programs, courses, lecturers, and rooms via CSV to get your system running in minutes.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-logo">
            <a href="#" class="logo">CHAU<span>TS</span></a>
        </div>
        <p>&copy; {{ date('Y') }} Chalimbana University. All rights reserved.</p>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.style.padding = '1rem 2rem';
                nav.style.background = 'rgba(15, 23, 42, 0.95)';
            } else {
                nav.style.padding = '1.5rem 2rem';
                nav.style.background = 'rgba(15, 23, 42, 0.8)';
            }
        });
    </script>
</body>
</html>
