@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="row">
    <h3 class="col-md-12 mb-4">Category</h3>
    <div class="col-md-12">
                <div class="bg-primary text-white p-3 mt-2 mb-4">Category has been Added</div>
            </div>
    <div class="col-md-12 mb-4">
        <table class="table customer-table ">
            <tbody>
                    <tr>
                        <th class="text-muted">Name</th>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">Jordan Shoes</td>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">Iphone X</td>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">Samsung note 3</td>
                    </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">New Category</button>
    </div>
</div>
<div class="card d-none">
    <div class="card-body">
        <strong>No customers found.</strong>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="">Name</label>
                <input type="email" class="form-control" id="" placeholder="">
            </div>
            <button class="btn btn-primary w-100 text-white">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
