<div id="createUser">
    <div class="modal" id="newBudgetCategory" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Create Budget Module</h5>
                    </div>
                    <div class="modal-body">

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('value', __('Budget Category'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                <input type="text" wire:model="name" class="form-control">
                                @error('name')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('account', __('Chart of Account'), ['class' => 'form-label']) }} <span
                                class="text-danger">*</span>
                                <select id="account" class="form-control" wire:model="account">
                                    <option value="" >Select Chart of Account</option>
                                    @foreach ($chartofAccounts as $chartofAccount)
                                        <option value="{{ $chartofAccount->id }}">{{ $chartofAccount->name }} - ({{ $chartofAccount->code }})</option>
                                    @endforeach
                                </select>
                                @error('account')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('total_amount', __('Total Amount'), ['class' => 'form-label']) }} (₦) <span
                                class="text-danger">*</span>
                                <input type="number" class="form-control" wire:model="total_amount">
                                @error('total_amount')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('year', __('Year'), ['class' => 'form-label']) }} <span
                                class="text-danger">*</span>
                                <select id="year" class="form-control" wire:model="year">
                                    <option value="" disabled selected>Select Year</option>
                                </select>
                                @error('year')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="createBudgetCategory"><x-g-loader /></div>
                        <input type="button" id="closeBudgetCategoryModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="createBudgetCategory" value="{{ __('Save') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const select = document.getElementById("year");
        const currentYear = new Date().getFullYear();
        const startYear = 1900;
        const endYear = 2100;
    
        for (let year = startYear; year <= endYear; year++) {
        let option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        select.appendChild(option);
        }
    </script>
@endpush
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeBudgetCategoryModal").click();
    })
</script>
