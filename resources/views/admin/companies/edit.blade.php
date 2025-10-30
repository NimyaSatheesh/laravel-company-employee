@extends('admin.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Company</h2>

    <form action="{{ route('admin.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}">
        </div>

        <div class="mb-3">
            <label>Current Logo</label><br>
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" width="100" height="100" style="object-fit:contain;">
            @else
                <p>No logo uploaded</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Change Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Company</button>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
