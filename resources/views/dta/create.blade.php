{{-- {{Form::open(array('url'=>'users','method'=>'post'))}} --}}
<form action="{{ route('dta.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="" class="form-label">Destination</label>
                    <input type="text" name="destination" class="form-control" required>
                    @error('destination')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="" class="form-label">Purpose</label>
                <textarea name="purpose" id="" cols="30" rows="3" class="form-control" required></textarea>
                @error('purpose')
                <small class="invalid-role" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-label">Travel Date</label>
                    <input type="date" name="travel_date" class="form-control" required>
                    @error('travel_date')
                    <small class="invalid-password" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-label">Arrival Date</label>
                    <input type="date" name="arrival_date" class="form-control" required>
                    @error('arrival_date')
                    <small class="invalid-password" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="" class="form-label">Extimated Expenses (₦)</label>
                    <input type="number" name="expense" class="form-control" required>
                    @error('expense')
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
        <input type="submit" value="{{__('Apply')}}" class="btn  btn-primary">
    </div>
</form>
{{-- {{Form::close()}} --}}
