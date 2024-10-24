<div style="margin: 0;padding: 0;box-sizing: border-box;">

    <div style="max-width:560px; margin: auto; padding: 20px;">

        <!-- big image -->
        <div style="width: 100%; height: auto; overflow: hidden;">
            <a href="{{ $data['images'][1]['link'] }}" style="display: block;">
                <img src="{{ $message->embed(public_path('storage/' . $data['images'][1]['image']) ) }}" alt="image1" style="width: 100%;height: 700px; object-fit: cover;">
            </a>
        </div>
        <!-- big image -->

        <!-- gif image -->
        <div style="width: 100%; overflow: hidden; background: #fff;padding: 20px 0;">
            <a href="{{ $data['images'][2]['link'] }}" style="display: block;">
                <img src="{{ $message->embed(public_path('storage/' . $data['images'][2]['image']) ) }}" alt="image2" style="width: 100%; height: 100px; object-fit: cover;">
            </a>
        </div>
        <!-- gif image -->

        <!-- spacer -->
        <hr style="border-top: 1px solid #cbcbcb;margin: 0; margin-bottom: 20px;">
        <!-- spacer -->

        <!-- big image -->
        <div style="width: 100%; height: 300px; overflow: hidden; margin-bottom: 20px;">
            <a href="{{ $data['images'][3]['link'] }}" style="display: block;">
                <img src="{{ $message->embed(public_path('storage/' . $data['images'][3]['image']) ) }}" alt="image3" style="width: 100%;height: 300px; object-fit: cover;">
            </a>
        </div>
        <!-- big image -->

        <!-- spacer -->
        <hr style="border-top: 1px solid #cbcbcb;margin: 0; margin-bottom: 20px;">
        <!-- spacer -->

        <!-- half image -->
        <div style="width: 100%; height: 400px; overflow: hidden; margin-bottom: 20px;">
            <a href="{{ $data['images'][4]['link'] }}" style="display: block; float: left; width: 50%;">
                <img src="{{ $message->embed(public_path('storage/' . $data['images'][4]['image']) ) }}" alt="image4" style="width: 100%;height: 400px; object-fit: cover;">
            </a>
            <a href="{{ $data['images'][5]['link'] }}" style="display: block; float: right; width: 50%;">
                <img src="{{ $message->embed(public_path('storage/' . $data['images'][5]['image']) ) }}" alt="image5" style="width: 100%;height: 400px; object-fit: cover;">
            </a>
        </div>
        <!-- half image -->

        <!-- spacer -->
        <hr style="border-top: 1px solid #cbcbcb;margin: 0; margin-bottom: 20px;">
        <!-- spacer -->

        <!-- big image -->
        <div style="width: 100%; height: auto; overflow: hidden;margin-bottom: 20px;">
            <a href="{{ $data['images'][6]['link'] }}" style="display: block;">
                <img src="{{ $message->embed(public_path('storage/' . $data['images'][6]['image']) ) }}" alt="image6" style="width: 100%;height: 500px; object-fit: cover;">
            </a>
        </div>
        <!-- big image -->

        <!-- links -->
        <ul style="list-style-type: none;text-align: center; margin: 0; padding: 0; margin-bottom: 20px; display: table; width: 100%; font-family: Sans-Serif; font-weight: bold;">
            <li style="background-color: #8490ff; padding: 20px;display: table-cell;"><a href="{{ $data['texts'][1]['link'] }}" style="display:block; text-decoration: none; text-transform: uppercase; color: #fff;">{{ $data['texts'][1]['text'] }}</a></li>
            <li style="background-color: #dbe55b; padding: 20px;display: table-cell;"><a href="{{ $data['texts'][2]['link'] }}" style="display:block; text-decoration: none; text-transform: uppercase; color: #fff;">{{ $data['texts'][2]['text'] }}</a></li>
            <li style="background-color: #f5bebe; padding: 20px;display: table-cell;"><a href="{{ $data['texts'][3]['link'] }}" style="display:block; text-decoration: none; text-transform: uppercase; color: #fff;">{{ $data['texts'][3]['text'] }}</a></li>
            <li style="background-color: #1b524f; padding: 20px;display: table-cell;"><a href="{{ $data['texts'][4]['link'] }}" style="display:block; text-decoration: none; text-transform: uppercase; color: #fff;">{{ $data['texts'][4]['text'] }}</a></li>
        </ul>
        <!-- links -->

        <!-- social icon -->
        <ul style="list-style-type: none; margin: 0; padding: 0; width: 100%; background-color: #efeee8; margin-bottom: 20px; display: block; text-align: center;">
            <li style="display: inline-block;"><a href="{{ $data['socials']['facebook'] }}" style="display: block;"><img src="{{ $message->embed(public_path('assets/email-images/facebook.png')) }}" alt="facebook" style="width: 40px; height: 40px; object-fit: cover" width="40px"></a></li>
            <li style="display: inline-block;"><a href="{{ $data['socials']['x'] }}" style="display: block;"><img src="{{ $message->embed(public_path('assets/email-images/x.png')) }}" alt="x" style="width: 40px; height: 40px; object-fit: cover" width="40px"></a></li>
            <li style="display: inline-block;"><a href="{{ $data['socials']['instagram'] }}" style="display: block;"><img src="{{ $message->embed(public_path('assets/email-images/instagram.png')) }}" alt="instagram" style="width: 40px; height: 40px; object-fit: cover" width="40px"></a></li>
            <li style="display: inline-block;"><a href="{{ $data['socials']['linkedin'] }}" style="display: block;"><img src="{{ $message->embed(public_path('assets/email-images/linkedin.png')) }}" alt="linkedin" style="width: 40px; height: 40px; object-fit: cover" width="40px"></a></li>
        </ul>
        <!-- social icon -->

        <!-- spacer -->
        <hr style="border-top: 1px solid #cbcbcb;margin: 0; margin-bottom: 20px;">
        <!-- spacer -->

        <!-- half image -->
        <ul style="width: 100%; overflow: hidden; display: table; margin-bottom: 20px; text-align: center; font-family: Sans-Serif;background: #efeee8;padding: 20px 0;">
            <li style="display: table-cell; width: 50%;">
                <a href="" style="display: block; color: #1255cc;">
                    <strong style="width: 100%; display: block; margin-bottom: 7px; text-transform: uppercase">Free Delivery</strong>
                    <span style="width: 100%; display: block">order over 60$</span>
                </a>
            </li>
            <li style="display: table-cell; width: 50%;">
                <a href="" style="display: block;color: #1255cc; border-left: 1px solid #cbcbcb;">
                    <strong style="width: 100%; display: block; margin-bottom: 7px; text-transform: uppercase">Create Your Account</strong>
                    <span style="width: 100%; display: block">Start now</span>
                </a>
            </li>
        </ul>
        <!-- half image -->

        <!-- spacer -->
        <hr style="border-top: 1px solid #cbcbcb;margin: 0; margin-bottom: 20px;">
        <!-- spacer -->

        <div style="background: #efeee8; padding: 20px; ">
            {!! $data['email_footer'] !!}
        </div>
    </div>

</div>