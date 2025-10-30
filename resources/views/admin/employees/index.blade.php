@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" href="{{ url('../assets/admin/css/company.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">


<!-- Main content -->
    <section class="content">
        <div class="main_div" style="max-width:1564px">
            <div class="sale_list">
                <button class="add_btn" > <a href="{{route('admin.employees.create')}}" style=" color: #fff;"> + New Entry</a></button><br>
                @if (session('success'))
                <div class="alert alert-success" style="color: rgb(30, 255, 0); text-align:center;">
                    {{ session('success') }}
                </div>
                @endif
                {{-- serching menu --}}
                <label for="search">Search employee Here : </label>
                <input type="text" id="searchQuery" name="search" placeholder="Search employee here" value="{{ request('search') }}">
                
                <table id="employeeTable" class='table table-striped table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Sl. No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company Name</th>
                            <th>Email Id</th>
                            <th>Phone No.</th>
                            <th colspan=2>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{ $loop->iteration + $employees->firstItem() - 1 }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->company->name ?? 'N/A' }}</td>
                            <td>{{ $employee->email ?? '-'  }}</td>
                            <td>{{ $employee->phone ?? '-'  }}</td>
                        
                            
                            <td> 
                                <a href="{{ route('admin.employees.edit', ['id' => $employee->id]) }}" class="edit_btn btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('admin.employees.delete', $employee->id)}}" method="POST" class="delete-form" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="del_btn">Delete</button>
                                </form> 
                            </td>                                                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($employees->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Showing <strong>{{ $employees->firstItem() }}</strong> to
                            <strong>{{ $employees->lastItem() }}</strong> of
                            <strong>{{ $employees->total() }}</strong> entries
                        </div>
                        <div>
                            {{ $employees->onEachSide(1)->links() }}
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
        
                if (confirm("Are you sure you want to delete this employee?")) {
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
                var anyEmployeeFound = false;

                // loop through table rows (skip header)
                $('#employeeTable tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    var isMatch = rowText.includes(searchText);
                    $(this).toggle(isMatch);

                    if (isMatch) {
                        anyEmployeeFound = true;
                    }
                });anyCompanyFound

                // show a "no data" message 
                if (!anyEmployeeFound) {
                    if ($('#noDataFound').length === 0) {
                        $('#employeeTable tbody').append(
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
