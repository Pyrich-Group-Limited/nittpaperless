<div>
    @section('page-title')
        {{ __('Queries') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Queries') }}</li>
    @endsection

    @section('action-btn')
        <div class="float-end">
            <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-filter"></i>
            </a>
            <div class="dropdown-menu  dropdown-steady" id="project_sort">
                <a class="dropdown-item active" href="#" data-val="created_at-desc">
                    <i class="ti ti-sort-descending"></i>{{ __('Newest') }}
                </a>
                <a class="dropdown-item" href="#" data-val="created_at-asc">
                    <i class="ti ti-sort-ascending"></i>{{ __('Oldest') }}
                </a>

                <a class="dropdown-item" href="#" data-val="project_name-desc">
                    <i class="ti ti-sort-descending-letters"></i>{{ __('From Z-A') }}
                </a>
                <a class="dropdown-item" href="#" data-val="project_name-asc">
                    <i class="ti ti-sort-ascending-letters"></i>{{ __('From A-Z') }}
                </a>
            </div>
        </div>
    @endsection

    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Query Subject</th>
                                    @canany(['raise query', 'assign query'])
                                        <th>Raised By</th>
                                    @endcanany
                                    <th>Query For</th>
                                    <th>Status</th>
                                    <th>Signature</th>
                                    <th>Date/Time</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @forelse ($queries as $index => $query)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $query->subject }}</td>
                                        @canany(['raise query', 'assign query'])
                                            <td>{{ $query->raiser->name ?? 'N/A' }}</td>
                                        @endcanany
                                        <td>{{ $query->staff->name ?? 'N/A' }}</td>
                                        <td>
                                            @if ($query->status === 'Pending')
                                                <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                            @elseif ($query->status === 'Answered')
                                                <span class="badge bg-success p-2 px-3 rounded">Answered</span>
                                            @elseif ($query->status === 'Rejected')
                                                <span class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                            @else
                                                <span class="badge bg-warning p-2 px-3 rounded">
                                                    {{ $query->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($query->raiser && $query->raiser->signature)
                                                <img src="{{ asset('storage/' . $query->raiser->signature->signature_path) }}" alt="Signature" height="50">
                                            @else
                                                <strike>{{ $query->raiser->name }}</strike>
                                            @endif
                                        </td>
                                        <td>{{ $query->created_at->format('d-M-Y h:i:s A') }}</td>
                                        <td>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" wire:click="setQuery('{{ $query->id }}')"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#queryDetailsModal"
                                                    data-size="xl" data-bs-toggle="tooltip"
                                                    title="{{ __('View Details') }}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>

                                            @if ($query->status === 'Pending' && auth()->user()->can('assign query'))
                                                <div class="action-btn bg-success ms-2">
                                                    <a href="#" wire:click="setActionId('{{ $query->id }}')"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center confirm-approve"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ __('Issue Query to Staff') }}">
                                                        <i class="ti ti-check text-white"></i>
                                                    </a>
                                                </div>
                                            @endif

                                            @if (auth()->user()->can('raise query'))
                                                @if ($query->status === 'Answered' && $query->raised_by === auth()->user()->id)
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" wire:click="setQueryAnswer('{{ $query->id }}')"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="modal" data-bs-target="#queryAnswerModal"
                                                            data-size="xl" data-bs-toggle="tooltip"
                                                            title="{{ __('View Answer') }}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif

                                            @if (auth()->user()->can('assign query'))
                                                @if ($query->status === 'Answered' && $query->assigned_by === auth()->user()->id)
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" wire:click="setQueryAnswer('{{ $query->id }}')"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="modal" data-bs-target="#queryAnswerModal"
                                                            data-size="xl" data-bs-toggle="tooltip"
                                                            title="{{ __('View Answer') }}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif

                                            @if (($query->staff_id === auth()->user()->id && $query->status != 'Answered'))
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('query.reply',$query->id) }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ __('Reply Query') }}">
                                                        <i class="fa fa-reply text-white"></i>
                                                    </a>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th scope="col" colspan="9">
                                            <h6 class="text-center">{{ __('No Queries  Found.') }}</h6>
                                        </th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $queries->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('livewire.query.modals.query-details')
    @include('livewire.query.modals.query-answer')
    <x-toast-notification />
</div>
