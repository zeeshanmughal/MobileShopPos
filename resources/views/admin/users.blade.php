@extends('layouts.admin')


@section('content')
    <div class="container">
        <h3 class="mt-3">All Users</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            @if ($user->status === 'pending')
                                <form action="{{ route('admin.user.makeActive', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Make Active</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
