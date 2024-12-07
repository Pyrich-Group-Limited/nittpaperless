<div id="viewBudget">
    <div class="modal" id="viewItemToAcknowledge" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title">STORE ISSUE VOUCHER </h5>
                    </div>
                    <div class="modal-body">
                        @if ($selectedRequisition)
                            <div class="row">
                                @if(count($selectedRequisition->items)>0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__('SN')}}</th>
                                                <th>{{__('Item Name')}}</th>
                                                <th>{{__('Item Description')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                                <th>{{__('Availability')}}</th>
                                                <th>{{__('Acknowledgment')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($selectedRequisition->items as $index => $item)
                                                    <tr>
                                                        <td> <p>{{ $index + 1 }}</p> </td>
                                                        <td> <p>{{ $item->item_name }}</p> </td>
                                                        <td> <p>{{ $item->description }}</p> </td>
                                                        <td> <p>{{ $item->quantity_requested }}</p> </td>
                                                        <td>
                                                            @if($item->status)
                                                                <span class="badge bg-{{ $item->status == 'available' ? 'success' : 'danger' }} p-2 px-3 rounded">
                                                                    {{ ucfirst($item->status) }}
                                                                </span>
                                                            @else
                                                                <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($item->acknowledged)
                                                                <span class="badge bg-success p-2 px-3 rounded">Acknowledged</span>
                                                            @else
                                                                <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!$item->acknowledged)
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#" wire:click="acknowledgeItem({{ $item->id }})" class="mx-3 btn btn-sm d-inline-flex align-items-center" 
                                                                        data-bs-toggle="tooltip" title="{{__('Mark as Acknowledge')}}">
                                                                        <i class="ti ti-check text-white"></i>
                                                                    </a>
                                                                </div>

                                                                {{-- <button wire:click="acknowledgeItem({{ $item->id }})" class="btn btn-success btn-sm">
                                                                    Acknowledge
                                                                </button> --}}
                                                            @else
                                                                <div class="action-btn bg-primary ms-2" disabled>
                                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" 
                                                                        data-bs-toggle="tooltip" title="{{__('Mark as Acknowledge')}}">
                                                                        <i class="ti ti-check text-white"></i>
                                                                    </a>
                                                                </div>
                                                                {{-- <button class="btn btn-secondary btn-sm" disabled>Acknowledged</button> --}}
                                                            @endif
                                                        </td>
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
                            <div class="modal-footer">
                                {{-- <div wire:loading wire:target="finalizeApproval"><x-g-loader /></div> --}}
                                <input type="button" id="closeItemRequisitionApproval" value="{{ __('Close') }}"
                                    class="btn  btn-light" data-bs-dismiss="modal">
                                {{-- <input type="button" wire:click="finalizeApproval" value="{{ __('Finalize Approval') }}" class="btn  btn-primary"> --}}
                            </div>
                        @else
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeItemRequisitionApproval").click();
            })
        </script>
    @endpush
    <x-toast-notification />
