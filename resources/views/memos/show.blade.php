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
                                <th scope="row">Priority</th>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            @if($memo->priority == 0)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                            @elseif($memo->priority == 1)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                            @elseif($memo->priority == 2)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                            @elseif($memo->priority == 3)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Created  By:</th>
                                <td>{{ $memo->creator->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date created</th>
                                <td>{{ $memo->created_at->format('d-M-Y')  }}</td>
                            </tr>
                            @if ($memoShareComment)
                                <tr>
                                    <th scope="row">Share Comment</th>
                                    <td style="white-space: pre-wrap">{{ $memoShareComment->comment }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th scope="row">Your Signature</th>
                                <td>
                                    @if ($isSigned)
                                        <div class="alert alert-success">
                                            <strong>You have signed this memo.</strong>
                                        </div>
                                        <img src="{{ asset('storage/' .$signatures->signature_path) }}" alt="Your Signature" height="70">
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

                            <tr>
                                <th scope="row">All Signatures</th>
                                @if ($memo->signedUsers->isEmpty())
                                    <td><p>No signatures yet.</p></td>
                                @else
                                    <td>
                                        @foreach ($memo->signedUsers as $user)
                                        @if ($user->signature)
                                            <img src="{{ asset('storage/' . $user->signature->signature_path) }}" alt="Signature" height="50">
                                        @else
                                            <p>No signature uploaded.</p>
                                        @endif
                                        @endforeach
                                    </td>
                                @endif
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
