@extends('layouts.admin')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="m-0">{{ $payment_plan->name.' Features' }}</h5>
            <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#addModal">Add
             Feature</button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr No #</th>
                        <th>Payment Plan Features</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (sizeof($payment_plan_features) > 0)
                        @foreach ($payment_plan_features as $p => $row)
                            <tr>
                               
                                <td>{{ $p+1 }}</td>
                                <td>
                                    <span class="fw-medium">
                                        {{ Str::words($row->feature_detail, $words = 5, $end = '...') }}</span>
                                </td>
                           
                                @php
                                    $encodedId = base64_encode($row->id); // Encode the real ID
                                @endphp
                            
                                <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editModal" onclick="editForm({{ $row->id}})">
                                        View / Edit Feature
                                    </button>
                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm"
                                        onclick="deletePlanFeature({{ $row->id }})">
                                        Delete
                                    </button>

                                </td>


                            </tr>
                        @endforeach
                        @else
                        <td> No feature Listed yet</td>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    
    <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Payment Plan Feature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <!-- Add form fields here -->
                        <input type="hidden" name="payment_plan_id" id="planId" value="{{ $payment_plan->id }}">
                        <div class="form-group">
                            <label for="feature_detail">Feature Detail</label>
                            <input type="text" class="form-control" id="addFeatureDetail" name="feature_detail">
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
                    <h5 class="modal-title">Edit Payment Plan Feature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="paymentPlanFeatureForm">
                        @csrf
                        {{-- <input type="hidden" id="paymentPlanSlug" name="payment_plan_slug" value="{{ $payment_plan->slug }}"> --}}
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="feature_detail">Feature Detail</label>
                            <input type="text" class="form-control" id="featureDetail" name="feature_detail">
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
            const feature_detail = document.getElementById('addFeatureDetail').value;
            const plan_id = document.getElementById('planId').value
            const data = {
                feature_detail: feature_detail,
                payment_plan_id:plan_id
            
            };

            fetch('/payment-plan-feature/create', {
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
            const form = document.getElementById('paymentPlanFeatureForm');
            if (form) {
                const id = document.getElementById('id').value;
                const feature_detail = document.getElementById('featureDetail').value;
               

                const data = {
                    id: id,
                    feature_detail: feature_detail,
               
                };
        

                let url = '/payment-plan-feature';
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
            // let slug = document.getElementById('paymentPlanSlug').value;
            console.log(id);
           
            fetch('/payment-plan-feature/' + id + '/edit')
                .then(response => response.json())
                .then(data => {
                    $('#id').val(data.id);
                    $('#featureDetail').val(data.feature_detail);
                   
                    $('#editModal').modal('show');
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        function deletePlanFeature(id) {
            $('#deleteModal').modal('show'); // Show the delete confirmation modal

            // When the confirm button is clicked in the modal
            $('#confirmDelete').on('click', function() {
                fetch('/payment-plan-feature/' + id, {
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
