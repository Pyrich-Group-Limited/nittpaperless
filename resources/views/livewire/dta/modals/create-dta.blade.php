<div class="modal" id="newDtaRequest" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DTA Application Module</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Destination</label>
                                <input type="text" wire:model="destination" class="form-control" required>
                                @error('destination')
                                <small class="invalid-destination" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="" class="form-label">Purpose</label>
                            <textarea wire:model="purpose" id="" cols="30" rows="3" class="form-control" required></textarea>
                            @error('purpose')
                            <small class="invalid-purpose" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-12" wire:ignore>
                            <div class="form-group" >
                                <label for="">Apply for Others (Optional) (<span class="text-xs text-muted">{{ __('You can select one or more users to apply DTA with')}}</span>) </label>
                                <select wire:model="selected_users" id="choices-multiple1" class="form-control sel_users select2" multiple>
                                    @if (is_array($allUsers) || is_object($allUsers))
                                        @foreach ($allUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} &nbsp; ({{ $user->type }})</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('selected_users.*') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Travel Date</label>
                                <input type="date" wire:model="travel_date" class="form-control" required>
                                @error('travel_date')
                                <small class="invalid-travel_date" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Arrival Date</label>
                                <input type="date" wire:model="arrival_date" class="form-control" required>
                                @error('arrival_date')
                                <small class="invalid-arrival_date" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Extimated Expenses (₦)</label>
                                <input type="number" wire:model="expense" class="form-control" required>
                                @error('expense')
                                <small class="invalid-expense" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document">Supporting Document</label>
                                <input type="file" wire:model.defer="document" class="form-control" />
                                <span class="text-danger" wire:loading wire:target="document">Loading...</span>
                                @error('document')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="applyForDta"><x-g-loader /></div>
                    <input type="button" id="closeNewDtaModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                    <input type="button" wire:click="applyForDta" value="{{__('Apply')}}" class="btn  btn-primary">
                </div>
            </div>
        </div>
    </div>
</div>
    @push('script')
        <script>
            $(document).ready(function(){
                $('.sel_users').select2();
            }).on('change', function(){
                var data = $('.sel_users').val();
                @this.set('selected_users',data);
            });

            window.addEventListener('print',event => {
                document.getElementById("print").click();
            });
        </script>
    @endpush

<script>
    window.addEventListener('success', event => {
        document.getElementById("closeNewDtaModal").click();
    })
</script>
