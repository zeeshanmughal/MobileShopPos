<div class="card-body" id = "tickets">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Customer Name</th>

                    <th>Task</th>
                    <th>Type</th>
                    <th>Device</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $t=> $ticket)
                    <tr>

                        <td><a href="#" data-toggle="modal" data-target="#exampleModal">{{ $ticket->ticket_id }}</a>
                        </td>
                        @if ($ticket->customer)
                            <td>{{ $ticket->customer->first_name . ' ' . $ticket->customer->last_name }}</td>
                        @else
                            <td>Not Found</td>
                        @endif
                        @if ($ticket->serviceDetail)
                            <!-- Check if serviceDetail is not null -->
                            <td>{{ $ticket->serviceDetail->device_issue }}</td>
                        @else
                            <td>No Device Issue.</td>
                        @endif

                        @if ($ticket->serviceDetail)
                            <td>
                                {{ $ticket->serviceDetail->repair_category }}</td>
                        @else
                            <td> No Repair category.</td>
                        @endif


                        @if ($ticket->serviceDetail)
                            <td> {{ $ticket->serviceDetail->device }}</td>
                        @else
                            <td> No Device.</td>
                        @endif

                        <td>
                            <button
                                class='pending btn text-white py-1 f-14 bg-gradient-warning'>{{ ucwords(str_replace('_', ' ', $ticket->ticket_status)) }}</button>

                        </td>

                        <td>
                            <div class="form-group ">
                                <select id="dropdown" name="role" class=" form-control"
                                    onchange="changeStatus(this.value, {{ $ticket->id }})">
                                    <option value="in_progress" @if ($ticket->ticket_status == 'in_progress')  @endif>In
                                        Progress</option>
                                    <option value="completed" @if ($ticket->ticket_status == 'awaiting_collection')  @endif>
                                        Awaiting Collection (send sms or email)</option>
                                    <option value="completed" @if ($ticket->ticket_status == 'awaiting_parts')  @endif>
                                        Awaiting for parts</option>
                                    <option value="completed" @if ($ticket->ticket_status == 'dispatch')  @endif>
                                        Dispatch to repair center</option>

                                    <option value="completed" @if ($ticket->ticket_status == 'completed')  @endif>
                                        Completed</option>

                                    <option value="pending" @if ($ticket->ticket_status == 'canceled')  @endif>Canceled
                                    </option>
                                </select>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @empty
                    <td colspan="5" style="border: none;">
                        <h5 style="font-weight: bold; margin-top:3px">No Tickets Yet</h5>
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
