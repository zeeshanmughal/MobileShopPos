@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" mb-3">
    <div class="row">
        <h3 class="mb-4 col-md-11">NOTES 
            </h3>
            <div class="text-right col-md-1"><button class="btn w-100 btn-dark text-white">New</button> </div>
        
        <div class="col-md-6">
            <table class="table bg-white customer-table">
                <tbody>
                        <tr class="text-muted font-weight-bold">
                            <td class="text-dark">Created</td>
                            <td>Title</td>
                        </tr>
                        <tr class="text-dark font-weight-bold">
                            <td colspan="2" class="text-dark">No Noted Created</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="noted-detail p-3">
                <h4 class="mb-3">New Note</h4>
                <form>
                    <div class="form-row pb-3">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-row pb-3">
                        <div class="col">
                          <textarea type="text" rows="11" class="form-control"></textarea>
                        </div>
                    </div>
                    <button class="btn-primary btn text-white py-2 px-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection