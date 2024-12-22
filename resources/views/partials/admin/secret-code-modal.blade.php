<!-- Secret Code Modal -->
<div class="modal fade" id="setSecretCodeModal" tabindex="-1" aria-labelledby="setSecretCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setSecretCodeModalLabel">
                    @if (Auth::user()->secret_code)
                        Update Secret Code
                    @else
                        Set Your Secret Code
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.update.secret_code') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Old Secret Code (Optional based on backend logic) -->
                    @if (Auth::user()->secret_code)
                        <div class="mb-3">
                            <label for="old_secret_code" class="form-label">Old Secret Code</label>
                            <input type="password" name="old_secret_code" id="old_secret_code" class="form-control" placeholder="Enter old secret code" required>
                        </div>
                    @endif

                    <!-- New Secret Code -->
                    <div class="mb-3">
                        <label for="secret_code" class="form-label">New Secret Code</label>
                        <input type="password" name="secret_code" id="secret_code" class="form-control" placeholder="Enter new secret code" required>
                    </div>

                    <!-- Confirm New Secret Code -->
                    <div class="mb-3">
                        <label for="secret_code_confirmation" class="form-label">Confirm New Secret Code</label>
                        <input type="password" name="secret_code_confirmation" id="secret_code_confirmation" class="form-control" placeholder="Confirm new secret code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Secret Code</button>
                </div>
            </form>
        </div>
    </div>
</div>
