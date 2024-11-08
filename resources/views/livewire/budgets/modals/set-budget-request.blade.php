<div id="submitRequest">
    <div class="modal" id="newBudgetModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Set Budget Request
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('bduget', __('Budget Category'), ['class' => 'form-label']) }}
                                        <select wire:model="selectedCategory" class="form-control">
                                            <option value="" selected>Choose Budget Category</option>
                                            @foreach ($budgetCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedCategory')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                @foreach ($items as $index => $item)
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <input type="text" wire:model="items.{{ $index }}.description"  class="form-control" placeholder="Item Description" required>
                                            @error("items.{$index}.description")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" wire:model="items.{{ $index }}.quantity" wire:change="calculateTotal" min="1" class="form-control" placeholder="Qty" required>
                                            @error("items.{$index}.quantity")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" wire:model="items.{{ $index }}.unit_price" wire:change="calculateTotal" min="0.1" class="form-control" placeholder="Unit Price" required>
                                            @error("items.{$index}.unit_price")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                        {{-- <div class="col-md-2">
                                            <input type="number" wire:model="items.{{ $index }}.amount" wire:change="calculateTotal" class="form-control" placeholder="Amount" required>
                                            @error("items.{$index}.amount")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div> --}}
                                        <div class="col-md-1">
                                            @if ($index > 0)
                                                <a href="#" wire:click="removeItem({{ $index }})"
                                                    data-bs-toggle="tooltip" title="{{ __('Remove Field') }}"
                                                    class="btn btn-sm btn-danger mt-1">
                                                    X
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <a href="#" wire:click="addItem" data-bs-toggle="tooltip"
                                title="{{ __('Add Field') }}" class="btn btn-sm btn-primary mt-3">
                                <i class="ti ti-plus">Add</i>
                                </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="m-0">{{ __('BUDGET TOTAL') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-end">
                                            <h4 class="m-0">{{ number_format($totalRequested) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="submitRequest"><x-g-loader /></div>
                        <input type="button" id="closeBudgetRequest" value="{{ __('Cancel') }}"
                            class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="button" wire:click="submitRequest" value="{{ __('Submit Budget') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeBudgetRequest").click();
    })
</script>

{{-- @push('script')
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeBudgetRequest").click();
        })
    </script>
@endpush
<x-toast-notification /> --}}
