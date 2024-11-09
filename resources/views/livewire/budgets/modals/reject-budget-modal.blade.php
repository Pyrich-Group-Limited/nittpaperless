<div id="viewBudget">
    <div class="modal" id="rejectModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title">REJECT BUDGET </h5>
                    </div>
                    <div class="modal-body">
                        <label for="comment">Comment</label>
                        <textarea id="comment" wire:model="comment" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="closeRejectBudget" value="{{ __('Close') }}"
                            class="btn  btn-light btn-sm" data-bs-dismiss="modal">
                        @can('approve budget')
                            <input type="button"  wire:click="rejectBudget({{ $selectedBudgetId }})" value="{{ __('Reject') }}" class="btn  btn-primary btn-sm">
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeRejectBudget").click();
        })
    </script>
    <x-toast-notification />
