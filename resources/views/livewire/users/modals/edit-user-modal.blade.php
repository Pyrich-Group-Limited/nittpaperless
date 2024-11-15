<div id="updateUser">
    <div class="modal" id="editUser" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Modify User
                        </h5>
                    </div>
                    <div class="modal-body">
                    @if($selUser)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', __('Firstname'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="firstname" class="form-control"
                                        placeholder="Firstname" />
                                    @error('firstname')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('Othernames', __('Othernames'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="surname" class="form-control"
                                        placeholder="Othernames" />
                                    @error('surname')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                    <input type="email" wire:model.defer="email" class="form-control"
                                        placeholder="email" />
                                    @error('email')
                                        <small class="invalid-email" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('ippis', __('IPPIS Number'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="ippis" class="form-control"
                                        placeholder="IPPIS Number" />
                                    @error('ippis')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ulocation" class="form-label">Location</label>
                                <select wire:model="location" id="ulocation" class="form-control">
                                    <option value="" selected>-- Select Location --</option>
                                    <option value="Headquarters">Headquarters</option>
                                    <option value="Liaison Office">Liaison Office</option>
                                </select>
                                @error('location')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            @if ($location)
                                <div class="form-group col-md-6">
                                    <label for="ulocation_type" class="form-label">{{ $location }}</label>
                                    <select wire:model="location_type" id="ulocation_type" class="form-control">
                                        <option value="" selected>-- Select Location --</option>
                                        @if ($location == 'Headquarters')
                                            <option value="Department">Department</option>
                                            <option value="Directorate">Directorate</option>
                                        @else
                                            @foreach ($liasons as $liason)
                                                <option value="{{ $liason->id }}">{{ $liason->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('location')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            @endif


                            @if ($location_type)
                                <div class="form-group col-md-6">
                                    <label for="udepartment"
                                        class="form-label">{{ $location == 'Headquarters' ? $location_type : 'Department' }}</label>
                                    <select wire:model="department" id="udepartment" class="form-control">
                                        <option value="" selected>-- Select
                                            {{ $location == 'Headquarters' ? $location_type : 'Department' }} --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            @endif

                            @if ($department && ($location_type == 'Department' || $location == 'Liaison-Offices') && $location_type)
                                <div class="form-group col-md-6">
                                    <label for="uunit" class="form-label">Unit</label>
                                    <select wire:model="unit" id="uunit" class="form-control">
                                        <option value="" selected>-- Select Unit --</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            @endif

                            @if ($unit && count($subunits) > 0)
                                <div class="form-group col-md-6">
                                    <label for="usubunit" class="form-label">SubUnit</label>
                                    <select wire:model.defer="subunit" id="usubunit" class="form-control">
                                        <option value="" selected>-- Select Sub Unit --</option>
                                        @foreach ($subunits as $subunit)
                                            <option value="{{ $subunit->id }}">{{ $subunit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subunit')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group col-md-6">
                                <label for="udesignation" class="form-label">Designation</label>
                                <select wire:model.defer="designation" id="udesignation" class="form-control">
                                    <option value="" selected>-- Select Designation --</option>
                                    @foreach($designations as $designation )
                                        <option value="{{ $designation->id}}" >{{ $designation->name}}</option>
                                    @endforeach
                                </select>
                                @error('designation')
                                <small class="invalid-designation" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ulevel" class="form-label">Level</label>
                                <select wire:model.defer="level" id="ulevel" class="form-control">
                                    <option value="" selected>-- Select Level --</option>
                                    <option value="Level 07">Level 07</option>
                                    <option value="Level 08">Level 08</option>
                                    <option value="Level 09">Level 09</option>
                                    <option value="Level 11">Level 11</option>
                                    <option value="Level 12">Level 12</option>
                                    <option value="Level 13">Level 13</option>
                                    <option value="Level 14">Level 14</option>
                                    <option value="Level 15">Level 15</option>
                                </select>
                                @error('level')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="uuser_role" class="form-label">Role</label>
                                <select wire:model="user_role" id=u"user_role" class="form-control">
                                    <option  selected>-- Select User Role --</option>
                                    @foreach($roles as $role )
                                        <option value="{{ $role}}" >{{ ucwords($role)}}</option>
                                    @endforeach
                                </select>
                                @error('user_role')
                                <small class="invalid-user_role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="button" value="{{ __('Cancel') }}" id="closeEditModal" class="btn  btn-light" data-bs-dismiss="modal">
                            <input type="button" wire:click="updateUser"  value="{{ __('Update') }}" class="btn  btn-primary">
                        </div>
                    @else
                    <lable align="center">Loading...</lable>
                    @endif

                    </div>


                </div>
            </div>
        </div>
    </div>

    @push('script')
        @if ($errors->any() || Session::has('error'))
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldUser").click();
                });
            </script>
        @endif

        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeEditModal").click();
            })
        </script>
    @endpush

</div>
