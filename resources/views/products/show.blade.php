@php use Illuminate\Support\Facades\Storage; @endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — Lúdika</title>
    <meta name="description" content="{{ Str::limit($product->description, 150) }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --verde-selva: #1E6F5C;
            --verde-hoja: #69B578;
            --dorado: #C9A227;
            --negro-bosque: #2C2C2C;
            --bg-page: #f2f5f0;
        }

        * { box-sizing: border-box; }
        body {
            background: var(--bg-page);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .top-nav {
            background: linear-gradient(90deg, #2C2C2C 0%, #1E6F5C 50%, #2C2C2C 100%);
            border-bottom: 2px solid rgba(105,181,120,0.35);
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
            padding: 0;
        }
        .top-nav .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 60px;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-brand-icon {
            width: 34px; height: 34px;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(105,181,120,0.4);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .nav-brand-name {
            color: #fff;
            font-weight: 800;
            font-size: 1.05rem;
        }
        .nav-actions { display: flex; align-items: center; gap: 8px; }
        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 16px;
            border-radius: 50px;
            font-size: 0.87rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
        }
        .nav-btn-ghost {
            color: rgba(255,255,255,0.85);
            border: 1.5px solid rgba(255,255,255,0.22);
            background: transparent;
        }
        .nav-btn-ghost:hover { background: rgba(255,255,255,0.12); color: #fff; }
        .nav-btn-solid {
            background: rgba(255,255,255,0.15);
            border: 1.5px solid rgba(255,255,255,0.35);
            color: #fff;
        }
        .nav-btn-solid:hover { background: rgba(255,255,255,0.25); color: #fff; }
        .nav-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            border: 2px solid rgba(105,181,120,0.7);
            object-fit: cover;
        }

        /* ── BREADCRUMB ── */
        .breadcrumb-bar {
            background: #fff;
            border-bottom: 1px solid #e8f2ea;
            padding: 10px 0;
        }
        .breadcrumb-bar .breadcrumb {
            margin: 0;
            font-size: 0.83rem;
        }
        .breadcrumb-bar .breadcrumb-item a {
            color: var(--verde-selva);
            text-decoration: none;
            font-weight: 500;
        }
        .breadcrumb-bar .breadcrumb-item.active { color: #888; }
        .breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before { color: #bbb; }

        /* ── MAIN CONTENT ── */
        .product-detail-page {
            flex: 1;
            padding: 2.5rem 0 3rem;
        }

        /* ── PRODUCT CARD ── */
        .detail-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 6px 32px rgba(30,111,92,0.12);
            border: 1.5px solid #d6ead8;
            overflow: hidden;
        }

        /* Image side */
        .detail-img-wrap {
            position: relative;
            background: linear-gradient(135deg, #eef6ef, #d6ead8);
            min-height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .detail-img {
            width: 100%;
            height: 100%;
            min-height: 340px;
            object-fit: cover;
            display: block;
        }
        .detail-img-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 40px;
        }
        .detail-price-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--verde-selva), var(--negro-bosque));
            color: #fff;
            font-weight: 800;
            font-size: 1.3rem;
            padding: 8px 22px;
            border-radius: 50px;
            box-shadow: 0 4px 16px rgba(30,111,92,0.4);
            letter-spacing: -.01em;
        }

        /* Info side */
        .detail-info {
            padding: 36px 40px;
        }
        .detail-label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(201,162,39,0.12);
            border: 1.5px solid rgba(201,162,39,0.35);
            color: var(--dorado);
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 3px 12px;
            border-radius: 50px;
            margin-bottom: 14px;
        }
        .detail-name {
            font-size: 2rem;
            font-weight: 800;
            color: var(--negro-bosque);
            margin: 0 0 10px;
            letter-spacing: -.03em;
            line-height: 1.2;
        }
        .detail-divider {
            width: 44px;
            height: 4px;
            background: linear-gradient(90deg, var(--verde-selva), var(--verde-hoja));
            border-radius: 4px;
            margin-bottom: 18px;
        }
        .detail-desc {
            color: #555;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        /* Price display */
        .detail-price-display {
            display: flex;
            align-items: baseline;
            gap: 6px;
            margin-bottom: 28px;
            padding: 16px 20px;
            background: #f7faf7;
            border: 1.5px solid #d6ead8;
            border-radius: 14px;
        }
        .price-prefix { color: var(--verde-selva); font-size: 1.2rem; font-weight: 600; }
        .price-value { color: var(--negro-bosque); font-size: 2.4rem; font-weight: 900; letter-spacing: -.03em; }
        .price-decimals { color: #888; font-size: 1rem; font-weight: 500; }

        /* Auth CTA (for guests) */
        .auth-cta {
            background: linear-gradient(135deg, #f7faf7, #eef6ef);
            border: 1.5px solid #d6ead8;
            border-radius: 16px;
            padding: 22px 24px;
            margin-bottom: 20px;
        }
        .auth-cta h6 {
            color: var(--negro-bosque);
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 6px;
        }
        .auth-cta p {
            color: #777;
            font-size: 0.84rem;
            margin-bottom: 14px;
        }
        .cta-btns { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, var(--verde-selva), var(--negro-bosque));
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 11px 24px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(30,111,92,0.3);
            transition: opacity .2s, transform .15s;
        }
        .btn-login:hover { opacity: .88; color: #fff; transform: scale(1.02); }
        .btn-register {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--verde-selva);
            border: 1.5px solid var(--verde-hoja);
            border-radius: 50px;
            padding: 10px 22px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-register:hover { background: #eef6ef; color: var(--verde-selva); }

        /* Cart button (for auth users) */
        .btn-add-cart {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: linear-gradient(135deg, var(--verde-selva), var(--negro-bosque));
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 32px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 18px rgba(30,111,92,0.35);
            transition: opacity .2s, transform .15s;
            width: 100%;
            justify-content: center;
            text-decoration: none;
            margin-bottom: 10px;
        }
        .btn-add-cart:hover { opacity: .88; color: #fff; transform: scale(1.01); }
        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: transparent;
            color: var(--verde-selva);
            border: 1.5px solid var(--verde-hoja);
            border-radius: 50px;
            padding: 11px 24px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
            width: 100%;
        }
        .btn-back:hover { background: #eef6ef; color: var(--verde-selva); }

        /* ── FOOTER ── */
        footer {
            background: linear-gradient(90deg, #2C2C2C 0%, #1E6F5C 50%, #2C2C2C 100%);
            border-top: 2px solid rgba(105,181,120,0.35);
            padding: 18px 0;
            text-align: center;
        }
        footer span {
            color: rgba(255,255,255,0.5);
            font-size: 0.78rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-info { padding: 24px 20px; }
            .detail-name { font-size: 1.5rem; }
            .detail-img-wrap { min-height: 220px; }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="top-nav">
        <div class="container">
            <a href="{{ route('welcome') }}" class="nav-brand">
                <div class="nav-brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <span class="nav-brand-name">Lúdika</span>
            </a>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('home') }}" class="nav-btn nav-btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Inicio
                    </a>
                    <span style="color:rgba(255,255,255,0.7);font-size:0.87rem;font-weight:600;display:flex;align-items:center;gap:6px;">
                        <img src="{{ asset('storage/'.Auth::user()->avatar ?? 'images/avatar.png') }}"
                            class="nav-avatar"
                            onerror="this.src='{{ asset('images/avatar.png') }}'"
                            alt="">
                        {{ Auth::user()->name }}
                    </span>
                @else
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-ghost">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-solid">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Breadcrumb --}}
    <div class="breadcrumb-bar">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('welcome') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                style="margin-right:3px;margin-top:-2px;">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            Tienda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Main --}}
    <main class="product-detail-page">
        <div class="container">
            <div class="detail-card">
                <div class="row g-0">

                    {{-- Image column --}}
                    <div class="col-md-5">
                        <div class="detail-img-wrap">
                            @if($product->image && Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="detail-img">
                            @else
                                <div class="detail-img-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none"
                                        stroke="#69B578" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                    <span style="color:#69B578;font-size:0.82rem;font-weight:600;">Sin imagen</span>
                                </div>
                            @endif
                            <div class="detail-price-badge">
                                ${{ number_format($product->price, 2) }}
                            </div>
                        </div>
                    </div>

                    {{-- Info column --}}
                    <div class="col-md-7">
                        <div class="detail-info">

                            <div class="detail-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                                </svg>
                                Producto Lúdika
                            </div>

                            <h1 class="detail-name">{{ $product->name }}</h1>
                            <div class="detail-divider"></div>
                            <p class="detail-desc">{{ $product->description }}</p>

                            {{-- Price display --}}
                            <div class="detail-price-display">
                                <span class="price-prefix">MXN $</span>
                                @php
                                    $parts = explode('.', number_format($product->price, 2));
                                @endphp
                                <span class="price-value">{{ $parts[0] }}</span>
                                <span class="price-decimals">.{{ $parts[1] }}</span>
                            </div>

                            {{-- Auth-based CTA --}}
                            @auth
                                {{-- Usuario autenticado: puede agregar al carrito --}}
                                <form id="add-cart-form" action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add-cart" id="addCartBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                        </svg>
                                        Añadir al carrito
                                    </button>
                                </form>
                                <a href="{{ route('welcome') }}" class="btn-back">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                                    </svg>
                                    Volver a la tienda
                                </a>
                            @else
                                {{-- Invitado: CTA para iniciar sesión o registrarse --}}
                                <div class="auth-cta">
                                    <h6>¿Quieres llevar este producto?</h6>
                                    <p>Inicia sesión o crea tu cuenta gratuita para añadirlo al carrito.</p>
                                    <div class="cta-btns">
                                        <a href="{{ route('login') }}" class="btn-login">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                                <polyline points="10 17 15 12 10 7"/>
                                                <line x1="15" y1="12" x2="3" y2="12"/>
                                            </svg>
                                            Iniciar sesión
                                        </a>
                                        <a href="{{ route('register') }}" class="btn-register">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                                <circle cx="12" cy="7" r="4"/>
                                                <line x1="12" y1="17" x2="12" y2="22"/>
                                                <line x1="9" y1="20" x2="15" y2="20"/>
                                            </svg>
                                            Crear cuenta
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ route('welcome') }}" class="btn-back">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                                    </svg>
                                    Volver a la tienda
                                </a>
                            @endauth

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <span>&copy; {{ date('Y') }} Lúdika · Todos los derechos reservados</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
