@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.userManagement') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('updateUserRole', $user->id) }}" class="mt-3">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-3">
                            <label for="user_id" class="fw-bold">{{ __('messages.selectedUser') }}:</label>
                            <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $user->name }} ({{ $user->email }})" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role" class="fw-bold">{{ __('messages.changeRole') }}:</label>
                            <select name="role" id="role" class="form-control">
                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                <option value="nastavnik" {{ $user->role === 'nastavnik' ? 'selected' : '' }}>Nastavnik</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 me-2">{{ __('messages.changeRole') }}</button>
                        <a href="{{ url('admin') }}" class="btn btn-secondary mt-3">{{ __('messages.back') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>
@endsection
