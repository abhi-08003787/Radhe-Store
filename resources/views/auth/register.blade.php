@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f8f9fa; margin: 0; padding: 0;">
    <div style="width: 100%; max-width: 360px;">
        <div class="bg-white p-4 p-sm-5 register-form-container">
            <!-- Register Title -->
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold text-dark mb-2">REGISTER</h2>
                <div class="border-bottom border-2 border-dark mx-auto" style="width: 50px;"></div>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <input id="name" type="text" class="form-control border border-1 @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                           placeholder="Name">
                    @error('name')
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.875rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <input id="email" type="email" class="form-control border border-1 @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email"
                           placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.875rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Mobile Field -->
                <div class="mb-3">
                    <input id="mobile" type="tel" class="form-control border border-1 @error('mobile') is-invalid @enderror" 
                           name="mobile" value="{{ old('mobile') }}" required autocomplete="tel"
                           placeholder="Mobile">
                    @error('mobile')
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.875rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <input id="password" type="password" class="form-control border border-1 @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="new-password"
                           placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.875rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control border border-1" 
                           name="password_confirmation" required autocomplete="new-password"
                           placeholder="Confirm Password">
                </div>

                <!-- Privacy Policy Text -->
                <div class="mb-3">
                    <p class="text-muted small" style="font-size: 0.75rem; line-height: 1.4;">
                        By creating an account, you agree to our Terms of Service and Privacy Policy
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="btn register-button text-white fw-bold py-2" style="background-color: #000; border: 1px solid #000;">
                        REGISTER
                    </button>
                </div>
            </form>

            <!-- Login Link -->
           <div class="customer-option mt-4 text-center">
                <span class="text-secondary">Have an account?</span>
                <a href="{{ route('login') }}" class="btn-text js-show-register">Login to your Account</a>
              </div>
        </div>
    </div>
</div>

<style>
/* Fade-In Up Animation */
.register-form-container {
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
.register-button {
    width: 100% !important;
    transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
    box-sizing: border-box;
}

.register-button:hover {
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
