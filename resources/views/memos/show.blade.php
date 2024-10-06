@extends('layouts.admin')
@section('page-title')
    {{__('Show Memo')}}
@endsection
@push('script-page')
@endpush


@section('content')
<div class="container">
    <h1>{{ $memo->title }}</h1>
    <p>{{ $memo->description }}</p>

    <p><strong>Created by:</strong> {{ $memo->creator->name }}</p>

    <p><strong>Signature:</strong>
        {{-- <img src="{{ asset($signatures->signature_path) }}" alt="Signature" height="50"> --}}
    </p>

    <a href="{{ asset('storage/' . $memo->file_path) }}" class="btn btn-primary" download>Download Memo</a>

    <hr>

    <h2>Share Memo</h2>

    {{-- <form action="{{ route('memos.share', $memo->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="shared_with">Share With:</label>
            <select name="shared_with" id="shared_with" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Share</button>
    </form> --}}
</div>
@endsection
