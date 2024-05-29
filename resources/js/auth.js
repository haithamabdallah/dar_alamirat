$(document).ready(function() {
    $('#emailForm').on('submit', function(e) {
        e.preventDefault();
        sendOtp();
    });

    $('.s-verify-input').on('input', function() {
        if (isOtpComplete()) {
            verifyOtp();
        }
    });

    function sendOtp() {
        $.ajax({
            url: '{{ route("sendOtp") }}',
            method: 'POST',
            data: $('#emailForm').serialize(),
            success: function(response) {
                handleOtpSent(response);
            },
            error: function(xhr) {
                alert('An error occurred. Please try again.');
            }
        });
    }

    function handleOtpSent(response) {
        if (response.success) {
            var email = $('input[name="email"]').val();
            $('#writtenEmail').text(email);
            $('#otpEmail').val(email);
            $('#loginEmail').modal('hide');
            $('#enterOtp').modal('show');
        } else {
            alert(response.message);
        }
    }

    function isOtpComplete() {
        var otp = '';
        $('.s-verify-input').each(function() {
            otp += $(this).val();
        });
        return otp.length === 4;
    }

    function verifyOtp() {
        var formData = $('#otpForm').serialize();
        $.ajax({
            url: '{{ route("verifyOtp") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                handleOtpVerification(response);
            },
            error: function(xhr) {
                $('#otpError').text('An error occurred. Please try again.').show();
            }
        });
    }

    function handleOtpVerification(response) {
        if (response.success) {
            $('#enterOtp').modal('hide');
            window.location.href = response.redirect_url;
        } else {
            $('#otpError').text(response.message || 'Invalid OTP. Please try again.').show();
        }
    }
});
