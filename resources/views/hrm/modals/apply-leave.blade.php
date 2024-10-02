{{Form::open(array('route'=>'leave.apply','method'=>'post'))}}
@csrf
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Employee Name</label>
                <input type="text" class="form-control" value="{{ old('name')}}" placeholder="Employee Name" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Employee Department</label>
                <select name="department" value="{{ old('department')}}" id="" class="form-control">
                    <option value="">--Select Department--</option>
                    <option value="">Finance</option>
                    <option value="">Administrative</option>
                </select>
                @error('department')
                <small class="invalid-department" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        @if(\Auth::user()->type == 'client')
            <div class="form-group col-md-6">
                <label for="" class="form-label">Type of Leave</label>
                <select name="type_of_leave" value="{{ old('type_of_leave')}}" id="" class="form-control">
                    <option value="">--Select--</option>
                    <option value="">Casual</option>
                    <option value="">Annual</option>
                    <option value="">Maternal</option>
                </select>
                @error('type_of_leave')
                <small class="invalid-role" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        @endif
        <div class="col-md-6">
            <div class="form-group">
                <label for=""  class="form-label">Leave Date</label>
                <input type="leave_date" value="{{ old('leave_date')}}" class="form-control" placeholder="Date" required>
                @error('leave_date')
                <small class="invalid-password" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="" class="form-label">Number of Days</label>
            <input type="number" name="duration" value="{{ old('duration')}}" class="form-control" placeholder="Days" required>
            @error('duration')
            <small class="invalid-role" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="" class="form-label">Resumption Date</label>
            <input type="date" value="{{ old('resurmption_date')}}" class="form-control" required>
            @error('resumption_date')
            <small class="invalid-role" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Apply')}}" class="btn  btn-primary">
</div>

{{Form::close()}}
