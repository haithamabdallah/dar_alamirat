@if (isset($products) && count($products) > 0)
    @foreach ($products as $index => $product)
        <tr>
            <td class="w-10px align-middle">
                {{ $index + 1 }}
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="w-30px h-30px bg-light d-flex align-items-center justify-content-center">
                        <img alt="" class="mw-100 mh-100" src="{{ $product->thumbnail }}" />
                    </div>
                </div>
            </td>
            <td>
                <a href="{{ route('product', $product->id) }}"
                    class="text-dark text-decoration-none">{{ $product->title }}</a>
            </td>
            <td>
                <ul>
                    @foreach ($product->variants as $index => $variant)
                        <li>{{ $index + 1 }} ----- {{ $variant->variant_name }} -----
                            {{ $variant->price_with_discount }} ----- {{ $variant->sku }}
                        </li>
                    @endforeach
                </ul>
            </td>
            <td class="align-middle">{{ $product->inventory->sum('quantity') }} in stock for
                {{ $product->variants->count() }} variants</td>
            <td class="align-middle">{{ $product->category->name }}</td>
            <td class="align-middle">{{ $product->brand->name }}</td>
            <td>
                <div class="form-check form-switch">
                    <input id="toggleStatusCheckbox{{ $product->id }}"
                        class="form-check-input toggle-status-checkbox {{ $product->is_returnable ? '1' : '0' }}"
                        data-id="{{ $product->id }}" type="checkbox" {{ $product->is_returnable ? 'checked' : '' }}>
                </div>
            </td>
            <td nowrap="">
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary"> <i
                            class="fa-regular fa-pen-to-square"></i>
                        {{ __('dashboard.product.edit') }}</a>
            </td>
            <td nowrap="">
                    <form id="deleteForm{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn delete-btn btn-danger" data-id="{{ $product->id }}"> <i
                                class="fa-solid fa-trash-can"></i>
                            {{ __('dashboard.product.delete') }}</a>
                    </form>
            </td>
        </tr>
    @endforeach
@endif
