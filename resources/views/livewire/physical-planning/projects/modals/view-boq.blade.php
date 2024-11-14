<div id="viewBOQ">
    <div class="modal" id="viewBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">BILL OF QUANTITY FOR  {{ strtoupper($project->project_name)}}
                        </h5>
                    </div>
                    <div class="modal-body">
                        @if ($project)
                            <div class="row">
                                @if(count($project->boqs)>0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{__('SN')}}</th>
                                            <th>{{__('Item')}}</th>
                                            <th>{{__('Unit Price')}}</th>
                                            <th>{{__('QTY')}}</th>
                                            <th>{{__('Total')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($project->boqs as $key => $boq)
                                            @php
                                                $totalSum = $totalSum + ($boq->quantity * $boq->unit_price);
                                            @endphp
                                                <tr>
                                                    <td> <p>{{ $key+1 }}</p> </td>
                                                    <td> <p>{{ $boq->description }}</p> </td>
                                                    <td> <p>{{ number_format($boq->unit_price) }}</p> </td>
                                                    <td> <p>{{ $boq->quantity }}</p> </td>
                                                    <td> <p>{{ number_format($boq->quantity * $boq->unit_price) }}</p> </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td> </td>
                                                <td> </td>
                                                <td></td>
                                                <td><b>SUB TOTAL</b></td>
                                                <td> <b>{{ number_format($totalSum,2) }}</b> </td>
                                            </tr>
    
                                            <tr>
                                                <td> </td>
                                                <td> </td>
                                                <td></td>
                                                <td><b>VAT</b></td>
                                                <td> <b>{{ number_format(($project->vat)) }}</b> </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Profit Margin </b></td>
                                                <td> <b>{{number_format($project->profit_margin,2) }}</b> </td>
                                            </tr>
    
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Consultation fee </b></td>
                                                <td> <b>{{number_format($project->consultation_fee,2) }}</b> </td>
                                            </tr>
            
                                            <tr>
                                                <td> </td>
                                                <td> </td>
                                                <td></td>
                                                <td class="text-primary"><b>SUM TOTAL</b></td>
                                                <td class="text-primary"> <b>{{ number_format($project->budget,2) }}</b> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <div class="py-5">
                                        <h6 class="h6 text-center">{{__('No Bill of Quantity Uploaded yet!')}}</h6>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <input type="button" id="closeAdvertPublishModal" value="{{ __('Close') }}"
                                    class="btn  btn-light" data-bs-dismiss="modal">
                            </div>
                        @else
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @push('script')
            @if ($errors->any() || Session::has('error'))
                <script>
                    $(document).ready(function() {
                        document.getElementById("toggleOldUser").click();
                    });
                </script>
            @endif
        @endpush

    </div>
    @push('script')
        <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: '#description',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('description', editor.getContent());
                    });
                }
            });


            window.addEventListener('feedback', event => {
                tinyMCE.activeEditor.setContent("");
            });
        </script>
    @endpush
    <x-toast-notification />
