@extends('layouts.app')

@section('title', 'Crear cuenta — Yadira\'s Store')

@section('content')
<style>
    body { background: #f2f5f0; }

    .register-wrapper {
        min-height: calc(100vh - 72px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        background:
            radial-gradient(ellipse at 80% 80%, rgba(30,111,92,0.10) 0%, transparent 55%),
            radial-gradient(ellipse at 20% 20%, rgba(44,44,44,0.06) 0%, transparent 55%),
            #f2f5f0;
    }

    .register-card {
        width: 100%;
        max-width: 440px;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(30,111,92,0.16), 0 4px 16px rgba(30,111,92,0.08);
        border: 1.5px solid #d6ead8;
        overflow: hidden;
        animation: cardIn 0.5s cubic-bezier(.34,1.4,.64,1) both;
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(30px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .register-header {
        background: linear-gradient(135deg, #1E6F5C 0%, #2C2C2C 100%);
        padding: 30px 32px 26px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .register-header::before {
        content: ''; position: absolute;
        top: -40px; left: -40px;
        width: 120px; height: 120px;
        background: rgba(255,255,255,0.07); border-radius: 50%;
    }
    .register-header::after {
        content: ''; position: absolute;
        bottom: -30px; right: -30px;
        width: 90px; height: 90px;
        background: rgba(255,255,255,0.05); border-radius: 50%;
    }

    .register-icon-wrap {
        width: 58px; height: 58px;
        background: rgba(255,255,255,0.18);
        border: 2.5px solid rgba(255,255,255,0.45);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
    }

    .register-header h1 {
        color: #fff; font-size: 1.35rem; font-weight: 800; margin: 0 0 4px;
    }
    .register-header p {
        color: rgba(255,255,255,0.72); font-size: 0.83rem; margin: 0;
    }

    .register-body { padding: 26px 32px 30px; }

    .form-group { margin-bottom: 1.05rem; }

    .form-label {
        display: block;
        font-size: 0.77rem; font-weight: 700;
        color: #1E6F5C;
        text-transform: uppercase; letter-spacing: .05em;
        margin-bottom: 6px;
    }

    .form-input-wrap { position: relative; }
    .form-input-icon {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%);
        color: #69B578; pointer-events: none;
    }

    .form-input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1.5px solid #b5d9bc;
        border-radius: 12px;
        font-size: 0.93rem;
        background: #f7faf7;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        box-sizing: border-box;
        color: #2d2d2d;
    }
    .form-input:focus {
        border-color: #1E6F5C;
        box-shadow: 0 0 0 3px rgba(30,111,92,0.10);
        background: #fff;
    }
    .form-input.is-invalid { border-color: #1E6F5C; }
    .invalid-feedback { color: #1E6F5C; font-size: 0.77rem; margin-top: 3px; display: block; }

    .btn-register {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #1E6F5C, #2C2C2C);
        color: #fff; border: none; border-radius: 50px;
        font-size: 0.97rem; font-weight: 700; cursor: pointer;
        box-shadow: 0 4px 18px rgba(30,111,92,0.35);
        transition: opacity .2s, transform .15s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-register:hover { opacity: 0.88; transform: scale(1.015); }
    .btn-register:disabled { opacity: 0.65; cursor: wait; transform: none; }

    .register-footer {
        text-align: center; margin-top: 1.2rem;
        font-size: 0.86rem; color: #888;
    }
    .register-footer a { color: #1E6F5C; font-weight: 600; text-decoration: none; }
    .register-footer a:hover { text-decoration: underline; }

    .divider {
        display: flex; align-items: center; gap: 12px;
        margin: 1.1rem 0; color: #ccc; font-size: 0.78rem;
    }
    .divider::before, .divider::after {
        content: ''; flex: 1; height: 1px; background: #d6ead8;
    }
</style>

<div class="register-wrapper">
    <div class="register-card">

        {{-- Header --}}
        <div class="register-header">
            <div class="register-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <line x1="19" y1="8" x2="19" y2="14"/>
                    <line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
            </div>
            <h1>Crear una cuenta</h1>
            <p>Únete a Lúdika hoy</p>
        </div>

        {{-- Body --}}
        <div class="register-body">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                {{-- Nombre --}}
                <div class="form-group">
                    <label class="form-label" for="name">Nombre completo</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input id="name" type="text" name="name"
                               class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               value="{{ old('name') }}" required autocomplete="name" autofocus
                               placeholder="Tu nombre">
                    </div>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email"
                               class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               value="{{ old('email') }}" required autocomplete="email"
                               placeholder="tu@correo.com">
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password"
                               class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               required autocomplete="new-password"
                               placeholder="Mínimo 8 caracteres">
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div class="form-group" style="margin-bottom:1.3rem;">
                    <label class="form-label" for="password-confirm">Confirmar contraseña</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="form-input"
                               required autocomplete="new-password"
                               placeholder="Repite tu contraseña">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-register" id="registerBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                         id="btnIcon">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                    <span id="btnText">Crear cuenta</span>
                </button>
            </form>

            <div class="divider">o</div>
            <div class="register-footer">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var form    = document.getElementById('registerForm');
    var btn     = document.getElementById('registerBtn');
    var btnText = document.getElementById('btnText');
    var submitting = false;

    form.addEventListener('submit', function (e) {
        if (submitting) { e.preventDefault(); return; }
        submitting = true;
        btn.disabled = true;
        btnText.textContent = 'Creando cuenta…';
    });
});
</script>
@endpush
@endsection
