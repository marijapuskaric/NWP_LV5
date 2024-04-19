@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.userManagement') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.username') }}</th>
                                    <th>{{ __('messages.email') }}</th>
                                    <th>{{ __('messages.role') }}</th>
                                    <th>{{ __('messages.studyType') }}</th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->tip_studija }}</td>
                                    <td>
                                        <a href="{{ url('updateuserrole/'.$user->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit user role">{{ __('messages.editRole') }}</a>
                                        @if($user->role === 'student')
                                            <a href="{{ url('setstudytype/'.$user->id) }}" class="btn btn-sm btn-outline-secondary" title="Set type of study">{{ __('messages.setStudyType') }}</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
