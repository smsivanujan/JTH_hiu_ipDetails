@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cardiothoracic Waiting List</li>
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
                    <h3 class="card-title">Cardiothoracic Waiting List</h3>
                </div>
                <div class="col-lg-6 text-end">
                    <button type="button" title="Add" id="btn-add" class="modal-effect btn btn-primary-gradient btn-pill" data-bs-effect="effect-sign" data-bs-toggle="modal" data-bs-target="#modal_"><i class="fe fe-plus me-2"></i>Add</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom Cardio-table" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th>Action</th>
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
                                <th>Address</th>
                                <th>District</th>                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cardios as $row)
                            <tr>
                                <td>
                                    <a class="btn btn-blue edit" title="Edit" data-id="{{ $row->id }}" data-ctu_number="{{ $row->ctu_number }}" data-surgery_id="{{ $row->surgery_id }}" data-prefix="{{ $row->prefix }}" data-full_name="{{ $row->full_name }}" data-gender="{{ $row->gender }}" data-age="{{ $row->age }}" data-contact_number_1="{{ $row->contact_number_1 }}" data-contact_number_2="{{ $row->contact_number_2 }}" data-district="{{ $row->district }}" data-address="{{ $row->address }}" data-ef="{{ $row->ef }}" data-diagnosis="{{ $row->diagnosis }}" data-comments="{{ $row->comments }}" data-cts="{{ $row->cts }}" data-status="{{ $row->status }}">
                                        <i style="color:rgb(226, 210, 210);cursor: pointer" class="fa fa-edit"></i>
                                    </a>
                                </td>
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
                                <td>{{ $row->address }}</td>
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
<div class="modal fade" id="modal_">
    <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="createFormModal">Cardiology Unit</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <div class="form-group text-center">
                    <label class="form-label" for="search-box">Cardio Patient</label>
                    <form id="search-form" action="{{ route('patient.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="id_patient" id="id_patient" hidden>
                            <input type="text" class="form-control" id="search-box" name="search-term" placeholder="Search for...">
                            <button type="submit" id="search-button" class="input-group-text btn btn-primary text-white">Search</button>
                        </div>
                    </form>
                    <label for="">Search with PHN/NIC/Passport/BHT/Phone Number(Handphone or Landline)</label>
                    <div id="search-result" class="mt-3 text-red"></div>
                </div>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('cardio.save') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="text" class="form-control" name="id" id="id" hidden>

                    <div class="row">
                        <!-- CTU Number -->
                        <div class="form-group col-md-4 col-12">
                            <label for="ctu_number">CTU Number<span class="required text-red">*</span></label>
                            <input type="text" class="form-control" id="ctu_number" name="ctu_number" placeholder="Enter CTU Number" required>
                            <div class="invalid-feedback">Please Enter the CTU Number.</div>
                        </div>
                        <!-- Surgery -->
                        <div class="form-group col-md-8 col-12 mb-3">
                            <label for="surgery">Surgery<span class="required text-red">*</span></label>
                            <select class="form-control select2-show-search form-select" data-placeholder="Choose Surgery" name="surgery" id="surgery" required>
                                <option label="Choose"></option>
                                <option label="All">All</option>
                                @foreach ($surgeries as $item)
                                <option value="{{ $item->id }}" {{ old('surgery_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->surgery_name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please Select the Surgery.</div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Prefix -->
                        <div class="form-group col-md-2 col-12">
                            <label for="prefix">Prefix</label>
                            <select class="form-select" id="prefix" name="prefix">
                                <option selected disabled value="">Choose...</option>
                                <option vlaue="Mr">Mr</option>
                                <option vlaue="Master">Master</option>
                                <option vlaue="Mrs">Mrs</option>
                                <option vlaue="Ms">Ms</option>
                                <option vlaue="Thero">Thero</option>
                                <option vlaue="Dr">Dr</option>
                                <option vlaue="Prof">Prof</option>
                                <option vlaue="Fr">Fr</option>
                            </select>
                            <div class="invalid-feedback">Please select a prefix.</div>
                        </div>
                        <!-- Patient Name -->
                        <div class="form-group col-md-6 col-12">
                            <label for="full_name">Patient Name<span class="required text-red">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Full Name" required>
                            <div class="invalid-feedback">Please Enter the Patient Name.</div>
                        </div>
                        <!-- Gender -->
                        <div class="form-group col-md-2 col-12">
                            <label for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option selected disabled value="">Choose...</option>
                                <option vlaue="Male">Male</option>
                                <option vlaue="Female">Female</option>
                                <option vlaue="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select a gender.</div>
                        </div>
                        <!-- Age -->
                        <div class="form-group col-md-2 col-12 mb-3">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age">
                            <div class="invalid-feedback">Please Enter the Age.</div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Contact Number 01 -->
                        <div class="form-group col-md-4 col-12">
                            <label for="contact_number_1">Contact Number 01<span class="required text-red">*</span></label>
                            <input type="number" class="form-control" id="contact_number_1" name="contact_number_1" placeholder="Enter Contact Number 01" required>
                            <div class="invalid-feedback">Please Enter the contact number 01.</div>
                        </div>
                        <!-- Contact Number 02 -->
                        <div class="form-group col-md-4 col-12">
                            <label for="contact_number_2">Contact Number 02</label>
                            <input type="number" class="form-control" id="contact_number_2" name="contact_number_2" placeholder="Enter Contact Number 02">
                            <div class="invalid-feedback">Please Enter the contact number 02.</div>
                        </div>
                        <!-- District -->
                        <div class="form-group col-md-4 col-12 mb-3">
                            <label for="district">District</label>
                            <select class="form-control select2-show-search form-select" id="district" name="district" data-placeholder="Choose one">
                                <option label="Choose one"></option>
                                <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kegalle">Kegalle</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Moneragala">Moneragala</option>
                                <option value="Mullaitivu">Mullaitivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>
                            </select>
                            <div class="invalid-feedback">Please select a District.</div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="form-group col-md-12 col-12 mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <!-- EF% -->
                        <div class="form-group col-md-2 col-12">
                            <label for="ef">EF%</label>
                            <input type="text" class="form-control" id="ef" name="ef" placeholder="Enter EF%">
                            <div class="invalid-feedback">Please Enter the EF%.</div>
                        </div>
                        <!-- Diagnosis -->
                        <div class="form-group col-md-5 col-12">
                            <label for="diagnosis">Diagnosis</label>
                            <textarea class="form-control mb-4" id="diagnosis" name="diagnosis" placeholder="Diagnosis" rows="3"></textarea>
                            <div class="invalid-feedback">Please Enter Diagnosis.</div>
                        </div>
                        <!-- Comments -->
                        <div class="form-group col-md-5 col-12 mb-3">
                            <label for="comments">Comments</label>
                            <textarea class="form-control mb-4" id="comments" name="comments" placeholder="Comments" rows="3"></textarea>
                            <div class="invalid-feedback">Please Enter Comments.</div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- CTS -->
                        <div class="form-group col-md-4 col-12">
                            <label for="cts">CTS</label>
                            <select class="form-select" id="cts" name="cts">
                                <option selected disabled value="">Choose...</option>
                                <option Value="Dr S">Dr S</option>
                                <option Value="Dr PB">Dr AKK</option>
                                <option Value="Dr PB">Dr PB</option>
                            </select>
                            <div class="invalid-feedback">Please select a CTS.</div>
                        </div>
                        <!-- Status -->
                        <div class="form-group col-md-4 col-12 mb-3">
                            <label for="status">Status<span class="required text-red">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option selected disabled value="">Choose...</option>
                                <option Value="Surgery Done">Surgery Done</option>
                                <option Value="Awaiting">Awaiting</option>
                                <option Value="Passed Away">Passed Away</option>
                                <option Value="Medical Management">Medical Management</option>
                                <option Value="Not Intrest">Not Intrested</option>
                                <option Value="Not Fit">Not Fit</option>
                                <option Value="Unable To Contact">Unable To Contact</option>
                                <option Value="Patient Decision Pending">Patient Decision Pending</option>
                            </select>
                            <div class="invalid-feedback">Please select a Status.</div>
                        </div>
                    </div>

                    <hr>

                    <div class="text-end col-12">
                        <button type="reset" id="reset" class="btn btn-danger-gradient btn-pill mt-3">Reset</button>
                        <button type="submit" class="btn btn-primary-gradient btn-pill mt-3" id="submitButton">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    document.getElementById('search-button').addEventListener('click', function() {
        var searchTerm = document.getElementById('search-box').value;
        var searchButton = document.getElementById('search-button');
        var originalButtonText = searchButton.textContent;

        // Show loading text or spinner
        searchButton.textContent = 'Searching...';
        searchButton.disabled = true;

        fetch('{{ route("patient.search") }}?search-term=' + encodeURIComponent(searchTerm))
            .then(response => response.json())
            .then(data => {
                var resultContainer = document.getElementById('search-result');
                if (data.message) {
                    resultContainer.textContent = data.message;

                    $("#id").val(0);
                    $("#ctu_number").val('');
                    $("#surgery_id").val('').trigger('change');
                    $("#prefix").val('');
                    $("#full_name").val('');
                    $("#gender").val('');
                    $("#age").val('');
                    $("#contact_number_1").val('');
                    $("#contact_number_2").val('');
                    $("#district").val('').trigger('change');
                    $("#address").val('');
                    $("#ef").val('');
                    $("#diagnosis").val('');
                    $("#comments").val('');
                    $("#cts").val('');
                    $("#status").val('').trigger('change');
                } else {
                    resultContainer.textContent = '';
                }
            })
            .catch(error => {
                console.error('Error:', error.message);
            })
            .finally(() => {
                // Hide loading text or spinner
                searchButton.textContent = originalButtonText;
                searchButton.disabled = false;
            });
    });
</script>

<script>
    function calculateAge(dateOfBirth) {
        var dob = new Date(dateOfBirth);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        return age;
    }

    $('#search-button').click(function() {

        var searchTerm = $('#search-box').val();
        $.ajax({
            url: "{{ route('patient.search') }}",
            method: 'GET',
            data: {
                'search-term': searchTerm
            },
            success: function(response) {
                if (response) {
                    $('#id_patient').val(response.patientID);
                    $('#prefix').val(response.patientPersonalTitle);
                    $('#full_name').val(response.patientName);
                    $('#gender').val(response.patientSex);
                    var age = calculateAge(response.patientDateofbirth);
                    $('#age').val(age);
                    $('#contact_number_1').val(response.patientContactLand01);
                    $('#district').val(response.patientAddressDistrict.charAt(0) + response.patientAddressDistrict.slice(1).toLowerCase()).trigger('change');
                    $('#address').val(response.patientAddressLine01);
                } else {
                    alert('No patient found.');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // show modal on backend validation error
        if (!@json($errors -> isEmpty())) {
            $('#modal_').modal('show');
            var id = $('#id').val();
            if (id == 0) {
                $('#createFormModal').html('Create Cardiothoracic Clinic');
            } else {
                $('#createFormModal').html('Update Cardiothoracic Clinic');
            }
        }

        // create new record
        $('#btn-add').click(function() {
            document.querySelector('#search-form').querySelectorAll('input, button').forEach(function(element) {
                element.disabled = false;
            });

            $("#modal_ form")[0].reset();

            $("#id").val(0);
            $("#ctu_number").val('');
            $("#surgery_id").val('').trigger('change');
            $("#prefix").val('');
            $("#full_name").val('');
            $("#gender").val('');
            $("#age").val('');
            $("#contact_number_1").val('');
            $("#contact_number_2").val('');
            $("#district").val('').trigger('change');
            $("#address").val('');
            $("#ef").val('');
            $("#diagnosis").val('');
            $("#comments").val('');
            $("#cts").val('');
            $("#status").val('').trigger('change');
            $('#createFormModal').html('Create Cardiothoracic Clinic');

            $('p').html('');
            
            $('#modal_').modal('show');
        });

        // edit record
        $('.Cardio-table').on('click', '.edit', function() {
            document.querySelector('#search-form').querySelectorAll('input, button').forEach(function(element) {
                element.disabled = true;
            });
            $("#id").val($(this).attr('data-id'));
            $("#ctu_number").val($(this).attr('data-ctu_number'));
            $("#surgery").val($(this).attr('data-surgery_id')).trigger('change');
            $("#prefix").val($(this).attr('data-prefix'));
            $("#full_name").val($(this).attr('data-full_name'));
            $("#gender").val($(this).attr('data-gender'));
            $("#age").val($(this).attr('data-age'));
            $("#contact_number_1").val($(this).attr('data-contact_number_1'));
            $("#contact_number_2").val($(this).attr('data-contact_number_2'));
            $("#district").val($(this).attr('data-district')).trigger('change');
            $("#address").val($(this).attr('data-address'));
            $("#ef").val($(this).attr('data-ef'));
            $("#diagnosis").val($(this).attr('data-diagnosis'));
            $("#comments").val($(this).attr('data-comments'));
            $("#cts").val($(this).attr('data-cts'));
            $("#status").val($(this).attr('data-status'));
            $('#createFormModal').html('Update Cardiothoracic Clinic');
            $('p').html('');
            $('#modal_').modal('show');
        });
    });
</script>


@endsection