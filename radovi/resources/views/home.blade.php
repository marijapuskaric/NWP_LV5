@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.studentPage') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!$assignedTask->isEmpty())
                        <h3>{{ __('messages.assignedTasks') }}</h3>
                        @foreach ($assignedTask as $task)
                            <div class="m-3 border rounded p-3">
                                <h5 class="card-title"><b>{{ $task->naziv_rada }}</b></h5>
                                <p class="card-text">{{ __('messages.taskNameEng') }}: {{ $task->naziv_rada_en }}</p>
                                <p>{{ __('messages.task') }}: {{ $task->zadatak_rada }}</p>
                                <p class="card-text">{{ __('messages.studyType') }}: {{ $task->tip_studija }}</p>     
                            </div>
                        @endforeach
                    @else
                        @if(!$userTasks->isEmpty())
                            <h3>{{ __('messages.appliedTasks') }}</h3>
                            @foreach ($userTasks as $task)
                                <div class="m-3 border rounded p-3">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="card-title"><b>{{ $task->naziv_rada }}</b></h5>
                                            <p class="card-text">{{ __('messages.taskNameEng') }}: {{ $task->naziv_rada_en }}</p>
                                            <p>{{ __('messages.task') }}: {{ $task->zadatak_rada }}</p>
                                            <p class="card-text">{{ __('messages.studyType') }}: {{ $task->tip_studija }}</p>
                                        </div>
                                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                                            <form method="POST" action="{{ route('cancelTask', $task->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">{{ __('messages.cancel') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>{{ __('messages.notApplied') }}</p>
                        @endif
                    
                        <hr>

                        @if(!$tasks->isEmpty())
                            <h3>{{ __('messages.applyTasks') }}</h3>
                            @foreach ($tasks as $task)
                                <div class="m-3 border rounded p-3">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="card-title"><b>{{ $task->naziv_rada }}</b></h5>
                                            <p class="card-text">{{ __('messages.taskNameEng') }}: {{ $task->naziv_rada_en }}</p>
                                            <p>{{ __('messages.task') }}: {{ $task->zadatak_rada }}</p>
                                            <p class="card-text">{{ __('messages.studyType') }}: {{ $task->tip_studija }}</p>
                                        </div>
                                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                                            <form method="POST" action="{{ route('applyForTask', $task->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">{{ __('messages.apply') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>{{ __('messages.noApply') }}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
