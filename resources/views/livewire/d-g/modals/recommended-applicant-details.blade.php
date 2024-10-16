<div id="viewBOQ">
    <div class="modal" id="viewApplicantModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">TOP APPLICANT DETAILS
                        </h5>
                    </div>
                    <div class="modal-body">
                        @if ($projectApplicant)
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
                                                    <th scope="row">Applicant Name</th>
                                                    <td>{{ $projectApplicant->contractor->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Name</th>
                                                    <td>{{ $projectApplicant->applicant->company_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Year of Incorporation</th>
                                                    <td style="white-space: pre-wrap">
                                                        {{ $projectApplicant->applicant->year_of_incorporation }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company TIN</th>
                                                    <td>{{ $projectApplicant->applicant->company_tin }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Address</th>
                                                    <td>{{ $projectApplicant->applicant->company_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Email</th>
                                                    <td>{{ $projectApplicant->applicant->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Phone</th>
                                                    <td>{{ $projectApplicant->applicant->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Application Status</th>
                                                    <td>
                                                        <span
                                                            class="badge @if ($projectApplicant->application_status == 'pending') bg-warning
                                                            @elseif ($projectApplicant->application_status == 'on_review') bg-info
                                                            @elseif ($projectApplicant->application_status == 'selected') bg-primary
                                                            @elseif ($projectApplicant->application_status == 'rejected') bg-danger @endif p-2 px-3 rounded">{{ $projectApplicant->application_status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Application Date</th>
                                                    <td>{{ date('d-M-Y', strtotime($projectApplicant->created_at)) }}
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
                                            @if ($projectApplicant->documents->isEmpty())
                                                <p>No documents uploaded for this application.</p>
                                            @else
                                                @foreach ($projectApplicant->documents as $applicationDocument)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ $applicationDocument->document_name }}</td>
                                                        <td class="text-end">
                                                            <a href="#" target="_blank"
                                                                class="btn btn-primary btn-sm"><i
                                                                    class="ti ti-eye"></i></a>
                                                            <a href="#" class="btn btn-primary btn-sm"><i
                                                                    class="ti ti-download" download></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="button" id="closeDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="button" wire:click="recommendToDg('{{ $projectApplicant->id }}')"
                                    value="{{ __('Approve') }}" class="btn  btn-primary">
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
