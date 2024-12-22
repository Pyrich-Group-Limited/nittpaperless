<div id="viewBOQ">
    <div class="modal" id="viewRequisition" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">REQUISITION ITEMS
                        </h5>
                    </div>
                    <div class="modal-body">
                        @if ($selRequest)
                            <div class="row">
                                @if(count($selRequest->items)>0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{__('SN')}}</th>
                                            <th>{{__('Item')}}</th>
                                            <th>{{__('QTY REQUESTED')}}</th>
                                            <th>{{__('QTY LEFT')}}</th>
                                            <th>{{__('STATUS')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($selRequest->items as $key => $item)
                                                <tr>
                                                    <td> <p>{{ $key+1 }}</p> </td>
                                                    <td> <p>{{ $item->item_name }}</p> </td>
                                                    <td> <p>{{ $item->quantity_requested }}</p> </td>
                                                    <td> <p>{{ $item->quantity_available }}</p> </td>
                                                    <td> <p>{{ $item->status }}</p> </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <div class="py-5">
                                        <h6 class="h6 text-center">{{__('No items for the selected requisision')}}</h6>
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
