<div id="uploadBOQ">
    <div class="modal" id="uploadBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Supply Module
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if ($project)
                                @foreach ($inputs as $key => $input)
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select wire:ignore name="input_{{ $key }}_item" id="input_{{ $key }}_item" wire:model="inputs.{{ $key }}.item" placeholder="Quantity" class="form-control">
                                                    <option value="" selected>-- Select Item -- </option>
                                                    @foreach (App\Models\PPProjectBOQ::where('project_id',$project->id)->WhereNotIn('id',$items)->get() as $item)
                                                        <option value="{{ $item->id }}">{{ $item->item }}</option>
                                                    @endforeach
                                                </select>
                                                @error("input_{{ $key }}_item")
                                                    <small class="invalid-name" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text"
                                                @error('inputs.' . $key . '.quantity') style="border-color: red" @enderror
                                                id="input_{{ $key }}_quantity" id="input_{{ $key }}_quantity" placeholder="Quantity"
                                                wire:model="inputs.{{ $key }}.quantity"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            @if ($key > 0)
                                                <a href="#" wire:click="removeInput({{ $key }})"
                                                    data-bs-toggle="tooltip" title="{{ __('Add Field') }}"
                                                    class="btn btn-sm btn-danger mt-1">
                                                    X
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <a href="#" wire:click="addInput" data-bs-toggle="tooltip"
                                    title="{{ __('Add Field') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="ti ti-plus"></i>
                                </a>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" wire:model="supplier" id="supplier"
                                                 class="form-control" placeholder="Items Delivered by" />
                                            @error('supplier')
                                                <small class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" wire:model="comment" id="comment"
                                                 class="form-control" placeholder="Comment" />
                                            @error('comment')
                                                <small class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @else
                                <label align="center" class="mb-4" style="color: red">Loading...</label>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="addGoodsRecived"><x-g-loader /></div>
                        <input type="button" id="closeSupplierModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="addGoodsRecived" value="{{ __('Add Goods Reieved') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeSupplierModal").click();
        })
    </script>
@endpush
<x-toast-notification />
