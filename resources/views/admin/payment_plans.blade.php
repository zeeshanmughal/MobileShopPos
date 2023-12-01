@extends('layouts.admin')

@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center card-header">
                <h5 class="m-0">Table Payment Plans</h5>
                <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#addModal">Add
                    Plan</button>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Plan Name</th>
                            <th>Plan Price</th>
                            <th>Interval Months</th>
                            <th>View Features</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if (sizeof($paymentPlans) > 0)
                            @foreach ($paymentPlans as $pp => $row)
                                <tr>
                                    <td>

                                        <span class="fw-medium">{{ $row->name }}</span>
                                    </td>
                                    <td>{{ '$ ' . $row->price }}</td>
                                    <td>{{ Str::upper($row->interval) .' Months' }}</td>
                                    @php
                                        $encodedId = base64_encode($row->id); // Encode the real ID
                                    @endphp
                                    <td><a href="{{ route('paymentPlanFeatures', ['payment_plan'=> $row->slug]) }}" type="button"
                                            class="btn btn-info btn-sm">
                                            View Features
                                        </a>
                                    </td>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editModal" onclick="editForm({{ $row->id }})">
                                            Edit
                                        </button>
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="deletePlan({{ $row->id }})">
                                            Delete
                                        </button>

                                    </td>


                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Payment Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <!-- Add form fields here -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="addName" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Price</label>
                            <input type="text" class="form-control" id="addPrice" name="price">
                        </div>
                        <div class="form-group">
                            <label for="name">Package Duration (Months)</label>
                            <input type="text" class="form-control" id="addInterval" name="interval" min="1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitAddForm()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add/Edit Payment Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="paymentPlanForm">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="interval">Package Duration (Months)</label>
                            <input type="text" class="form-control" id="interval" name="interval" min="1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this payment plan?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection

@push('js')
    <script>
        function submitAddForm() {
            const name = document.getElementById('addName').value;
            const price = document.getElementById('addPrice').value;
            const interval = document.getElementById('addInterval').value;

            const data = {
                name: name,
                price: price,
                interval: interval
            };

            fetch('/payment-plans', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Added Successfully:', data);
                    $('#addModal').modal('hide');
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function submitForm() {
            const form = document.getElementById('paymentPlanForm');
            if (form) {
                const id = document.getElementById('id').value;
                const name = document.getElementById('name').value;
                const price = document.getElementById('price').value;
                const interval = document.getElementById('interval').value;

                const data = {
                    id: id,
                    name: name,
                    price: price,
                    interval: interval
                };
                console.log('id : ', id)
                console.log('name : ', name)
                console.log('price : ', price)
                console.log('interval : ', interval)

                let url = '/payment-plans';
                let method = 'POST';

                if (id) {
                    url += '/' + id;
                    method = 'PUT';
                }

                fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        $('#editModal').modal('hide');
                        window.location.reload(); // Reload the page
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function editForm(id) {
            fetch('/payment-plans/' + id + '/edit')
                .then(response => response.json())
                .then(data => {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#price').val(data.price);
                    $('#interval').val(data.interval);
                    $('#editModal').modal('show');
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        function deletePlan(id) {
            $('#deleteModal').modal('show'); // Show the delete confirmation modal

            // When the confirm button is clicked in the modal
            $('#confirmDelete').on('click', function() {
                fetch('/payment-plans/' + id, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Deleted Successfully:', data);
                        $('#deleteModal').modal('hide'); // Hide the delete confirmation modal
                        window.location.reload(); // Reload the page to reflect the changes
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }

        // Clear form data when the modal is hidden
        // $('#editModal').on('hidden.bs.modal', function() {
        //     $('#id').val('');
        //     $('#name').val('');
        //     $('#price').val('');
        //     $('#interval').val('');
        //     $(this).find('input, textarea, select').val('');
        //     $(this).find('input[type=checkbox], input[type=radio]').prop('checked', false);
        //     $('body').removeClass('modal-open');
        //     $('.modal-backdrop').remove();
        //     $('#outsideElement').focus();
        // });
    </script>
@endpush
