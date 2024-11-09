<div id="viewBudget">
    <div class="modal" id="viewBudgetModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title">BUDGET DETAILS FOR :  
                            @if ($budget != null)
                                {{ strtoupper($budget->department->name)}}
                            @endif
                        </h5>
                    </div>
                    <div class="modal-body">
                        {{-- @if ($showDetails == $budget->id) --}}
                        @if ($selBudget)
                            <div class="row">
                                @if(count($selBudget->items)>0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__('SN')}}</th>
                                                <th>{{__('Item Description')}}</th>
                                                <th>{{__('Price')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($selBudget->items as $item)
                                                    <tr>
                                                        <td> <p>{{ $loop->iteration }}</p> </td>
                                                        <td> <p>{{ $item->description }}</p> </td>
                                                        <td> <p>{{ number_format($item->amount,2) }}</p> </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td><h4>TOTAL</h4></td>
                                                    <td> <h4>₦ {{ number_format($selBudget->total_requested,2) }}</h4> </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-5">
                                        <h6 class="h6 text-center">{{__('No record found!')}}</h6>
                                    </div>
                                @endif
                            </div>
                                @if ($selBudget->status=='rejected')
                                    <div class="form-group">
                                        <label class="form-label" for="exampleFormControlTextarea1">{{__('Rejection Comment')}}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $selBudget->comment }}</textarea>
                                    </div>
                                @endif
                            <div class="modal-footer">
                                <input type="button" id="closeBudgetDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light btn-sm" data-bs-dismiss="modal">
                                @if(auth()->user()->type=="accountant" && $selBudget->status == 'pending')
                                    <input type="button" wire:click="markPendingDgApproval({{ $budget->id }})" value="{{ __('Forward to DG') }}" class="btn  btn-primary btn-sm">
                                @endif
                                @can('approve budget')
                                    @if(auth()->user()->type=="DG")
                                        <input type="button"  wire:click="approveBudget('{{ $selBudget->id }}')" value="{{ __('Approve') }}" class="btn  btn-primary btn-sm @if ($selBudget->status == 'approved') disabled @endif ">
                                    @endif
                                @endcan
                            </div>
                        @else
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeBudgetDetails").click();
        })
    </script>
    <x-toast-notification />
