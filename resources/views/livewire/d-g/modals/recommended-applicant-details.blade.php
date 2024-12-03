<div id="viewBOQ">
    <div class="modal" id="viewApplicantModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">RECOMMENDED CONTRACTOR BIDDERS DETAILS
                        </h5>
                    </div>
                    <div class="modal-body">
                        @if($selApplicant)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">

                                            <tbody>
                                                <style>
                                                    th {
                                                        width: 200px !important;
                                                    }
                                                </style>
                                                <tr>
                                                    <th scope="row">Contractor Name</th>
                                                    <td>{{ $selApplicant->contractor->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Registered Company Name</th>
                                                    <td>{{ $selApplicant->applicant->company_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">CAC Year of Incorporation</th>
                                                    <td style="white-space: pre-wrap">
                                                        {{ $selApplicant->applicant->year_of_incorporation }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company TIN</th>
                                                    <td>{{ $selApplicant->applicant->company_tin }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Address</th>
                                                    <td>{{ $selApplicant->applicant->company_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Email</th>
                                                    <td>{{ $selApplicant->applicant->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Phone</th>
                                                    <td>{{ $selApplicant->applicant->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Application Status</th>
                                                    <td>
                                                        <span
                                                            class="badge @if ($selApplicant->application_status == 'pending') bg-warning
                                                            @elseif ($selApplicant->application_status == 'on_review') bg-info
                                                            @elseif ($selApplicant->application_status == 'selected') bg-primary
                                                            @elseif ($selApplicant->application_status == 'rejected') bg-danger @endif p-2 px-3 rounded">{{ $selApplicant->application_status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Application Date</th>
                                                    <td>{{ date('d-M-Y', strtotime($selApplicant->created_at)) }}
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <th scope="row">Estimated Expenses</th>
                                                    <td>₦ {{ number_format($dta->estimated_expense,2)  }}</td>
                                                </tr> --}}


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-sm-6">
                                    <h5 class="text-primary"><b>Uploaded Documents</b></h5>
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            @if ($selApplicant->documents->isEmpty())
                                                <p>No documents uploaded for this application.</p>
                                            @else
                                                @foreach ($selApplicant->documents as $applicationDocument)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ $applicationDocument->document_name }}</td>
                                                        <td class="text-end">
                                                            <a href="{{ asset('assets/documents/documents') }}/{{$applicationDocument->document}}" target="_blank"
                                                                class="btn btn-primary btn-sm"><i
                                                                    class="ti ti-eye"></i></a>
                                                            <a href="#" wire:click="downloadFile('{{ $applicationDocument->document }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div wire:loading wire:target="approveContractor"><x-g-loader /></div>
                                <input type="button" id="closeDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="button" wire:click="approveContractor('{{ $selApplicant->id }}')"
                                    value="{{ __('Approve for procurement process') }}" class="btn  btn-primary">
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
            document.getElementById("closeDetails").click();
        })
    </script>
    <x-toast-notification />
