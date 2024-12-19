@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email Address Verification') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to your email.') }}
                        </div>
                    @endif

                    {{ __('To continue, please check your email for the verification link.') }}
                    {{ __('If you haven’t received the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to resend it') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
