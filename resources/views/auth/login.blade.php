<x-front-layout>
    <x-auth-card>

        @section('title', __('Login'))

        <x-form action="{{ route('login') }}">

            @include('errors.messages')

            <x-form.input name="email" :label="__('Email')">{{ old('email') }}</x-form.input>
            <x-form.input name="password" :label="__('Password')" type="password" />

            <div class="flex justify-between">
                <p><a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a></p>
            </div>

            <p>
                <x-form.submit class="justify-center w-full btn btn-primary">Login</x-form.submit>
            </p>

        </x-form>

    </x-auth-card>

</x-front-layout>
