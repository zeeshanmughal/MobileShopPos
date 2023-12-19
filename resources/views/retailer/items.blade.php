@extends('layouts.retailer')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Device Model</th>
                <th>Manufacturer</th>
                <th>Warranty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (sizeof($items) > 0)
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->device_model }}</td>
                        <td>{{ $item->manufacturer }}</td>
                        <td>{{ $item->warranty }}</td>
                        <td>
                            <a  data-item-id="{{ $item->id }}" class="btn btn-primary view-item " data-toggle="tooltip" title="View Item" style="font-size: 12px;">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-success"  data-toggle="tooltip" title="Edit Item" style="font-size: 12px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('item.destroy', $item->id) }}" method="post"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                    style="font-size: 12px;"  data-toggle="tooltip" title="Delete Item">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td>No Item avaible
                    </td>
                 </tr>
            @endif
        </tbody>
    </table>
    <!-- Modal HTML -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Item Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div  id="itemDetails">
                    <!-- Item details will be displayed here -->
                    {{-- <p><strong>Item ID:</strong> <span id="itemID"></span></p> --}}

                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')
<script>
    $('.view-item').on('click', function (e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        console.log(itemId);
        $.ajax({
            type: 'GET',
            url: '/item/' + itemId,
            success: function (data) {
                console.log(data);
                var itemDetails = data;
                console.log('item----detail----',itemDetails);
                var imageUrl = window.location.origin.'/public/'.${itemDetails.image}
                var detailsHTML = `
                <p>SKU: ${itemDetails.sku}</p>
                    <p>Item Name: ${itemDetails.item_name}</p>
                    <p>Item Category: ${itemDetails.item_category}</p>
                    <p>Item Category: ${itemDetails.item_category}</p>
                    <p>Manufacturer: ${itemDetails.manufacturer}</p>
                    <p>Sub Category: ${itemDetails.sub_category}</p>
                    <p>Short Description: ${itemDetails.short_description}</p>
                    <img src="${imageUrl}" alt="Item Image" style="max-width: 100px; max-height: 100px;">

                `;
                $('#itemDetails').html(detailsHTML);
                $('#itemModal').modal('show');
            },
            error: function (error) {
                // Handle any errors here
                console.error(error);
            }
        });
    });
</script>
@endpush
