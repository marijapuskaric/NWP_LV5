@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.userManagement') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('setStudyType', $user->id) }}" class="mt-3">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-3">
                            <label for="user_id" class="fw-bold">{{ __('messages.selectedUser') }}:</label>
                            <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $user->name }} ({{ $user->email }})" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tip_studija" class="fw-bold">{{ __('messages.setStudyType') }}:</label>
                            <select name="tip_studija" id="tip_studija" class="form-control">
                                <option value="strucni" {{ $user->tip_studija === 'strucni' ? 'selected' : '' }}>Stručni</option>
                                <option value="preddiplomski" {{ $user->tip_studija === 'preddiplomski' ? 'selected' : '' }}>Preddiplomski</option>
                                <option value="diplomski" {{ $user->tip_studija === 'diplomski' ? 'selected' : '' }}>Diplomski</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 me-2">{{ __('messages.setStudyType') }}</button>
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
