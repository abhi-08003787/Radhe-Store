@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f8f9fa; margin: 0; padding: 0;">
    <div style="width: 100%; max-width: 360px;">
        <div class="bg-white p-4 p-sm-5 login-form-container">
            <!-- Login Title -->
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold text-dark mb-2">LOGIN</h2>
                <div class="border-bottom border-2 border-dark mx-auto" style="width: 50px;"></div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <input id="email" type="email" class="form-control border border-1 @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.875rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <input id="password" type="password" class="form-control border border-1 @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="current-password"
                           placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.875rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="btn login-button text-white fw-bold py-2" style="background-color: #000; border: 1px solid #000;">
                        LOG IN
                    </button>
                </div>
            </form>

            <!-- Footer Links -->
            <div class="text-center mt-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('register') }}" class="text-dark text-decoration-none fw-bold border-bottom border-2 border-dark" style="font-size: 0.875rem;">
                            Create Account  My Account
                        </a>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Fade-In Up Animation */
.login-form-container {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Form Controls - Full Width */
.form-control {
    width: 100% !important;
    padding: 0.75rem;
    font-size: 0.95rem;
    border-radius: 0;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #000;
    box-shadow: none;
    outline: none;
}

/* Button - Full Width with Scale Animation */
.login-button {
    width: 100% !important;
    transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
    box-sizing: border-box;
}

.login-button:hover {
    transform: scale(1.05);
    background-color: #333 !important;
    border-color: #333 !important;
}

/* Error States */
.is-invalid {
    border-color: #dc3545 !important;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    div[style*="display: flex"] {
        padding: 0 1rem;
    }
    
    .bg-white {
        margin: 0;
    }
}

/* Remove Bootstrap default styles */
.btn:focus {
    box-shadow: none;
}

/* Footer links styling */
.border-bottom {
    padding-bottom: 1px;
}
</style>
@endsection
