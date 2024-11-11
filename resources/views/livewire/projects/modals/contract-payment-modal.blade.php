<div id="createUser">
    <div class="modal" id="newProject" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Payment for Contract #{{ $contract->id }} </h5>
                    </div>
                    <div class="modal-body">
                        {{-- <form wire:submit.prevent="makePayment"> --}}
                            <div>
                                <label for="percentage">Percentage</label>
                                <input type="number" class="form-control" wire:model="percentage" wire:change="calculateAmountFromPercentage" min="0" max="100" step="0.01">
                            </div>
                    
                            <div>
                                <label for="amount">Amount</label>
                                <input type="number" wire:model="amount" min="0" max="{{ $contract->total_contract_sum - $contract->amount_paid_to_date }}" step="0.01" class="form-control">
                            </div>
                    
                            <div>
                                <label for="remarks">Remarks</label>
                                <textarea wire:model="remarks" class="form-control"></textarea>
                            </div>

                            <div class="modal-footer">
                                <input type="button" id="closeCOntractPayment" value="{{ __('Cancel') }}" class="btn  btn-light"
                                    data-bs-dismiss="modal">
                                <input type="button"  wire:click="makePayment" value="{{ __('Make Payment') }}" class="btn  btn-primary">
                            </div>
                        {{-- </form> --}}
                        
                    </div>

                    
                </div>
            </div>
        </div>
        
    </div>
    
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeCOntractPayment").click();
        })
    </script>
</div>
<x-toast-notification />
