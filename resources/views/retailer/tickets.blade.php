@extends('layouts.retailer')

@section('content')


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
                        <td><a href="#" data-toggle="modal" data-target="#exampleModal">Tiger Nixon</a></td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>
                            <div class="form-group ">
                                <select id="dropdown" name="role" class="greenbtn form-control" required>
                                    <option disabled selected value>Select</option>
                                    <option value="Individual">Student</option>
                                    <option value="preferNo">Not to say</option>
                                    <option value="other">Other</option>
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
                <p> <strong>Ticket #</strong> 772321</p>
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