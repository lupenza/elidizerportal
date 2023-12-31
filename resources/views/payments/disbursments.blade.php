@extends('layouts.master')
@section('content')
<style>
    td{
        align-content: center;
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Payment Disbursed</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal"> <span class="bx bx-user-plus"></span> Add Agent</button> --}}
                    {{-- <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
       
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0 text-uppercase text-center">Payment Disbursed</h6>
                <hr/>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment Date</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Payment Reference</th>
                                <th>Payment Method</th>
                                <th>Payment Channel</th>
                                
                            </tr>
                        </thead>
                       <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d,M-Y',strtotime($payment->payment_date))}}</td>
                                <td>{{ $payment->loan_contract->customer->first_name.' '.$payment->loan_contract->customer->last_name }}</td>
                                <td>{{ $payment->loan_contract->customer->email }} <br> {{ $payment->loan_contract->customer->phone_number }} </td>
                                <td>{{ number_format($payment->paid_amount) }}</td>
                                <td>{{ $payment->payment_reference }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->payment_channel }}</td>
                               
                            </tr> 
                        @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agent Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="registration_form">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Write fullname ......." required>
                        </div>
                        <div class="col-md-12">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Write Email......." required>
                        </div>
                        <div class="col-md-12">
                            <label for="">Phone Number</label>
                            <input type="number" name="phone_number" class="form-control" placeholder="Write phone number......." required>
                        </div>
                        <div class="col-md-12">
                            <label for="">Student Reg</label>
                            <input type="text" name="student_reg_id" class="form-control" placeholder="Write Student Reg Id......." required>
                        </div>
                        <div class="col-md-12">
                            <label for="">College</label>
                            <select name="college_id" class="form-control" required>
                                <option value="">Please Choose College</option>
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->id}}">{{ $college->name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">Agent Profile Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="col-md-12" id="alert" style="margin-top: 10px">

                        </div>
                        <div class="col-md-12" style="text-align:right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <span class="bx bx-times"></span> Close</button>
                            <button type="submit" class="btn btn-primary" id="reg_btn"> <span class="bx bx-save"></span> Submit</button>
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>
    </div>
</div> --}}
    
@endsection

