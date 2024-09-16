<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">SUbject Submitted By:</label>
                <input type="text" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>

        <div class="form-group col-md-12">
            <label for="" class="form-label">Department</label>
            <select name="" id="" class="form-control">
                <option value="">--Select--</option>
                <option value="">Admin</option>
                <option value="">Procurement</option>
                <option value="">Finance</option>
            </select>
            @error('role')
            <small class="invalid-role" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Date</label>
                <input type="date" class="form-control" placeholder="Date" required>
                @error('password')
                <small class="invalid-password" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Apply')}}" class="btn  btn-primary">
</div>
