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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Advance Salary</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Advance Salary</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('advance.salary.update')}}" enctype="multipart/form-data">
                        @csrf

     <input type="hidden" name="id" value="{{ $salary->id }}">
                        
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Advance Salary</h5>                      
                        
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Employee Name</label>
            <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" id="example-select">
    <option selected disabled>Select Employee</option>
    @foreach($employee as $item)
    <option value="{{ $item->id }}" {{ $item->id == $salary->employee_id ? 'selected' : '' }}>{{ $item->name }}</option>
    @endforeach
</select>
            @error('employee_id')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Salary Month</label>
<select name="month" class="form-select @error('month') is-invalid @enderror">
<option selected disabled>Select Month</option>
        <option value="January" {{ $salary->month == 'January' ? 'selected' : '' }}>January</option>
        <option value="February"{{ $salary->month == 'February' ? 'selected' : '' }}>February</option>
        <option value="March"{{ $salary->month == 'March' ? 'selected' : '' }}>March</option>
        <option value="April"{{ $salary->month == 'April' ? 'selected' : '' }}>April</option>
        <option value="May"{{ $salary->month == 'May' ? 'selected' : '' }}>May</option>
        <option value="June"{{ $salary->month == 'June' ? 'selected' : '' }}>June</option>
        <option value="July"{{ $salary->month == 'July' ? 'selected' : '' }}>July</option>
        <option value="August"{{ $salary->month == 'August' ? 'selected' : '' }}>August</option>
        <option value="September"{{ $salary->month == 'September' ? 'selected' : '' }}>September</option>
        <option value="October"{{ $salary->month == 'October' ? 'selected' : '' }}>October</option>
        <option value="November"{{ $salary->month == 'November' ? 'selected' : '' }}>November</option>
        <option value="December"{{ $salary->month == 'December' ? 'selected' : '' }}>December</option>
</select>
@error('month')<span class="text-danger">{{ $message }}</span>@enderror
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Salary Year</label>
<select name="year" class="form-select @error('year') is-invalid @enderror">
<option selected disabled>Select Year</option>
<option selected disabled>Select Year</option>
        <option value="2025"{{ $salary->year == '2025' ? 'selected' : '' }}>2025</option>
        <option value="2026"{{ $salary->year == '2026' ? 'selected' : '' }}>2026</option>
        <option value="2027"{{ $salary->year == '2027' ? 'selected' : '' }}>2027</option>
        <option value="2028"{{ $salary->year == '2028' ? 'selected' : '' }}>2028</option>
        <option value="2029"{{ $salary->year == '2029' ? 'selected' : '' }}>2029</option>
</select>
@error('year')<span class="text-danger">{{ $message }}</span>@enderror
</div>
</div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Advance Salary</label>
                                    <input type="text" name="advance_salary" class="form-control @error('advance_salary') is-invalid @enderror" value="{{$salary->advance_salary}}">
                                    @error('advance_salary')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                <i class="mdi mdi-content-save"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection