<div>
    @section('page-title')
        {{ ucwords($project->project_name) }}
    @endsection
    @push('script-page')
        </script>

        {{-- share project copy link --}}
        <script>
            function copyToClipboard(element) {

                var copyText = element.id;
                navigator.clipboard.writeText(copyText);
                // document.addEventListener('copy', function (e) {
                //     e.clipboardData.setData('text/plain', copyText);
                //     e.preventDefault();
                // }, true);
                //
                // document.execCommand('copy');
                show_toastr('success', 'Url copied to clipboard', 'success');
            }
        </script>
    @endpush
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">{{ __('Projects') }}</a></li>
        <li class="breadcrumb-item">{{ ucwords("Supply") }}</li>
    @endsection
    @section('action-btn')
    <div class="float-end">
        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" id="toggleUploadBOQ"  data-bs-toggle="tooltip" title="{{__('Upload Bill of Quantity')}}"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endsection

    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card mt-5">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if (count($project->boqs) > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SN') }}</th>
                                            <th>{{ __('Item') }}</th>
                                            <th>{{ __('QTY') }}</th>
                                            <th>{{ __('QTY Delivered') }}</th>
                                            <th>{{ __('QTY Remaining') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->boqs as $key => $boq)
                                            @php
                                                $totalSum = $totalSum + ($boq->quantity * $boq->unit_price)
                                            @endphp
                                            <tr>
                                                <td>
                                                    <p>{{ $key + 1 }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $boq->item }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $boq->quantity }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $boq->supplied->sum('quantity') }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $boq->quantity - $boq->supplied->sum('quantity') }}</p>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-5">
                                <h6 class="h6 text-center">{{ __('No Bill of Quantity Uploaded yet!') }}</h6>
                            </div>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
    @include('livewire.supply.modals.add-project-supplies')
</div>
