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
                <h2>Company Form</h2>

                <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data" id="companyForm">
                    @csrf
                    <div class="user-details">

                        {{-- Company Name --}}
                        <div class="input-box">
                            <span class="details">Company Name:</span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
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

                        {{-- Logo --}}
                        <div class="input-box">
                            <span class="details">Logo (min 100×100):</span>
                            <input type="file" id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Website --}}
                        <div class="input-box">
                            <span class="details">Website:</span>
                            <input type="url" id="website" name="website" value="{{ old('website') }}">
                            @error('website')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="button">
                        <input type="submit" name="submit_btn" value="Save Company">
                    </div>
                </form>

            </div>
        </div>
    </section>
        <!-- ./wrapper -->
 
@endsection
