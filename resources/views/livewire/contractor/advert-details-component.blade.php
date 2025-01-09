<div>
    @section('page-title')
    Contractor Dashboard
    @endsection

    <div class="row">
        <!-- Error and Success Message Containers -->
        <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
        <div id="success-message" class="alert alert-success d-none" role="alert"></div>

        @if(count(Auth::user()->projectApplications($advert->project_id)) <= 0)
            <div class="col-md-12">
                <div class="row">
                    <!-- Project Details Section -->
                    <div class="col-md-6">
                        <div class="card emp_details h-100">
                            <div class="card-header">
                                <h6 class="mb-0">{{ $advert->project->project_name }}</h6>
                            </div>
                            <div class="card-body employee-detail-edit-body">
                                <img src="@if($advert->image){{ asset('guest/images/uploads/'.$advert->image) }}@else{{ asset('uploads/procurement.png') }}@endif"
                                    class="img-fluid thumb w-100"
                                    width="768" height="456"
                                    alt="{{ $advert->project->project_title }}">
                            </div>
                            <hr>
                            <p style="padding: 20px; font-weight:500" class="p-3">{{ strip_tags($advert->description) }}</p>
                        </div>
                    </div>

                    <!-- Upload Required Documents Section -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Upload Required Documents</h6>
                                {{-- @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach --}}
                            </div>
                            <div class="card-body">
                                @foreach($inputs as $key => $input)
                                    <div class="form-group mb-3">
                                        <label for="doc_name_{{ $key  }}">Document Name</label>
                                        <input type="text" id="doc_name_{{ $key  }}" wire:model="inputs.{{ $key }}.doc_name" class="form-control mb-2" placeholder="Enter document name">
                                        @error("inputs.{$key}.doc_name") <span class="text-danger">{{ $message }}</span> @enderror
                                        <br>

                                        <label for="doc_file_{{ $key }}">Document File</label>
                                        <div class="position-relative">
                                            <input type="file" id="doc_file_{{ $key }}" wire:model="inputs.{{ $key }}.doc_file" class="form-control">
                                            @error("inputs.{$key}.doc_file") <span class="text-danger">{{ $message }}</span> @enderror

                                            <!-- Loading Indicator -->
                                            <div wire:loading wire:target="inputs.{{ $key }}.doc_file" class="position-absolute top-50 start-50 translate-middle">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Uploading...</span>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger mt-2 btn-sm" wire:click="removeInput({{ $key }})">Remove</button>
                                    </div>
                                @endforeach

                                <button type="button" class="btn btn-primary mb-3" wire:click="addInput">Add Another Document</button>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="#">
                                <input type="button" data-bs-toggle="tooltip"
                                    title="{{ __('Bid for contract') }}"
                                    value="{{ __('BID') }}"
                                    class="btn btn-primary w-100 confirm-application"
                                    wire:click="applyContract">
                            </a>
                            <div wire:loading wire:target="applyContract">
                                <x-g-loader />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-success">
                You have successfully applied for this project. <a href="{{route('contractor.applications')}}">Click here</a> to view application status.
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('error', event => {
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = event.detail.error;
                errorMessage.classList.remove('d-none');
                setTimeout(() => {
                    errorMessage.classList.add('d-none');
                }, 5000);
            });

            window.addEventListener('success', event => {
                const successMessage = document.getElementById('success-message');
                successMessage.textContent = event.detail.success;
                successMessage.classList.remove('d-none');
                setTimeout(() => {
                    successMessage.classList.add('d-none');
                }, 5000);
            });
        });
    </script>
</div>
