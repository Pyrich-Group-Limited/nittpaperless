<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Item</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Description</label>
                <textarea name="" class="form-control" id="" cols="10" rows="5" readonly></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Stock Balance</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Max Stock Level</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Required Qty</label>
                <input type="number" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Last Supply Date</label>
                <input type="date" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Last Requisition Date</label>
                <input type="date" class="form-control" readonly>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="form-label">Comment</label>
                <textarea name="" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Approve')}}" class="btn  btn-primary btn-sm">
    <input type="submit" value="{{__('Reject')}}" class="btn  btn-danger btn-sm">
    <input type="submit" value="{{__('Revert')}}" class="btn  btn-secondary btn-sm">
</div>
