<!-- resources/views/device_issues.blade.php -->

@extends('layouts.retailer')

@section('content')
    <div class="container">
        <h2>Device Issues</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('issueStoreOrUpdate') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="issue_description">Issue Description:</label>
                <input type="text" name="issueDescription" id="issueDescription" class="form-control"  required>
            </div>
                <input type="hidden" name="issue_id" id="issueId" >
                <button type="submit" class="btn btn-success">Add/Update Issue</button>
            
        </form>

        <hr>

        <!-- Display Device Issues -->
        @if ($deviceIssues->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Issue Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deviceIssues as $deviceIssue)
                        <tr>
                            <td>{{ $deviceIssue->id }}</td>
                            <td>{{ $deviceIssue->issue_description }}</td>
                            <td>
                                <a href="#" class="btn btn-success edit-issue-btn" style="font-size: 12px;" data-issue-id="{{ $deviceIssue->id }}" data-issue-description="{{ $deviceIssue->issue_description}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('issue.destory', $deviceIssue->id) }}" method="post"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this Issue?')"
                                        style="font-size: 12px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No device issues found.</p>
        @endif
    </div>
@endsection
@push('js')

<script>
    $(document).ready(function() {
        $('.edit-issue-btn').on('click', function() {
            var issueId = $(this).data('issue-id');
            var issueDescription = $(this).data('issue-description');

            console.log('Issue ID:', issueId);
        console.log('Issue Description:', issueDescription);
            // Set the input values
            $('#issueId').val(issueId);
            $('#issueDescription').val(issueDescription);
        });
    });
</script>
@endpush