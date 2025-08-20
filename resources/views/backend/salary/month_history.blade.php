@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Last Month Salary History</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Last Month Salary History</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Removed form since you're just displaying data -->
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Last Month Salary History</h5>                      
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Employee Name</label>
                                <strong style="color: #000;">{{ $monthhistory->name }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Salary Month</label>
                                <strong style="color: #000;">{{ date("F", strtotime('-1 month')) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Salary Year</label>
                                <strong style="color: #000;">{{ date("Y") }}</strong>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Advance Salary</label>
                                <strong style="color: #000;">
                                    {{ $monthhistory->advance->advance_salary ?? '0' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <!-- Removed submit button since this is just a view page -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection