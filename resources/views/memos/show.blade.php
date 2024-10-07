<div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <tbody>
                            <style>
                                th{
                                    width: 200px !important;
                                }
                            </style>
                            <tr>
                                <th scope="row">Memo Title</th>
                                <td>{{ $memo->title }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Memo Description</th>
                                <td style="white-space: pre-wrap">{{ $memo->description }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Created  By:</th>
                                <td>{{ $memo->creator->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date created</th>
                                <td>{{ $memo->created_at->format('d-M-Y')  }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Signature</th>
                                {{-- <td><img src="{{ asset($signatures->signature_path) }}" alt="Signature" height="50"></td> --}}
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        </div>

        <div class="modal-footer">
            <a href="{{ asset('storage/' . $memo->file_path) }}" class="btn btn-primary" download>Download Memo</a>
            <input type="button" value="{{('Close')}}" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
        </div>
    </div>
