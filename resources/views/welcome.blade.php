@extends('layouts.guest')

@section('content')
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-200 dark:text-gray-500 underline">{{__('Home')}}</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-200 dark:text-gray-500 underline">{{__('Login')}}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-200 dark:text-gray-500 underline">{{__('Register')}}</a>
                @endif
            @endauth
        </div>
    @endif
@endsection
