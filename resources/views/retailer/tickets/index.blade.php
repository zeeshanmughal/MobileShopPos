@extends('layouts.retailer')

@section('content')
    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 ">
            <div class="form-group">

                <input type="text" id="search" class="form-control" placeholder="Enter Ticket Number or Customer Name">
            </div>
        </div>
    </div>
    <div class="bg-white shadow-sm">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-toggle="tab" data-target="#all" type="button"
                    role="tab" aria-controls="all" aria-selected="true">All Tickets</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-toggle="tab" data-target="#pending" type="button"
                    role="tab" aria-controls="pending" aria-selected="true">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="progress-tab" data-toggle="tab" data-target="#progress" type="button"
                    role="tab" aria-controls="progress" aria-selected="false">In Progress</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="complete-tab" data-toggle="tab" data-target="#complete" type="button"
                    role="tab" aria-controls="complete" aria-selected="false">Complete</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all">
                <div class="card shadow mb-4">
                    @include('retailer.tickets.table', ['tickets' => $allTickets])
                </div>
            </div>
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending">
                <div class="card shadow mb-4">
                    @include('retailer.tickets.table', ['tickets' => $pendingTickets])
                </div>
            </div>
            <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                <div class="card shadow mb-4">
                    @include('retailer.tickets.table', ['tickets' => $inProgressTickets])
                </div>
            </div>
            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                <div class="card shadow mb-4">
                    @include('retailer.tickets.table', ['tickets' => $completedTickets])
                </div>
            </div>
        </div>
    </div>
    <!-- -------` -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel1">Pending Ticket Details
                    </h5>
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
        function printTicket(ticketId) {
            // Implement logic to print ticket for the given ticketId

            $.ajax({
                url: '/tickets/print-ticket/' + ticketId,
                type: 'GET',
                success: function(response) {
                    if (response.error) {
                        // Redirect back with an error message
                        alert('Error: ' + response.error);
                        window.location.href = '/tickets'; // Replace with your actual URL
                    } else {
                        // Check if the PDF content is present
                        if (response.pdf) {
                            // Open a new window with the PDF
                            var newWindow = window.open();
                            newWindow.document.write(
                                '<embed width="100%" height="100%" name="plugin" src="data:application/pdf;base64,' +
                                response.pdf + '" type="application/pdf" />');

                            // Optional: You can close the new window after viewing
                            // newWindow.close();
                        } else {
                            // Handle the case when PDF content is undefined or not present
                            alert('Error: PDF content is missing in the response.');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        // Function to handle printing label
        function printLabel(ticketId) {
            $.ajax({
                url: '/tickets/print-label/' + ticketId,
                type: 'GET',
                success: function(response) {
                    // Open the generated label content in a new tab or window for printing
                    window.open(response.labelUrl, '_blank');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        function changeStatus(selectedOption, ticketId) {
            // You can send an AJAX request to update the status in the backend
            // Example using fetch API
            fetch('/tickets/update-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        ticketId: ticketId,
                        status: selectedOption
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
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
    <!-- Script for AJAX search -->
    <script>
        $(document).ready(function() {

            var activeTab = 'all-tab';
            var searchQuery = '';

            loadTickets();

            $('#search').on('input', function() {
                searchQuery = $(this).val();
                loadTickets();
            });

            $('#myTab button').on('click', function(e) {
                e.preventDefault();
                activeTab = $(this).attr('id');
                loadTickets();
                $(this).tab('show');
            });

            function loadTickets() {

                var url = '';
                switch (activeTab) {
                    case 'all-tab':
                        url = '{{ route('search-tickets', ['status' => 'all']) }}';
                        break;
                    case 'pending-tab':
                        url = '{{ route('search-tickets', ['status' => 'pending']) }}';
                        break;
                    case 'progress-tab':
                        url = '{{ route('search-tickets', ['status' => 'in_progress']) }}';
                        break;
                    case 'complete-tab':
                        url = '{{ route('search-tickets', ['status' => 'completed']) }}';
                        break;
                }

                // Make an AJAX request to fetch and display the search results
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        searchQuery: searchQuery,
                    },
                    success: function(response) {
                        console.log('Ajax Success. Active Tab:', activeTab);
                        console.log('Search Query:', searchQuery);
                        console.log('Response:', response);
                        switch (activeTab) {
                            case 'all-tab':
                                $('#all').html(generateCustomHtml(response.tickets));
                                break;
                            case 'pending-tab':
                                $('#pending').html(generateCustomHtml(response.tickets));
                                break;
                            case 'progress-tab':
                                $('#progress').html(generateCustomHtml(response.tickets));
                                break;
                            case 'complete-tab':
                                $('#complete').html(generateCustomHtml(response.tickets));
                                break;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }



            // Function to generate custom HTML based on the response data
            function generateCustomHtml(tickets) {
                console.log('Custom Html ==' + tickets)
                let html =
                    '<div class="card-body"><div class="table-responsive"><table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Ticket #</th><th>Task</th><th>Type</th><th>Device</th><th>Status</th><th>Action</th><th>Print Ticket</th><th>Print Label</th></tr></thead><tbody>';

                tickets.forEach(ticket => {
                    console.log();
                    html += '<tr>';
                    html += '<td><a href="#" data-toggle="modal" data-target="#exampleModal">' + ticket
                        .ticket_id + '</a></td>';
                    // Accessing customer and serviceDetail attributes
                    html += '<td>' + (ticket.customer ? ticket.customer.first_name + ' ' + ticket.customer
                        .last_name : 'No Customer') + '</td>';
                    html += '<td>' + (ticket.service_detail ? ticket.service_detail.device_issue.issue_description :
                        'No Device Issue') + '</td>';
                    html += '<td>' + (ticket.service_detail ? ticket.service_detail.device_name :
                        'No Repair Category') + '</td>';
                    html += '<td><button class="pending btn text-white py-1 f-14 bg-gradient-warning">' +
                        capitalizeFirstLetter(replaceUnderscore(ticket.ticket_status)) + '</button></td>';
                    html += '<td>' +
                        '<div class="form-group">' +
                        '<select id="dropdown" name="role" class="form-control" onchange="changeStatus(this.value, ' +
                        ticket.id + ')">' +
                        '<option value="in_progress" ' + (ticket.ticket_status == 'pending' ?
                            'selected' : '') + '>Pending</option>'+
                        '<option value="in_progress" ' + (ticket.ticket_status == 'in_progress' ?
                            'selected' : '') + '>In Progress</option>' +
                        '<option value="awaiting_collection" ' + (ticket.ticket_status ==
                            'awaiting_collection' ? 'selected' : '') +
                        '>Awaiting Collection (send sms or email)</option>' +
                        '<option value="awaiting_parts" ' + (ticket.ticket_status == 'awaiting_parts' ?
                            'selected' : '') + '>Awaiting for parts</option>' +
                        '<option value="dispatch" ' + (ticket.ticket_status == 'dispatch' ? 'selected' :
                        '') + '>Dispatch to repair center</option>' +
                        '<option value="completed" ' + (ticket.ticket_status == 'completed' ? 'selected' :
                            '') + '>Completed</option>' +
                        '<option value="canceled" ' + (ticket.ticket_status == 'canceled' ? 'selected' :
                        '') + '>Canceled</option>' +
                        '</select>' +
                        '</div>' +
                        '</td>';

                    // Print Ticket Button
                    html += '<td><button class="btn btn-sm btn-primary" onclick="printTicket(\'' + ticket
                        .id +
                        '\')" style="height: 70px; width: 70px; font-size:14px;">Print Ticket</button></td>';



                    // Print Label Button
                    html += '<td><button class="btn btn-success btn-sm" onclick="printLabel(\'' + ticket
                        .id +
                        '\')"style="height: 70px; width: 70px; font-size:14px;">Print Label</button></td>';

                    html += '</tr>';
                });

                html += '</tbody></table></div></div>';

                return html;
            }

            function replaceUnderscore(str) {
                return str.replace(/_/g, ' ');
            }

            function capitalizeFirstLetter(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }
            // Function to handle printing ticket


        });
    </script>
@endpush
