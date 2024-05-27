{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}
@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5">
             <h3 class="text-center">会員登録ありがとうございます！</h3>
 
             <p class="text-center">
                 現在、仮会員の状態です。
             </p>
 
             <p class="text-center">
                 ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。
             </p>
 
             <p class="text-center">
                 メール本文内のURLをクリックすると本会員登録が完了となります。
             </p>
             <div class="text-center">
                 <a href="{{ url('/') }}" class="btn samuraimart-submit-button w-50 text-white">トップページへ</a>
             </div>
         </div>
     </div>
 </div>
 @endsection