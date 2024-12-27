<div class="modal" id="applyLeave" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leave Application
                </h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Type of Leave</label>
                                <select wire:model="type_of_leave" class="form-control">
                                    <option value="" selected>--Select Type of Leave--</option>
                                    @foreach($leaveTypes as $leave)
                                        <option value="{{ $leave->id }}">{{ $leave->title }}</option>
                                    @endforeach
                                </select>
                                @error('type_of_leave')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12" wire:key="sick-leave-input-{{ $isSickLeave ? 'true' : 'false' }}">
                            @if($isSickLeave)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Department</label>
                                        <select wire:model="selectedDepartment" class="form-control">
                                            <option value="" selected>--Select Department--</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedDepartment')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Leave For</label>
                                        <select wire:model="leave_for_staff" class="form-control">
                                            <option value="" selected>--Select Staff--</option>
                                            @foreach($departmentStaff as $staff)
                                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('leave_for_staff')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Unit</label>
                                        <select wire:model.defer="unit_id" class="form-control">
                                            <option value="" selected>--Select Unit--</option>
                                            @foreach($departmentUnits as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""  class="form-label">Supporting Document</label>
                                        <input type="file" wire:model="supportingDocument" class="form-control" required>
                                        @error('supportingDocument')
                                        <small class="invalid-password" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""  class="form-label">Start Date</label>
                                <input type="date" wire:model.defer="start_date" class="form-control" placeholder="Start Date" required>
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
                                <input type="date" wire:model.defer="end_date" class="form-control" placeholder="Date" required>
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
                                <textarea wire:model.defer="reason" class="form-control" role="5"></textarea>
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
                                <select wire:model.defer="relieving_staff" id="" class="form-control">
                                    <option value="" selected>--Select Staff--</option>
                                    @foreach($staffs as $staff )
                                        <option value="{{ $staff->id}}">{{ $staff->name}}</option>
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
                    <input type="button" id="closeLeaveModalButton" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                    <input type="button" wire:click="applyForLeave" value="{{__('Apply')}}" class="btn  btn-primary">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeLeaveModalButton").click();
    })
</script>

<script>
    window.addEventListener('error', event => {
        alert(event.detail.error);
    });
</script>

