@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.notAuthorized') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (auth()->user()->role === 'admin')
                        {{ __('messages.notAuthorizedMessage') }}
                        <a href="{{ url('/admin') }}" class="link-for-admin">{{ __('messages.home') }}</a>
                    @elseif (auth()->user()->role === 'nastavnik')
                        {{ __('messages.notAuthorizedMessage') }}
                        <a href="{{ url('/nastavnik') }}" class="link-for-user">{{ __('messages.home') }}</a>
                    @elseif (auth()->user()->role === 'student')
                        {{ __('messages.notAuthorizedMessage') }}
                        <a href="{{ url('/home') }}" class="link-for-user">{{ __('messages.home') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
