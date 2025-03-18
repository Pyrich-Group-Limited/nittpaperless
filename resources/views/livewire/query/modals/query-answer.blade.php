<div>
    <div class="modal" id="queryAnswerModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Query Answer</h5>

                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        @if($selQueryAnswer)
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
                                                    <th scope="row">Query Subject</th>
                                                    <td>{{ $selQueryAnswer->subject  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Query Answer</th>
                                                    <td>{!! $selQueryAnswer->answers->answer !!}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Date</th>
                                                    <td>{{ $selQueryAnswer->answers->answered_at }}</td>
                                                </tr>

                                                @if($selQueryAnswer->answers->supporting_documents!=null)
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-end">
                                                            <a href="{{ asset('assets/documents/documents') }}/{{$selQueryAnswer->answers->supporting_documents}}" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                                                            <a href="#" wire:click="downloadAnserDocument('{{ $selQueryAnswer->answers->supporting_documents }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div wire:loading wire:target="setActionId"><x-g-loader /></div>

                            <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light"
                                data-bs-dismiss="modal">
{{--
                            @if ($selQueryAnswerAnswer->status === 'Pending' && auth()->user()->can('assign query'))
                                <input type="button" data-bs-dismiss="modal" wire:click="setActionId('{{ $selQueryAnswerAnswer->id }}')" value="{{__('Issue Query')}}" class="btn  btn-primary confirm-approve">
                            @endif --}}
                        </div>
                @else
                    <label align="center" class="mb-4" style="color: red">Loading...</label>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeLeaveModal").click();
    })
</script>

<x-toast-notification />
