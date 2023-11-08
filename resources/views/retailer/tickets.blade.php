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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="text-gray-900 font-weight-bold mb-0">Tickets</h4>
        <!-- <h6 class="m-0 font-weight-bold text-primary"> </h6> -->
    </div>
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