@extends('layouts.admin')
@php
    //   $profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{ __('Folders') }}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Folders') }}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        {{-- ---------- Start Filter -------------- --}}
        <a href="#" class="btn btn-md btn-primary action-item" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-filter"></i>
        </a>
        <div class="dropdown-menu  dropdown-steady" id="project_sort">
            <a class="dropdown-item {{ $sortOrder == 'newest' ? 'active' : '' }}"
                href="{{ route('folders.index', ['sort' => 'newest']) }}" data-val="created_at-desc">
                <i class="ti ti-sort-descending"></i>{{ __('Newest') }}
            </a>
            <a class="dropdown-item" {{ $sortOrder == 'oldest' ? 'active' : '' }}
                href="{{ route('folders.index', ['sort' => 'oldest']) }}" data-val="created_at-asc">
                <i class="ti ti-sort-ascending"></i>{{ __('Oldest') }}
            </a>
        </div>

        {{-- ---------- End Filter -------------- --}}
        @can('create folder')
            <a href="#" data-size="lg" data-url="{{ route('folder.new') }}" data-ajax-popup="true"
                data-bs-toggle="tooltip" title="{{ __('Create new folder') }}" class="btn btn-md btn-primary">
                <i class="ti ti-plus"> </i>New
            </a>
        @endcan
    </div>
@endsection

<style>
    .desktop {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 2px;
        background: #f5f5f5;
        padding: 5px;
    }

    @media (max-width: 1024px) {
        .desktop {
            grid-template-columns: repeat(2, 1fr); /* 2 folders per row for smaller screens */
        }
    }

    @media (max-width: 768px) {
        .desktop {
            grid-template-columns: 1fr; /* 1 folder per row for mobile devices */
        }
    }

    .folder {
        position: relative;
        padding: 10px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 150px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .folder:hover {
        transform: scale(1.1); /* Slightly enlarges the folder on hover */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Adds a shadow effect */
    }

    .folder-icon img {
        width: 70px;
        height: 70px;
        margin-bottom: 10px;
    }

    .folder-name {
        margin-top: 5px;
        font-size: 14px;
        font-weight: bold;
        color: #333;
        word-break: break-word;
    }

    .nested-folders {
        margin-left: 20px;
        border-left: 2px dashed #ddd;
        padding-left: 10px;
    }
    .nested-folders .folder {
        margin-bottom: 10px;
    }

    .empty-desktop {
        text-align: center;
        color: #999;
        font-size: 16px;
    }

    .dragging {
        opacity: 0.5;
        border: 2px dashed #0078d7;
    }

    .drag-over {
        background-color: rgba(0, 120, 215, 0.3);
        border: 2px solid #0078d7;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-link {
        color: #007bff;
        margin: 0 5px;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <form action="{{ route('folders.index') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <input type="text" name="search" class="form-control"
                                                            placeholder="Search folders by name"
                                                            value="{{ request('search') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit"
                                                            class="btn btn-primary form-control">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="desktop">
                @if ($folders->count() > 0)
                    @foreach ($folders as $folder)
                        <div class="folder" style="margin-left: 20px;" data-id="{{ $folder->id }}" draggable="true">
                            <div class="folder-icon">
                                <a href="{{ route('folders.display', $folder->id) }}">
                                    <img src="{{ asset('assets/images/folder.png') }}" alt="Folder Icon" style="width: 50px; height: 50px;">
                                </a>
                            </div>
                            <div class="folder-name">
                                <a href="{{ route('folders.display', $folder->id) }}">
                                    <span>{{ $folder->folder_name }}</span>
                                </a>
                            </div>
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    @can('rename folder')
                                        <a href="#!" data-size="md" data-url="{{ route('folder.renameModal', $folder->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{ __('Rename Folder') }}">
                                            <i class="ti ti-pencil"></i>
                                            <span>{{ __('Rename') }}</span>
                                        </a>
                                    @endcan
                                    @can('view documents')
                                        <a href="{{ route('folder.details', $folder->id) }}" class="dropdown-item">
                                            <i class="ti ti-eye"></i>
                                            <span> {{ __('View Documents') }}</span>
                                        </a>
                                    @endcan
                                    @can('create folder')
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#createSubFolderModal"
                                            data-folder-id="{{ $folder->id }}">
                                            Create Subfolder
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            {{-- @if ($folder->children->count() > 0)
                                <div class="nested-folders" style="margin-left: 20px; border-left: 2px dashed #ddd; padding-left: 10px;">
                                    @include('filemanagement.subfolders', ['folders' => $folder->children])
                                </div>
                            @endif --}}
                        </div>
                    @endforeach
                @else
                    <div class="empty-desktop">
                        <p>No folders created!</p>
                    </div>
                @endif
            </div>
        </div>
         <div class="pagination-links mt-4">
                <nav>
                    <ul class="pagination justify-content-center">
                        @foreach ($folders->links()->elements[0] as $page => $url)
                            <li class="page-item{{ $page == $folders->currentPage() ? ' active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        <div class="modal fade" id="createSubFolderModal" tabindex="-1" role="dialog"
            aria-labelledby="createSubFolderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('folders.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createSubFolderModalLabel">Create Subfolder</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Folder Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <input type="hidden" name="parent_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('createSubFolderModal');
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const folderId = button.getAttribute('data-folder-id');
                modal.querySelector('input[name="parent_id"]').value = folderId;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const folders = document.querySelectorAll('.folder');
            let draggedFolderId = null;

            folders.forEach(folder => {
                // Start dragging
                folder.addEventListener('dragstart', (e) => {
                    draggedFolderId = folder.dataset.id; // Store the ID of the folder being dragged
                    e.dataTransfer.setData('text/plain', draggedFolderId);
                    folder.classList.add('dragging');
                });

                // End dragging
                folder.addEventListener('dragend', (e) => {
                    folder.classList.remove('dragging');
                });

                // Allow folder to be a drop target
                folder.addEventListener('dragover', (e) => {
                    e.preventDefault(); // Allow dropping
                    folder.classList.add('drag-over');
                });

                // Remove the 'drag-over' class when the drag leaves
                folder.addEventListener('dragleave', (e) => {
                    folder.classList.remove('drag-over');
                });

                // Handle drop event
                folder.addEventListener('drop', (e) => {
                    e.preventDefault();
                    folder.classList.remove('drag-over');

                    const droppedOnFolderId = folder.dataset
                    .id; // ID of the folder being dropped on

                    if (draggedFolderId !== droppedOnFolderId) {
                        // Make an AJAX request to move the folder
                        fetch(`/folders/move`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                },
                                body: JSON.stringify({
                                    dragged_folder_id: draggedFolderId,
                                    target_folder_id: droppedOnFolderId,
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Folder moved successfully!');
                                    // Optionally, update the UI to reflect the change
                                } else {
                                    alert('Failed to move folder: ' + data.message);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>

@endsection
