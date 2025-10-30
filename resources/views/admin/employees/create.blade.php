@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" href="{{ url('../assets/admin/css/company_form.css') }}">

<!-- Main content -->
    <section class="content">
        <div class="main_div" style="max-width:1564px">
            <div class="sale_list">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <h2>Employee Form</h2>

<form action="{{ route('admin.employees.store') }}" method="POST" id="employeeForm">
    @csrf
    <div class="user-details">

        {{-- First Name --}}
        <div class="input-box">
            <span class="details">First Name:</span>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Last Name --}}
        <div class="input-box">
            <span class="details">Last Name:</span>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Company --}}
        <div class="input-box">
            <span class="details">Company:</span>
            <select id="company_id" name="company_id" required>
                <option value="">Select Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="input-box">
            <span class="details">Email:</span>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="input-box">
            <span class="details">Phone:</span>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="button">
        <input type="submit" name="submit_btn" value="Save Employee">
    </div>
</form>

            </div>
        </div>
    </section>
        <!-- ./wrapper -->
 
@endsection
