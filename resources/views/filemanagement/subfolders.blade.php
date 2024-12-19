@if ($folders->count() > 0)
    @foreach ($folders as $folder)
        <div class="folder" style="margin-left: 20px;" data-id="{{ $folder->id }}" draggable="true">
            <!-- Folder Icon and Name -->
            <div class="folder-icon">
                <img src="{{ asset('assets/images/folder.png') }}" alt="Folder Icon" style="width: 50px; height: 50px;">
            </div>
            <div class="folder-name">
                <span>{{ $folder->folder_name }}</span>
            </div>

            <!-- Action Dropdown -->
            <div class="btn-group card-option">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#!" data-size="md" data-url="{{ route('folder.renameModal', $folder->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{ __('Rename Folder') }}">
                        <i class="ti ti-pencil"></i>
                        <span>{{ __('Rename') }}</span>
                    </a>
                    <a href="{{ route('folder.details', $folder->id) }}" class="dropdown-item">
                        <i class="ti ti-eye"></i>
                        <span> {{ __('View Details') }}</span>
                    </a>
                    
                    <a href="#" class="dropdown-item" data-bs-toggle="modal" 
                        data-bs-target="#createSubFolderModal" 
                        data-folder-id="{{ $folder->id }}">
                        Create Subfolder
                    </a>
                </div>
            </div>

            <!-- Nested Subfolders -->
            @if ($folder->children->count() > 0)
                <div class="nested-folders" style="margin-left: 20px; border-left: 2px dashed #ddd; padding-left: 10px;">
                    @include('filemanagement.subfolders', ['folders' => $folder->children])
                </div>
            @endif
        </div>
    @endforeach
@endif