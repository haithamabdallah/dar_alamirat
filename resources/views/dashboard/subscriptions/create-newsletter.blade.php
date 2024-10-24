@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>Send Newsletter Email</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Send newsletter Email</li>
                </ul>
                <h1 class="page-header mb-0">Send newsletter Email ( it may take sometime to receive the mail ) </h1>
            </div>
        </div>

        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- newsletter form -->
                    <form action="{{ route('send-newsletter') }}" method="POST" enctype="multipart/form-data" id="newsletter-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 mb-4">
                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Want to test before send ?
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            If you want to test this email first , please mark the checkbox below as true.
                                            <br>
                                            <br>
                                            <label for="is_for_test">Test before sending ?</label>
                                            <input type="checkbox" name="is_for_test" id="is_for_test" value="1">
                                        </div>
                                        @error("is_for_test")
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div class="mb-3" id="test_email_div" style="display: none">
                                            <label  class="form-label" for="test_email">Enter test email address to receive this email  :</label>
                                            <input type="email"  class="form-control" name="test_email" id="test_email" placeholder="example@example.com" autocomplete="email">
                                        </div>
                                        @error("test_email")
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Email Subject
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" id="subject" name="data[subject]" class="form-control" placeholder="Subject">
                                            @error('data.subject')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Email Contnet
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="newsletterContent" class="form-label">Newsletter content</label>
                                            <textarea class="summernote1" id="newsletterContent" name="data[content]" rows="6"></textarea>
                                            @error('data.content')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>

                    <button class="btn btn-primary row col-12" id="test_btn" onclick="sendTestEmail()" style="display: none">Send Test Email</button>
                    <button class="btn btn-primary row col-12" id="real_btn" onclick="document.getElementById('newsletter-email-form').submit()">Send Newsletter Email To Subscribers</button>


                    <div class="row col-12 my-5 rounded p-3" style="background: #efefef; display: none" id="error_div" >
                        <div class="d-flex justify-content-end" style="float: right" onclick="hideErrorDiv()">
                            <button class="bg-danger p-2 text-white rounded">X</button>
                        </div>
                        <div class=""  id="error_div_msg"></div>
                    </div>
                    <!-- ./newsletter form -->
                </div>
                <!-- ./tab pane -->
            </div>
            <!-- ./content -->
        </div>
        <!-- ./end card -->
    </div>
    <!-- END #content -->
@endsection


@section('scripts')
    <script>
        function hideErrorDiv ()
        {
            $('#error_div_msg').html('');
            $('#error_div').hide();
        }

        $('#is_for_test').on('change', function() {
            if($(this).is(':checked')) {
                $('#test_email').val('');
                $('#test_email_div').show();
                $('#test_btn').show();
                $('#real_btn').hide();
            } else {
                $('#test_email').val('');
                $('#test_email_div').hide();
                $('#real_btn').show();
                $('#test_btn').hide();
            }
        })

        function sendTestEmail() {
            $('#error_div').show();
            $('#error_div_msg').html(`<p class="text-warning">processing ... please wait</p>`);

            // Get the form element
            const form = $('#newsletter-email-form')[0];

            // Create a new FormData object
            const formData = new FormData(form);

            // Convert FormData to a plain object
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            console.log(formObject);    
            axios.post("{{ route('send-newsletter') }}", formData)
            .then(function (response) {
                console.log(response);

                if ( response.data.status == 'error' ) {
                    let errors = response.data.errors;
                    let errorMsgs = '';
                    for (const [key, value] of Object.entries(errors)) {
                        errorMsgs += `<p class="text-danger">${key} : ${value}</p>`
                    }
                    $('#error_div').show();
                    $('#error_div_msg').html(  errorMsgs );
                } 
                if ( response.data.status == 'success' ) {
                    $('#error_div').show();
                    $('#error_div_msg').html(`<p class="text-success">${response.data.message}</p>`);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    </script>
@endsection