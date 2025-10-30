@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" href="{{ url('../assets/admin/css/company.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">


<!-- Main content -->
    <section class="content">
        <div class="main_div" style="max-width:1564px">
            <div class="sale_list">
                <button class="add_btn" > <a href="{{route('admin.companies.create')}}" style=" color: #fff;"> + New Entry</a></button><br>
                @if (session('success'))
                <div class="alert alert-success" style="color: rgb(77, 196, 21); text-align:center;">
                    {{ session('success') }}
                </div>
                @endif
             {{-- serching menu --}}
                <label for="search">Search company Here : </label>
                <input type="text" id="searchQuery" name="search" placeholder="Search company here" value="{{ request('search') }}">
                
                <table id="companiesTable" class='table table-striped table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Sl. No</th>
                            <th>Company Name</th>
                            <th>Email Id</th>
                            <th>Logo</th>
                            <th>Website Url</th>
                            <th colspan=2>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $key => $company)
                        <tr>
                            <td>{{ $loop->iteration + $companies->firstItem() - 1 }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" 
                                        alt="Logo" 
                                        width="80" 
                                        height="80"
                                        class="img-thumbnail">
                                @else
                                    <span>No Logo</span>
                                @endif
                            </td>
                            <td>{{ $company->website }}</td>
                        
                            
                            <td>
                                <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                            <td>
                                <form action="{{route('admin.companies.delete', $company->id)}}" method="POST" class="delete-form" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="del_btn">Delete</button>
                                </form> 
                            </td>                                                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--  Pagination --}}
                @if ($companies->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Showing <strong>{{ $companies->firstItem() }}</strong> to
                            <strong>{{ $companies->lastItem() }}</strong> of
                            <strong>{{ $companies->total() }}</strong> entries
                        </div>
                        <div>
                            {{ $companies->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
                @endif
                            
            </div>
        </div>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
        
                var form = $(this);
                var url = form.attr('action');
                var row = form.closest('tr');
        
                if (confirm("Are you sure you want to delete this company?")) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success) {
                                alert(response.success);
                                row.fadeOut(500, function() { $(this).remove(); });
                            } else {
                                alert('Error: ' + response.error);
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Something went wrong. Please try again.');
                        }
                    });
                }
            });
             // 🔹 SEARCH FILTER
            $('#searchQuery').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                var anyCompanyFound = false;

                // loop through table rows (skip header)
                $('#companiesTable tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    var isMatch = rowText.includes(searchText);
                    $(this).toggle(isMatch);

                    if (isMatch) {
                        anyCompanyFound = true;
                    }
                });

                // show a "no data" message 
                if (!anyCompanyFound) {
                    if ($('#noDataFound').length === 0) {
                        $('#companiesTable tbody').append(
                            "<tr id='noDataFound'><td colspan='7' style='text-align:center; color:red;'>No matching records found</td></tr>"
                        );
                    }
                } else {
                    $('#noDataFound').remove();
                }
            });
        });

    </script>
        
        
@endsection 