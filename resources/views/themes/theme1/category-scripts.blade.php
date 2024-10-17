    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let loadMoreButton = document.getElementById('load-more');
            let nextPageUrl = "{{ $products->nextPageUrl() }}"; // Initialize with the next page URL

            loadMoreButton.addEventListener('click', function() {
                if (nextPageUrl) {
                    fetch(nextPageUrl, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            let productsContainer = document.querySelector('.products-container');
                            data.products.forEach(product => {
                                console.log(product.variants[0].price_with_discount)
                                //     <!-- tags -->
                                // <div class="item-tags">
                                //     <span>most popular</span>
                                // </div>
                                // <!-- ./tags -->
                                let productHtml = `
                        <div class="item">

                            <!-- img -->
                            <div class="img">
                                <a href="">
                                    <img class="w-full object-contain" loading="lazy" src="${product.thumbnail}" alt="Product Image">
                                </a>
                            </div>
                            <!-- img -->

                            <!-- data -->
                            <div class="item-data">
                                <!-- price -->
                                <div class="item-price">
                                    ${product.discount_value > 0 ? `<h4 class="before-dis"><strong>${product.variants[0].price}</strong><span>{{ $currency }}</span></h4>` : ''}
                                    <h4 class="after-dis"><strong>${product.variants[0].price_with_discount}</strong><span>{{ $currency }}</span></h4>
                                    <div class="add-favourite">
                                        <button class="icon-fav">
                                            <i class="sicon-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- ./price -->

                                <!-- description -->
                                <div class="item-dec">
                                    <a href="">
                                        <span>${product.title['en']}</span>
                                    </a>
                                </div>
                                <!-- ./description -->

                                <!-- button cart -->
                                <button class="tocart add-to-cart button--submit" data-title="Add to Cart">
                                    <span class="button-title"></span>
                                    <i class="sicon-shopping button-icon icon-tocart" data-icon="tocart"></i>
                                    <span class="button-icon icon-wait" data-icon="tocart" style="display: none;">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M19,8L15,12H18A6,6 0 0,1 12,18C11,18 10.03,17.75 9.2,17.3L7.74,18.76C8.97,19.54 10.43,20 12,20A8,8 0 0,0 20,12H23M6,12A6,6 0 0,1 12,6C13,6 13.97,6.25 14.8,6.7L16.26,5.24C15.03,4.46 13.57,4 12,4A8,8 0 0,0 4,12H1L5,16L9,12"></path>
                                        </svg>
                                    </span>
                                    <span class="button-icon icon-success" style="display: none;" data-icon="tocart">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"></path>
                                        </svg>
                                    </span>
                                </button>
                                <!-- ./button cart -->
                            </div>
                            <!-- ./data -->
                        </div>
                        <!-- product item -->
                    `;
                                productsContainer.insertAdjacentHTML('beforeend', productHtml);
                            });
                            nextPageUrl = data.nextPage; // Update the next page URL
                            if (!nextPageUrl) {
                                loadMoreButton.style.display =
                                    'none'; // Hide the button if no more pages
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.filter-form');

            forms.forEach(form => {
                const radios = form.querySelectorAll('input[type="radio"]');

                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        form.submit();
                    });
                });
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.filter-form');

            forms.forEach(form => {
                const radios = form.querySelectorAll('input[type="radio"]');
                const numberInputs = form.querySelectorAll('input[type="number"]');

                function preserveFilters(form) {
                    const urlParams = new URLSearchParams(window.location.search);

                    // Preserve all existing filters
                    urlParams.forEach((value, key) => {
                        if (!form.querySelector(`[name="${key}"]`)) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = key;
                            hiddenInput.value = value;
                            form.appendChild(hiddenInput);
                        }
                    });
                }

                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        preserveFilters(form);
                        form.submit();
                    });
                });

                // numberInputs.forEach(input => {
                //     input.addEventListener('change', function() {
                //         preserveFilters(form);
                //         form.submit();
                //     });
                // });
            });
        });
    </script>
