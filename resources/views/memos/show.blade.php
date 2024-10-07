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
                            {{-- <tr>
                                <th scope="row">Signature</th>
                                <td>
                                    @if ($signatures)
                                        <img src="{{ asset('storage/' . $signatures->signature_path) }}" alt="Signature" height="100">
                                    @else
                                        <p>You have not uploaded a signature yet.</p>
                                    @endif
                                </td>
                            </tr> --}}

                            <tr>
                                <th scope="row"></th>
                                <td>
                                    @if ($isSigned)
                                        <div class="alert alert-success">
                                            <strong>You have signed this memo.</strong>
                                        </div>
                                        <img src="{{ asset('storage/' .$signatures->signature_path) }}" alt="Your Signature" height="50">
                                    @else
                                        @if ($signatures)
                                            <form action="{{ route('memos.sign', $memo->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Sign Memo</button>
                                            </form>
                                        @else
                                            <div class="alert alert-danger">
                                                <strong>You need to upload a signature before signing the memo.</strong>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>



        </div>

        </div>

        <div class="modal-footer">
            <a href="{{ route('memos.download',$memo->id) }}" class="btn btn-primary btn-sm" download><i class="ti ti-download text-white"></i> Download Memo</a>
            <input type="button" value="{{('Close')}}" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
        </div>
    </div>
