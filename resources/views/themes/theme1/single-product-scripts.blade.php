    <script src="{{ asset('theme1-assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.zoom-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-with-zoom mfp-img-mobil',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Dar Alamirat</small>';
                    }
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't foget to change the duration also in CSS
                    opener: function(element) {
                        return element.find('img');
                    }
                }
            });
        });
    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const basePriceElement = document.getElementById('base-price');
            const totalPriceElement = document.getElementById('total-price');
            const quantityInput = document.getElementById('quantity');
            const increaseQuantityButton = document.getElementById('increase-quantity');
            const decreaseQuantityButton = document.getElementById('decrease-quantity');
            const variantSelect = document.getElementById('variant-select');

            const basePrice = parseInt(basePriceElement.innerText);
            const variantPrices = {!! $product->variant_prices !!};


            function calculateVariantPrice() {
                const variantId = parseInt(variantSelect.value);
                const variantPrice = variantPrices[variantId]['price_with_discount'];
                return variantPrice;
            }

            function calculateTotalPrice() {
                const variantPrice =  calculateVariantPrice();
                const quantity = parseInt(quantityInput.value);
                const totalPrice = (variantPrice * quantity) ;
                totalPriceElement.innerText = totalPrice.toFixed(2);
            }

            increaseQuantityButton.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                quantityInput.value = quantity + 1;
                calculateTotalPrice();
            });

            decreaseQuantityButton.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                    calculateTotalPrice();
                }
            });

            variantSelect.addEventListener('change', function() {
                const variantPrice =  calculateVariantPrice();
                basePriceElement.innerText = variantPrice.toFixed(2);
                calculateTotalPrice();
            });
            
            calculateTotalPrice();
        });


    </script>
