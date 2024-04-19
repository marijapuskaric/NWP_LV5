@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.createNewTask') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('createNewTask') }}">
                        @csrf
                        <div class="form-group">
                            <label for="naziv_rada">{{ __('messages.taskName') }}:</label>
                            <input type="text" id="naziv_rada" name="naziv_rada" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="naziv_rada_en">{{ __('messages.taskNameEng') }}:</label>
                            <input type="text" id="naziv_rada_en" name="naziv_rada_en" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="zadatak_rada">{{ __('messages.task') }}:</label>
                            <textarea id="zadatak_rada" name="zadatak_rada" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tip_studija">{{ __('messages.studyType') }}:</label>
                            <select id="tip_studija" name="tip_studija" class="form-control">
                                <option value="" selected disabled>{{ __('messages.chooseType') }}</option>
                                <option value="preddiplomski">Preddiplomski</option>
                                <option value="diplomski">Diplomski</option>
                                <option value="strucni">Stručni</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">{{ __('messages.createTask') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success m-5">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger m-5">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
