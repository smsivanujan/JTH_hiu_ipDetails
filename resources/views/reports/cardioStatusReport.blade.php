@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cardio Thoraric Surgery List By Status</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- Row -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="col-lg-6">
                    <h3 class="card-title">Cardio Thoraric Surgery List By Status</h3>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <form action="{{ route('cardio.cardioReport') }}" method="GET" class="row m-0 pt-3">
                        <div class="form-group col-md-4">
                            <label for="category">Surgery</label>
                            <select class="form-select" name="surgery">
                                <option selected value="">Choose...</option>
                                @foreach ($surgeries as $item)
                                <option value="{{ $item->id }}" {{$surgeryType == $item->id ? 'selected':''}}>
                                    {{ $item->surgery_name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a surgery.</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option selected value="">Choose...</option>
                                <option Value="Surgery Done" {{$status == 'Surgery Done' ? 'selected':''}}>Surgery Done</option>
                                <option Value="Awaiting" {{$status == 'Awaiting' ? 'selected':''}}>Awaiting</option>
                                <option Value="Passed Away" {{$status == 'Passed Away' ? 'selected':''}}>Passed Away</option>
                                <option Value="Medical Management" {{$status == 'Medical Management' ? 'selected':''}}>Medical Management</option>
                                <option Value="Not Intrest" {{$status == 'Not Intrest' ? 'selected':''}}>Not Intrested</option>
                                <option Value="Not Fit" {{$status == 'Not Fit' ? 'selected':''}}>Not Fit</option>
                                <option Value="Unable To Contact" {{$status == 'Unable To Contact' ? 'selected':''}}>Unable To Contact</option>
                                <option Value="Patient Decision Pending" {{$status == 'Patient Decision Pending' ? 'selected':''}}>Patient Decision Pending</option>
                            </select>
                            <div class="invalid-feedback">Please select a Status.</div>
                        </div>

                        <div class="form-group col-md-4" style="margin-top:24px">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom operationList-table" id="file-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>CTU Number</th>
                                <th>Status</th>
                                <th>Surgery</th>
                                <th>Full Name</th>
                                <th>EF%</th>
                                <th>Diagnosis</th>
                                <th>Comments</th>
                                <th>CTS</th>
                                <th>Contact Number 1</th>
                                <th>Contact Number 2</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>District</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cardios as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->ctu_number }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->surgery_name }}</td>
                                <td>{{ $row->prefix }} {{ $row->full_name }}</td>                     
                                <td>{{ $row->ef }}</td>
                                <td>{{ $row->diagnosis }}</td>
                                <td>{{ $row->comments }}</td>
                                <td>{{ $row->cts }}</td>
                                <td>{{ $row->contact_number_1 }}</td>
                                <td>{{ $row->contact_number_2 }}</td>
                                <td>{{ $row->gender }}</td>
                                <td>{{ $row->age }}</td>
                                <td>{{ $row->district }}</td>                        
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection

{{-- modal section --}}
@section('modal')

@endsection

@section('scripts')

@endsection