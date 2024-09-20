<div class="modal-body">
    <div class="row">
        <h3>New Goods Received Note</h3>
        <hr>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Supplier Address</label>
                <input type="text" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Invoice Number</label>
                <input type="text" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Invoice Date</label>
                <input type="date" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>



        <div class="form-group col-md-6">
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">LPO Number</label>
                <input type="text" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Requisition Note No.</label>
                <input type="text" class="form-control" required>
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Add')}}" class="btn  btn-primary">
</div>
