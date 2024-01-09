<div class="item-list" style="display: flex; flex-wrap: wrap;">
    <div class="item" style="border: 1px solid #ddd; margin: 10px; padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        @if ($item->image)
            <img src="{{ asset($item->image) }}" class="item-image" alt="{{ $item->name }}" style="width: 150px; height: 75px; object-fit: cover;">
        @else
            <img src="http://placehold.it/150" class="item-image" alt="Placeholder Image" style="width: 150px; height: 75px; object-fit: cover;">
        @endif
        <div class="item-details" style="text-align: center;">
            <h6 class="item-sku" style="font-size: 1rem; margin-bottom: 5px; margin-top:5px">{{ $item->sku }}</h6>
            <p class="item-name" style="font-size: 14px; margin-bottom: 5px;">{{ $item->item_name }}</p>
            <p class="item-price" style="font-size: 14px; margin-bottom: 5px;">Price: ${{ $item->price }}</p>
            <a href="#" class="btn btn-primary btn-sm" onclick="addToCart('{{ $item->item_name }}', {{ $item->price }})">Add to Cart</a>
        </div>
    </div>
</div>
