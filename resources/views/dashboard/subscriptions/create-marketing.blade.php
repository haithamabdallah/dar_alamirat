@php
    $settings = $currentSettings;
    // dd($settings);
@endphp
@extends('dashboard.layouts.app')

@section('meta')
    <meta charset="utf-8" />
    <title>Send Marketing Email</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
@endsection

@section('content')

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        @include('dashboard.layouts.alerts')
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Send marketing Email</li>
                </ul>
                <h1 class="page-header mb-0">Send marketing Email ( it may take sometime to receive the mail ) </h1>
            </div>
        </div>

        <!-- start card -->
        <div class="card border-0">
            <!-- content -->
            <div class="tab-content p-3">
                <!-- tab pane -->
                <div class="tab-pane fade show active" id="allTab">
                    <!-- marketing Email form -->
                    <form action="{{ route('send-marketing') }}" method="POST" enctype="multipart/form-data" id="marketing-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10">
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
                                        <div class="mb-3" id="subject_div">
                                            <label  class="form-label" for="subject">Enter Email Subject :</label>
                                            <input type="email"  class="form-control" name="subject" id="subject" placeholder="Subject">
                                        </div>
                                        @error("subject")
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 1 ( image 1 ) 
                                    </div>
                                    <div class="card-body">
                                        @include('dashboard.subscriptions.components.image-link' , ['imageIndex' => '1' , 'imageSize' => '560 x 700'] )
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 2 ( image 2 ) 
                                    </div>
                                    <div class="card-body">
                                        @include('dashboard.subscriptions.components.image-link' , ['imageIndex' => '2' , 'imageSize' => '560 x 100'] )
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 3 ( image 3 ) 
                                    </div>
                                    <div class="card-body">
                                        @include('dashboard.subscriptions.components.image-link' , ['imageIndex' => '3' , 'imageSize' => '560 x 300'] )
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 4 ( image 4 ( left ) , image 5 ( right ) ) 
                                    </div>
                                    <div class="card-body d-flex justify-content-around">
                                        @include('dashboard.subscriptions.components.image-link' , ['imageIndex' => '4' , 'imageSize' => '280 x 400' , 'isHalf' => 1] )
                                        @include('dashboard.subscriptions.components.image-link' , ['imageIndex' => '5' , 'imageSize' => '280 x 400'  , 'isHalf' => 1] )
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 5 ( image 6 ) 
                                    </div>
                                    <div class="card-body">
                                        @include('dashboard.subscriptions.components.image-link' , ['imageIndex' => '6' , 'imageSize' => '560 x 500' ] )
                                    </div>
                                    
                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 6 ( 4 texts & links from left to right ) 
                                    </div>
                                    <div class="card-body d-flex flex-wrap justify-content-around" style="gap: 5px">
                                        @include('dashboard.subscriptions.components.text-link' , ['textIndex' => '1' , 'textValue' => 'Skin Care' , 'linkValue' => config('app.frontend_url') . '/skin_care' ] )
                                        @include('dashboard.subscriptions.components.text-link' , ['textIndex' => '2' , 'textValue' => 'Hair Care' , 'linkValue' => config('app.frontend_url') . '/hair_care' ] )
                                        @include('dashboard.subscriptions.components.text-link' , ['textIndex' => '3' , 'textValue' => 'Health Care' , 'linkValue' => config('app.frontend_url') . '/health_care' ] )
                                        @include('dashboard.subscriptions.components.text-link' , ['textIndex' => '4' , 'textValue' => 'Makeup' , 'linkValue' => config('app.frontend_url') . '/makeup' ] )
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 7 ( social links ) 
                                    </div>
                                    <div class="card-body d-flex flex-wrap justify-content-around" style="gap: 10px">
                                        @include('dashboard.subscriptions.components.social-link' , ['socialIndex' => 'facebook' , 'linkValue' => ($settings['facebook'] ?? '/' ) ] )
                                        @include('dashboard.subscriptions.components.social-link' , ['socialIndex' => 'x' , 'linkValue' => ($settings['twitter'] ?? '/' ) ] )
                                        @include('dashboard.subscriptions.components.social-link' , ['socialIndex' => 'instagram' , 'linkValue' => ($settings['instagram'] ?? '/' ) ] )
                                        @include('dashboard.subscriptions.components.social-link' , ['socialIndex' => 'linkedin' , 'linkValue' => ($settings['linkedin'] ?? '/' )] )
                                    </div>

                                    <div class="card-header h4 mb-0 bg-black text-white rounded p-3 ">
                                        Section 8 ( footer ) 
                                    </div>
                                    <div class="card-body" >
                                        <label for="email_footer" class="form-label">Email Footer</label>
                                        <textarea class="summernote1" id="email_footer" name="email_footer" rows="6">
                                            <p style="color: #4e4e4e; font-size: 12px; font-family: sans-serif; line-height: 22px;">*Online only. Get 25% off on aluminum bottles. Must use promo code ALU25 at checkout. Some exclusions may apply. Offer not available on bundles, sets , Laundry and Softener aluminum bottles. Offer only available on
                                                <a href="" style="color: #1255cc;">ca.attitudeliving.com</a>, <a href="" style="color: #1255cc;">ca.attitudeliving.com/fr</a> and <a href="" style="color: #1255cc;">https://attitudeliving.com</a> while supplies last. Offer is valid from July 20, 2024 through July 21, 2024 until 11:59 PM EST. No price adjustments, offers cannot be applied to previously placed orders or to orders placed after the expiration date. Cannot be combined with any other promo codes/offers/discounts. Not applicable on on-going subscriptions. ATTITUDE reserves the right to cancel any order due to unauthorized, altered or ineligible use of offer and to modify or cancel any promotion due to system error or unforeseen problems. Ongoing offers are subject to change without notice. Other restrictions may apply.</p>
                                            <p style="text-align: center; margin-top: 20px;">
                                                <a href="" style="text-decoration: underline; color: #1255cc;">Unsubscribe</a>
                                            </p>
                                            <div style="text-align: center; line-height: 10px; margin-top: 40px; font-size: 12px; font-family: Sans-Serif;">
                                                <p>ATTITUDE</p>
                                                <p>5605 de Gaspe, suite 900 Montreal, QC H2T2A4</p>
                                                <a href="" style="display: block;">info@attitudeliving.com</a>
                                                <p>© 2024 ATTITUDE. All rights reserved.</p>
                                            </div>
                                        </textarea>
                                        @error('data.content')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <img src="{{ asset('assets/email-images/marketing.png')}}" alt="marketing image" width="100%">
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-primary row col-10" id="test_btn" onclick="sendTestEmail()" style="display: none">Send Test Email</button>
                    <button class="btn btn-primary row col-10" id="real_btn" onclick="document.getElementById('marketing-email-form').submit()">Send marketing Email To Subscribers</button>

                    <div class="row col-10 my-5 rounded p-3" style="background: #efefef; display: none" id="error_div" >
                        <div class="d-flex justify-content-end" style="float: right" onclick="hideErrorDiv()">
                            <button class="bg-danger p-2 text-white rounded">X</button>
                        </div>
                        <div class=""  id="error_div_msg"></div>
                    </div>


                    <!-- ./marketing Email form -->
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

        function preview(index) 
        {
            $(`#frame${index}`)[0].src = URL.createObjectURL(event.target.files[0]);
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
            const form = $('#marketing-email-form')[0];

            // Create a new FormData object
            const formData = new FormData(form);

            // Convert FormData to a plain object
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            console.log(formObject);    
            axios.post("{{ route('send-marketing') }}", formData)
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
