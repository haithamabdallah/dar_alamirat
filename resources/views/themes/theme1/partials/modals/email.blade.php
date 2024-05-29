<!-- Email Modal -->
<div class="modal fade" id="loginEmail" tabindex="-1" aria-labelledby="loginEmailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="login-icon">
                    <i class="icon sicon-user"></i>
                </div>
                <h3>Login</h3>
                <form id="emailForm">
                    @csrf
                    <label class="s-login-modal-label">Email Address</label>
                    <input type="email" placeholder="your@email.com" class="s-login-modal-input" name="email" required>
                    <button class="s-login-modal-enter-button" type="submit">
                        <span class="s-button-text">Enter</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
