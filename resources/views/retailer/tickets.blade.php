@extends('layouts.retailer')

@section('content')
@if(Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('status') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
    <div class="bg-white shadow-sm">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-toggle="tab" data-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All Tickets</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pending-tab" data-toggle="tab" data-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="progress-tab" data-toggle="tab" data-target="#progress" type="button" role="tab" aria-controls="progress" aria-selected="false">In Progress</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="complete-tab" data-toggle="tab" data-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="false">Complete</button>
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all">
        <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Ticket #</th>
                                <th>Task</th>
                                <th>Type</th>
                                <th>Device</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($tickets) > 0)
                            @foreach($tickets as $t=> $ticket)
                            <tr>
                                <td><a href="#" data-toggle="modal" data-target="#exampleModal">{{ $ticket->ticket_id }}</a></td>
                                <td>{{ $ticket->service_detail->device_issue }}</td>
                                <td> {{ $ticket->service_detail->repair_category}} </td>
                                <td> {{ $ticket->service_detail->device }}</td>
                                <td>
                                    <div class="form-group ">
                                        <select id="dropdown" name="role" class="greenbtn form-control"  onchange="changeStatus(this.value, {{ $ticket->id }})" >
                                            <option value="pending" @if($ticket->ticket_status == 'pending') selected @endif>Pending</option>
                                            <option value="in_progress" @if($ticket->ticket_status == 'in_progress') selected @endif>In Progress</option>
                                            <option value="completed" @if($ticket->ticket_status == 'completed') selected @endif>Completed</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td  colspan="5" style="border: none;">
                                <h5 style="font-weight: bold; margin-top:3px">No Tickets Yet</h5>
                            </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Task</th>
                                    <th>Type</th>
                                    <th>Device</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" data-toggle="modal" data-target="#exampleModal1">Tiger Nixon</a></td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>
                                        <button class='pending btn text-white py-1 f-14 bg-gradient-warning'>Pending</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Task</th>
                                    <th>Type</th>
                                    <th>Device</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" data-toggle="modal" data-target="#exampleModal1">Tiger Nixon</a></td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>
                                        <button class='pending btn text-white py-1 f-14 bg-gradient-success'>In Progress</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Task</th>
                                    <th>Type</th>
                                    <th>Device</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" data-toggle="modal" data-target="#exampleModal1">Tiger Nixon</a></td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>
                                        <button class='pending btn text-white py-1 f-14 bg-gradient-info'>Complete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- -------` -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Ticket Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p> <strong> #</strong> 772321</p>
                <p> <strong>Task</strong> Done</p>
                <p> <strong>Type</strong> Repairing</p>
                <p> <strong>Device</strong> Sumsung Note 9</p>
                <p> <strong>Status</strong> In Progress</p>
                <button type="button" class="btn btn-success py-2">Start</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel1">Pending Ticket Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p> <strong> #</strong> 772321</p>
                <p> <strong>Task</strong> Done</p>
                <p> <strong>Type</strong> Repairing</p>
                <p> <strong>Device</strong> Sumsung Note 9</p>
                <p> <strong>Status</strong> In Progress</p>
                <button type="button" class="btn btn-success py-2">Start</button>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function changeStatus(selectedOption, ticketId) {
        // You can send an AJAX request to update the status in the backend
        // Example using fetch API
        fetch('/tickets/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ ticketId: ticketId, status: selectedOption })
        })
        .then(response =>  response.json())
        .then(data=> {
            if(data.message){
            alert(data.message);
            location.reload(); // Reload the page after a successful update
        } else {
            console.error('Failed to Update Status');
        }
    })
    .catch(error => {
        // Handle any errors
        console.error('Error:', error);
    });
        
     
    }
</script>
@endpush