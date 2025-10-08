<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center space-y-2 mb-6">
                <div class="bg-purple-600 rounded-lg p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-purple-600 font-bold text-2xl">Hall Manager</h1>
                <p class="text-gray-500 text-sm">College Management System</p>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6" id="registerForm">
            @csrf

            {{-- Header --}}
            <div class="text-center">
                <h2 class="text-xl font-semibold text-gray-900 mb-1">
                    {{ __('Create Account') }}
                </h2>
                <p class="text-sm text-gray-600">
                    {{ __('Join our college management system') }}
                </p>
            </div>

            {{-- Role Selection - Cards Style --}}
            <div class="flex flex-col items-center space-y-4 mt-5">
                <div class="flex justify-center space-x-6">
                    <!-- Student Card -->
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="student" class="hidden peer" required />
                        <div class="flex flex-col items-center p-4 border-2 rounded-lg peer-checked:border-purple-600 peer-checked:bg-purple-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 21.75a11.952 11.952 0 01-6.825-3.693 12.083 12.083 0 01.665-6.479L12 14z" />
                            </svg>
                            <span class="text-purple-600 font-semibold">Student</span>
                        </div>
                    </label>
    
                    <!-- Professor Card -->
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="professor" class="hidden peer" required />
                        <div class="flex flex-col items-center p-4 border-2 rounded-lg peer-checked:border-purple-600 peer-checked:bg-purple-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-purple-600 font-semibold">Professor</span>
                        </div>
                    </label>
                </div>
                <div id="verification-code-container" class="hidden w-1/3 mx-auto">
                    <x-label for="verification_code" value="{{ __('Verification Code') }}" />
                    <x-input 
                        id="verification_code" 
                        class="block mt-1 w-full" 
                        type="text" 
                        name="verification_code" 
                        placeholder="Enter verification code"
                    />
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const professorRadio = document.querySelector('input[name="role"][value="professor"]');
                    const studentRadio = document.querySelector('input[name="role"][value="student"]');
                    const verificationCodeContainer = document.getElementById('verification-code-container');
    
                    function toggleVerificationCode() {
                        if (professorRadio.checked) {
                            verificationCodeContainer.classList.remove('hidden');
                            document.getElementById('verification_code').setAttribute('required', 'required');
                        } else {
                            verificationCodeContainer.classList.add('hidden');
                            document.getElementById('verification_code').removeAttribute('required');
                        }
                    }
    
                    professorRadio.addEventListener('change', toggleVerificationCode);
                    studentRadio.addEventListener('change', toggleVerificationCode);
    
                    // Initialize on page load
                    toggleVerificationCode();
                });
            </script>

            {{-- Name Field --}}
            <div>
                <x-label for="name" value="{{ __('Full Name') }}" />
                <x-input 
                    id="name" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="Enter your full name"
                />
            </div>

            {{-- Email Field --}}
            <div>
                <x-label for="email" value="{{ __('Email Address') }}" />
                <x-input 
                    id="email" 
                    class="block mt-1 w-full" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username"
                    placeholder="Enter your email"
                />
            </div>

            {{-- Password Field --}}
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input 
                    id="password" 
                    class="block mt-1 w-full" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password"
                    placeholder="Create a password"
                />
            </div>

            {{-- Confirm Password Field --}}
            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                />
            </div>

            {{-- Terms and Privacy Policy --}}
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="flex items-center">
                    <x-checkbox name="terms" id="terms" required />
                    <div class="ml-2 text-sm text-gray-600">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </div>
                </div>
            @endif

            {{-- Buttons --}}
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button id="registerButton" class="ml-4" type="submit">
                    {{ __('Register') }}
                </x-button>
            </div>
            <script>
                document.getElementById('registerForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    const form = this;
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            name: form.name.value,
                            email: form.email.value,
                            password: form.password.value,
                            password_confirmation: form.password_confirmation.value,
                            role: form.role.value,
                            verification_code: form.verification_code ? form.verification_code.value : null,
                            terms: form.terms ? form.terms.checked : false
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            alert('Account created successfully, please login.');
                            window.location.href = "{{ route('login') }}";
                        } else {
                            return response.json().then(data => {
                                let errors = data.errors;
                                let message = '';
                                for (const key in errors) {
                                    message += errors[key].join(' ') + '\\n';
                                }
                                alert('Error:\\n' + message);
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred. Please try again.');
                    });
                });
            </script>

            {{-- Demo Credentials --}}
            <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
                
                
            </div>
        </form>
    </x-authentication-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Role card selection
            const roleCards = document.querySelectorAll('.role-card');
            
            roleCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove active state from all cards
                    roleCards.forEach(c => {
                        c.classList.remove('border-purple-500', 'bg-purple-50');
                        const icon = c.querySelector('.rounded-full');
                        icon.classList.remove('bg-purple-500');
                        icon.classList.add('bg-gray-200');
                    });
                    
                    // Add active state to clicked card
                    this.classList.add('border-purple-500', 'bg-purple-50');
                    const icon = this.querySelector('.rounded-full');
                    icon.classList.remove('bg-gray-200');
                    icon.classList.add('bg-purple-500');
                    
                    // Check the radio button
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                });
            });

            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const roleSelected = document.querySelector('input[name="role"]:checked');
                if (!roleSelected) {
                    e.preventDefault();
                    alert('Please select your role');
                    return false;
                }
            });
        });
    </script>
</x-guest-layout>