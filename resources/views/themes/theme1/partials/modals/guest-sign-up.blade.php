<!-- Email Modal -->
<div class="modal fade" id="guestSignUp" tabindex="-1" aria-labelledby="guestSignUpLabel" aria-hidden="true"
    style="z-index: 99999;background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guestSignUpLabel">{{ __('Enter Your Data') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('guest.register') }}" id="guestSignUpForm">
                    @csrf
                    <div class="form-group">
                        <label class="s-login-modal-label" for="first_name">{{ __('First Name') }}:</label>
                        <input type="text" placeholder="{{ __('First Name') }}"
                            class="form-control s-login-modal-input" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label class="s-login-modal-label" for="last_name">{{ __('Last Name') }}:</label>
                        <input type="text" placeholder="{{ __('Last Name') }}"
                            class="form-control s-login-modal-input" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label class="s-login-modal-label">{{ __('Email Address') }}:</label>
                        <input type="email" placeholder="your@email.com" class="form-control s-login-modal-input"
                            name="guest_email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" type="submit" form="guestSignUpForm" style="color:black"
                    onclick="document.getElementById('guestSignUpForm').submit()">{{ __('Save') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" type="reset"
                    style="color:black">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
