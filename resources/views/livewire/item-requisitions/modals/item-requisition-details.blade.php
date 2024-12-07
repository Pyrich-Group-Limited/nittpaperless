<div id="viewBudget">
    <div class="modal" id="viewItemRequisitionDetails" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title">ITEM REQUISITION DETAILS </h5>
                    </div>
                    <div class="modal-body">
                        @if ($selRequisitionItem)
                            <div class="row">
                                @if(count($selRequisitionItem->items)>0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__('SN')}}</th>
                                                <th>{{__('Item Name')}}</th>
                                                <th>{{__('Item Description')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($selRequisitionItem->items as $item)
                                                    <tr>
                                                        <td> <p>{{ $loop->iteration }}</p> </td>
                                                        <td> <p>{{ $item->item_name }}</p> </td>
                                                        <td> <p>{{ $item->description }}</p> </td>
                                                        <td> <p>{{ $item->quantity_requested }}</p> </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-5">
                                        <h6 class="h6 text-center">{{__('No record found!')}}</h6>
                                    </div>
                                @endif
                            </div>
                                @if ($selRequisitionItem->status=='rejected')
                                    <div class="form-group">
                                        <label class="form-label" for="exampleFormControlTextarea1">{{__('Comment')}}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $selRequisitionItem->comment }}</textarea>
                                    </div>
                                @endif
                            <div class="modal-footer">
                                <input type="button" id="closeItemRequisitionDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light btn-sm" data-bs-dismiss="modal">
                                @if(auth()->user()->type=="accountant" && $selRequisitionItem->status == 'pending')
                                    <input type="button" wire:click="markPendingDgApproval({{ $selRequisitionItem->id }})" value="{{ __('Forward to DG') }}" class="btn  btn-primary btn-sm">
                                @endif
                                @can('approve budget')
                                    @if(auth()->user()->type=="DG")
                                        <input type="button"  wire:click="approveBudget('{{ $selRequisitionItem->id }}')" value="{{ __('Approve') }}" class="btn  btn-primary btn-sm @if ($selRequisitionItem->status == 'approved') disabled @endif ">
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
            document.getElementById("closeItemRequisitionDetails").click();
        })
    </script>
    <x-toast-notification />
