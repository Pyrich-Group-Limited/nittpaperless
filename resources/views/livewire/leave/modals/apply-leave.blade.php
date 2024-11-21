<div class="modal" id="applyLeave" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyLeave">Leave Application
                </h5>
            </div>
            <div class="modal-body">
                {{-- {{Form::open(array('route'=>'leave.apply','method'=>'post'))}} --}}
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Type of Leave</label>
                                <select wire:model="type_of_leave" id="" class="form-control">
                                    <option value="" selected>--Select Type of Leave--</option>
                                    @foreach($leaveTypes as $leave )
                                        <option value="{{ $leave->id}}" {{ old('type_of_leave') == $leave->id ? 'selected' : '' }}>{{ $leave->title}}</option>
                                    @endforeach
                                </select>
                                @error('type_of_leave')
                                <small class="invalid-type_of_leave" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""  class="form-label">Start Date</label>
                                <input type="date" wire:model="start_date" value="{{ old('start_date')}}" class="form-control" placeholder="Date" required>
                                @error('start_date')
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""  class="form-label">End Date</label>
                                <input type="date" wire:model="end_date" value="{{ old('end_date')}}" class="form-control" placeholder="Date" required>
                                @error('end_date')
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for=""  class="form-label">Reason for Leave</label>
                                <textarea wire:model="reason" class="form-control" role="5">{{ old('reason') }}</textarea>
                                @error('reason')
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Relieving Staff</label>
                                <select wire:model="relieving_staff" id="" class="form-control">
                                    <option value="" selected>--Select Staff--</option>
                                    @foreach($staffs as $staff )
                                        <option value="{{ $staff->id}}" {{ old('relieving_staff') == $staff->id ? 'selected' : '' }}>{{ $staff->name}}</option>
                                    @endforeach
                                </select>
                                @error('relieving_staff')
                                <small class="invalid-relieving_staff" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <div wire:loading wire:target="applyForLeave"><x-g-loader /></div>
                    <input type="button" id="closeNewLeaveModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                    <input type="submit" wire:click="applyForLeave" value="{{__('Apply')}}" class="btn  btn-primary">
                </div>

                {{-- {{Form::close()}} --}}
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeNewLeaveModal").click();
    })
</script>
