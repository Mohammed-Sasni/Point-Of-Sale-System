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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Paid Salary</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Paid Salary</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('employee.salary.store') }}" enctype="multipart/form-data">
                        @csrf
         <input type="hidden" name="id" value="{{$paysalary->id}}">               
                        
                        <h5 class="mb-4 text-uppercase">
                            <i class="mdi mdi-account-circle me-1"></i> Paid Salary
                        </h5>                      
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Name</label>
                                    <strong style="color: #fff;">{{ $paysalary->name }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Salary Month</label>
                                    <strong style="color: #fff;">{{ date("F", strtotime('-1 month')) }} </strong>
                                    <input type="hidden" name="month" value="{{ date("F", strtotime('-1 month')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Salary</label>
                                    <strong style="color: #fff;">{{ $paysalary->salary }}</strong>
                                    <input type="hidden" name="paid_amount" value="{{$paysalary->salary}}">   
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Advance Salary</label>
                                    <strong style="color: #fff;">
                                        {{ $paysalary->advance->advance_salary ?? '0' }}
                                    </strong>
                                    <input type="hidden" name="advance_salary" value="{{ $paysalary->advance->advance_salary ?? '0' }}"> 
                                </div>
                            </div>
                        </div>

                        {{-- Calculation for Due Salary --}}
                        @php
                            $salary = is_numeric($paysalary->salary) ? $paysalary->salary : 0;
                            $advance = is_numeric(optional($paysalary->advance)->advance_salary) ? optional($paysalary->advance)->advance_salary : 0;
                            $amount = $salary - $advance;
                        @endphp

                        <div class="mb-3">
                            <label class="form-label">Due Salary</label>
                            <strong style="color: #fff;">
                                @if(optional($paysalary->advance)->advance_salary === null)
                                    <span>No Salary</span>
                                @else
                                    {{ round($amount) }}
                                @endif
                            </strong>
                            <input type="hidden" name="due_salary" value="{{ round($amount) }}">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                <i class="mdi mdi-content-save"></i> Paid Salary
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection