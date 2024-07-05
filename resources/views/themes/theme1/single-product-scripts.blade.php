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
            // const basePriceElement = document.querySelector('.before-dis span') || {innerText: "0"};
            const quantityInput = document.getElementById('quantity');
            const increaseQuantityButton = document.getElementById('increase-quantity');
            const decreaseQuantityButton = document.getElementById('decrease-quantity');
            const variantRadios = document.querySelectorAll('input[name="variant"]');

            function getSelectedVariantId() {
                const selectedRadio = document.querySelector('input[type=radio][name=variant]:checked');
                return parseInt(selectedRadio.value);
            }

            var variantPrices = {!! $productVariantPrices !!};
            
            function calculateVariantPrice() {
                const variantId = getSelectedVariantId();
                var variantPrice = variantPrices[variantId]['price_with_discount'];
                return variantPrice;
            }

            function calculateVariantOriginalPrice() {
                const variantId = getSelectedVariantId();
                const variantPrice = variantPrices[variantId]['price'];
                return variantPrice;
            }

            function calculateTotalPrice() {
                const variantPrice = calculateVariantPrice();
                const variantOriginalPrice = calculateVariantOriginalPrice();
                if (variantPrice === undefined || isNaN(variantPrice)) {
                    console.error("Variant price is not defined or is NaN.");
                    return;
                }
                const quantity = parseInt(quantityInput.value);
                const totalPrice = (variantPrice * quantity);
                const totalOriginalPrice = (variantOriginalPrice * quantity);
                // const totalPriceElement = document.getElementById('total-price');
                // totalPriceElement.innerText = `${totalPrice.toFixed(2)} {{ $currency }}`;
                $('.total-price').each(function(index) {
                    $(this).text(totalPrice.toFixed(2));
                })
                // const basePriceElement = document.querySelector('.before-dis span.base-price');
                // basePriceElement.innerText = `${totalOriginalPrice.toFixed(2)} {{ $currency }}`;
                $('.before-dis span.base-price').each(function(index) {
                    $(this).text(totalOriginalPrice.toFixed(2));
                })
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

            variantRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    calculateTotalPrice();
                    showVariantInfo();
                });
            });

            function showVariantInfo() {
                const pTags = document.querySelectorAll('.code_number');
                pTags.forEach(p => p.classList.add('hidden'));

                const selectedValue = getSelectedVariantId();

                if (selectedValue) {
                    const selectedP = document.querySelector(`.code_number[data-variant-id='${selectedValue}']`);
                    $('.swiper-slide[data-variant-id]').hide();
                    $(`.swiper-slide[data-variant-id=${selectedValue}]`).show();
                    if (selectedP) {
                        selectedP.classList.remove('hidden');
                    }
                }
            }

            // Initial call to set prices and show the correct p tag
            calculateTotalPrice();
            showVariantInfo();
        });
    </script>
