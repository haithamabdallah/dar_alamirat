<!-- OTP Modal -->
<div class="modal fade" id="enterOtp" tabindex="-1" aria-labelledby="enterOtpLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="login-icon">
                    <i class="icon sicon-user"></i>
                </div>
                <h3>Login</h3>
                <p class="s-verify-message">Verification code is required to proceed. A verification code has been sent to you.</p>
                <div class="s-login-modal-currentEmail" id="writtenEmail"></div>
                <form id="otpForm" method="POST">
                    @csrf
                    <input type="hidden" name="email" id="otpEmail">
                    <div class="otp-field s-verify-codes">
                        <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                        <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                        <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                        <input type="text" name="otp[]" maxlength="1" class="s-verify-input" required />
                    </div>
                    <div id="otpError" class="text-danger" style="display: none;">Invalid OTP. Please try again.</div>
                </form>
            </div>
        </div>
    </div>
</div>
