@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1>Create Menu</h1>

        {{-- Menampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form untuk membuat menu baru --}}
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" >
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Menu</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
