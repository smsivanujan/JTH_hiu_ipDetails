@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <!-- <div>
            <h1 class="page-title">Dashboard</h1>
        </div> -->
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surgery Types</li>
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
                    <h3 class="card-title">Surgery Types</h3>
                </div>
                <div class="col-lg-6 text-end">
                    <button type="button" title="Add" id="btn-add" class="modal-effect btn btn-primary-gradient btn-pill" data-bs-effect="effect-sign" data-bs-toggle="modal" data-bs-target="#modal_"><i class="fe fe-plus me-2"></i>Add</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom Cardio-table" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Surgery Name</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surgeryTypes as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->surgery_name }}</td>
                                <td>{{ $row->detail }}</td>
                                <td>
                                    <a class="btn btn-blue edit" title="Edit" 
                                    data-id="{{ $row->id }}" 
                                    data-surgery_name="{{ $row->surgery_name }}" 
                                    data-surgery_id="{{ $row->detail }}">
                                        <i style="color:rgb(226, 210, 210);cursor: pointer" class="fa fa-edit"></i>
                                    </a>
                                </td>
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
                <h6 class="modal-title" id="createFormModal">Surgery Type</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('surgeryType.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="text" class="form-control" name="id" id="id" hidden>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="surgery_name">Surgery Name <span class="required text-red">*</span></label>
                            <input type="text" class="form-control" id="surgery_name" name="surgery_name" placeholder="Enter Surgery Name" required>
                            <div class="invalid-feedback">Please Enter the Surgery Name.</div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="detail">Detail</label>
                            <textarea class="form-control mb-4" id="detail" name="detail" placeholder="Enter Detail" rows="3"></textarea>
                            <div class="invalid-feedback">Please Enter Detail.</div>
                        </div>
                    </div>
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
    $(document).ready(function() {
        // show modal on backend validation error
        if (!@json($errors -> isEmpty())) {
            $('#modal_').modal('show');
            var id = $('#id').val();
            if (id == 0) {
                $('#createFormModal').html('Create Surgery Type');
            } else {
                $('#createFormModal').html('Update Surgery Type');
            }
        }

        // create new record
        $('#btn-add').click(function() {
            $("#id").val(0);
            $("#surgery_name").val('');
            $("#detail").val('');
            $('#createFormModal').html('Create Surgery Type');
            $('p').html('');
            $('#modal_').modal('show');
        });

        // edit record
        $('.Cardio-table').on('click', '.edit', function() {
            $("#id").val($(this).attr('data-id'));
            $("#surgery_name").val($(this).attr('data-surgery_name'));
            $("#detail").val($(this).attr('data-detail'));
            $("#prefix").val($(this).attr('data-prefix'));
            $('#createFormModal').html('Update Surgery Type');
            $('p').html('');
            $('#modal_').modal('show');
        });
    });
</script>


@endsection