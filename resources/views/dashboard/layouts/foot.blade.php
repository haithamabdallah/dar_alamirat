
<!-- ================== BEGIN core-js ================== -->
<script src="{{ asset('admin-panel/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('admin-panel/assets/js/app.min.js') }}"></script>
<script src="{{asset('admin-panel/assets/js/demo/login-v2.demo.js')}}"></script>
<!-- ================== END core-js ================== -->

<!-- ================== BEGIN page-js ================== -->
<script src="{{asset('admin-panel/assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-colreorder/js/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-colreorder-bs5/js/colReorder.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-rowreorder/js/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-rowreorder-bs5/js/rowReorder.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-select/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-select-bs5/js/select.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/@highlightjs/cdn-assets/highlight.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/js/demo/render.highlight.js')}}"></script>
<script src="{{asset('admin-panel/assets/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- ================== END page-js ================== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@endif


@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: '{{ session('warning') }}',
        });
    </script>
@endif
<script>
    $(".default-select2").select2();
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var categoryId = this.getAttribute('data-id');

                // Use SweetAlert for confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm' + categoryId).submit();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all checkboxes with the class 'switch-status'
        const statusSwitches = document.querySelectorAll('.switch-status');

        statusSwitches.forEach(function(switchElem) {
            switchElem.addEventListener('change', function() {
                const isChecked = this.checked;
                const url = this.getAttribute('data-url'); // Get the URL from data attribute

                axios.post(url, {
                    status: isChecked
                })
                    .then(function(response) {
                        // Display a SweetAlert message with the response
                        Swal.fire({
                            title: 'Success!',
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    })
                    .catch(function(error) {
                        // Display an error message if something went wrong
                        Swal.fire({
                            title: 'Error!',
                            text: 'Unable to update status.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });
            });
        });
    });

</script>
@yield('scripts')
