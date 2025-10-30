@extends('admin.layouts.master')

@section('content')
<link rel="stylesheet" href="{{ url('../assets/admin/css/company_form.css') }}">
<section class="content">
    <div class="main_div" style="max-width:1564px">
        <div class="sale_list">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="container mt-4">
                <h2>Edit Employee</h2>
                <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Company</label>
                        <select name="company_id" class="form-select">
                            <option value="">-- Select Company --</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update Employee</button>
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
@endsection
