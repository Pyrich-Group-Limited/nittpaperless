<div class="">
    <form action="{{ route('files.rename',$file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card text-center card-2">
                        <div class="card-body full-card">
                            <div class="img-fluid rounded-circle card-avatar">
                                <span class="nk-file-icon-type">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                        <g>
                                            <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />
                                            <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />
                                            <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                            <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                            <rect x="27" y="36" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                            <rect x="27" y="41" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                            <rect x="27" y="46" width="12" height="2" rx="1" ry="1" style="fill:#599def" />
                                        </g>
                                    </svg>
                                </span>
                                <h6 class=" mt-4 text-primary">{{ $file->file_name }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" value="{{ $file->file_name }}" name="filename" class="form-control" required>
                </div>
                {{-- <div class="form-group">
                    <label for="">File Content</label>
                    <input type="file" name="file" aria-multiselectable="" class="form-control">
                </div> --}}
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Rename File')}}" class="btn  btn-primary">
        </div>
    </form>
</div>




