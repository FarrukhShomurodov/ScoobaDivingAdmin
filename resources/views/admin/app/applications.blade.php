@extends('layouts.admin')

@section('content-header')
    Application
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Application</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table">
                <thead>
                <trc>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                </trc>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    @if($application->state == 0)
                        <tr>
                            <td>{{$application->id}}</td>
                            <td>{{$application->name}}</td>
                            <td>{{$application->phone_number}}</td>
                            <td>{{$application->email}}</td>
                            <td>{{$application->message}}</td>
                            <td>
                                <form action="{{route('admin.change_state',$application->id)}}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-block btn-dark">Done</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
