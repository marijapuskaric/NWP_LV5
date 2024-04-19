@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.tasksAndApplicants') }}</div>

                <div class="card-body">
                    @foreach ($userTasks as $task)
                        <div class="mb-4 border rounded p-3">
                            <h4><b>{{ $task->naziv_rada }}</b></h4>
                            <p>{{ __('messages.taskNameEng')}}: {{ $task->naziv_rada_en }}</p>
                            <p>{{ $task->zadatak_rada }}</p>
                            <p>{{ __('messages.studyType') }}: {{ $task->tip_studija }}</p>
                            @if ($task->student_id != null)
                                <p>{{ __('messages.student') }}: <b>{{ $task->getStudent()->name }}</b></p>
                            @else
                                <h5>{{ __('messages.applicants') }}</h5>
                                <ul class="list-group">
                                    @foreach ($task->students as $student)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $student->name }}
                                            <form method="POST" action="{{ route('acceptStudent', ['studentId' => $student->id, 'taskId' => $task->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">{{ __('messages.accept') }}</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
