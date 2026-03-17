@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #f8faf7;
        }

        .about-hero {
            background: linear-gradient(135deg, #0d1f18 0%, #1E6F5C 100%);
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 50px;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.4;
        }

        .about-title {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
            letter-spacing: -1px;
            position: relative;
            z-index: 1;
        }

        .about-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 15px auto 0;
            position: relative;
            z-index: 1;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .about-card {
            background: #fff;
            padding: 40px;
            border-radius: 24px;
            border: 1.5px solid #d6ead8;
            box-shadow: 0 10px 30px rgba(30, 111, 92, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(30, 111, 92, 0.12);
            border-color: #69B578;
        }

        .about-card__icon {
            width: 54px;
            height: 54px;
            background: #f0f7f1;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: #1E6F5C;
        }

        .about-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2C2C2C;
            margin-bottom: 15px;
            letter-spacing: -0.5px;
        }

        .about-card p {
            color: #626262;
            line-height: 1.7;
            margin: 0;
            font-size: 1rem;
        }

        .about-card__badge {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 8px;
            height: 8px;
            background: #C9A227;
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .about-hero { padding: 60px 20px; }
            .about-title { font-size: 2.2rem; }
            .about-grid { grid-template-columns: 1fr; }
        }
    </style>

    <section class="about-hero">
        <div class="container">
            <h1 class="about-title">Quiénes somos</h1>
            <p class="about-subtitle">Conoce nuestra historia, valores y el propósito que nos impulsa a crear experiencias únicas.</p>
        </div>
    </section>

    <div class="container">
        <div class="about-grid">
            {{-- Objetivo --}}
            <div class="about-card">
                <div class="about-card__badge"></div>
                <div class="about-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                </div>
                <h2>Objetivo</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            {{-- Misión --}}
            <div class="about-card">
                <div class="about-card__badge" style="background: #1E6F5C;"></div>
                <div class="about-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <h2>Misión</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            {{-- Visión --}}
            <div class="about-card">
                <div class="about-card__badge"></div>
                <div class="about-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <h2>Visión</h2>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            {{-- Contexto --}}
            <div class="about-card">
                <div class="about-card__badge" style="background: #1E6F5C;"></div>
                <div class="about-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h2>Contexto</h2>
                <p>Nuestra trayectoria se ha forjado a través de la pasión por los juegos de mesa, creando un espacio donde la comunidad y la diversión se encuentran.</p>
            </div>
        </div>
    </div>
@endsection
