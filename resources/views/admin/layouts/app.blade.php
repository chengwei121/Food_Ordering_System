<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --header-height: 64px;
            --footer-height: 48px;
            --sidebar-width: 280px;
            --bg-primary: #1e293b;
            --bg-secondary: #334155;
            --gradient-start: #1e293b;
            --gradient-end: #475569;
            --gradient-middle: #334155;
            --accent-gold: #fbbf24;
            --accent-gold-glow: rgba(251, 191, 36, 0.5);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.9);
            --text-muted: rgba(255, 255, 255, 0.7);
            --border-color: rgba(255, 255, 255, 0.12);
            --header-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            --footer-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2);
            --glass-overlay: rgba(51, 65, 85, 0.6);
            --heading-gradient-start: #fbbf24;
            --heading-gradient-end: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            height: var(--header-height);
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-middle), var(--gradient-end));
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: var(--header-shadow);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            justify-content: space-between;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--glass-overlay);
            z-index: -1;
        }

        .header-brand {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--accent-gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 10px var(--accent-gold-glow);
        }

        .header-brand:hover {
            color: #fbbf24;
            transform: translateY(-1px);
            text-shadow: 0 0 20px var(--accent-gold-glow),
                         0 0 30px var(--accent-gold-glow);
        }

        .header-brand i {
            font-size: 1.5rem;
            color: #fbbf24;
            filter: drop-shadow(0 0 8px var(--accent-gold-glow));
        }

        #sidebarToggle {
            width: 40px;
            height: 40px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-gold);
            cursor: pointer;
            display: none;
            margin-right: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        #sidebarToggle:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-gold);
            color: var(--accent-gold);
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
        }

        /* Main Container */
        .main-container {
            flex: 1;
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height) - var(--footer-height));
            background: var(--bg-primary);
        }

        /* Footer */
        .footer {
            height: var(--footer-height);
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-middle), var(--gradient-end));
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
            box-shadow: var(--footer-shadow);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--glass-overlay);
            z-index: -1;
        }

        .footer p {
            margin: 0;
            color: var(--text-secondary);
            font-weight: 500;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            #sidebarToggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .header-brand {
                margin-right: auto;
            }

            .header, .footer {
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
            }

            .header-left {
                flex: 1;
            }
        }

        /* Enhanced Heading Styles */
        h1 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            margin-bottom: 1rem;
            position: relative;
            background: linear-gradient(135deg, var(--heading-gradient-start), var(--heading-gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 10px rgba(251, 191, 36, 0.3);
            filter: drop-shadow(0 2px 8px rgba(251, 191, 36, 0.2));
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--heading-gradient-start), var(--heading-gradient-end));
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .page-title i {
            font-size: 2rem;
            color: var(--accent-gold);
            filter: drop-shadow(0 2px 8px rgba(251, 191, 36, 0.3));
        }

        /* Add styles for header actions */
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: var(--accent-gold);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: #ef4444;
            color: #ef4444;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .logout-btn i {
            color: inherit;
            font-size: 1rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('admin.dishes.index') }}" class="header-brand">
                <i class="fas fa-utensils"></i>
                <span>Restaurant Admin</span>
            </a>
        </div>
        <div class="header-right">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Restaurant Admin. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 