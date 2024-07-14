<!-- Email Modal -->
<div class="modal fade" id="mobileSearch" tabindex="-1" aria-labelledby="mobileSearch" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <form id="search-form" action="{{ route('products.search') }}" method="GET">
                    <input class="s-search-input" type="text" placeholder="Search" name="query" id="product-search-input" onkeydown="if(event.key === 'Enter'){ this.form.submit(); return false; }">
                </form>
            </div>
        </div>
    </div>
</div>
