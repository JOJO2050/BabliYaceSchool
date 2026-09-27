<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : '' }} - BabliYaceSchoolDashboard</title>

    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">
</head>

<body>

    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main-panel">

            <div class="main-header">
                @include('layouts.header')
            </div>

            <div class="container">
                <div class="page-inner">

                    @include('_message')

                    <div class="card p-4 my-4">

                        <div class="card-header">
                            <h4>Modifier la liaison Classe - Matière - Professeur</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="">
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>
                                            <b>Classe</b>
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="class_id" id="class_id" class="form-control">

                                            @foreach ($getClass as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ $getRecord->class_id == $class->id ? 'selected' : '' }}>

                                                    {{ $class->name }}

                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>
                                            <b>Status</b>
                                        </label>

                                        <select name="status" class="form-control">

                                            <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>
                                                Inactive
                                            </option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>
                                            <b>Matière</b>
                                        </label>

                                        <select name="subject_id" id="subject_id" class="form-control">

                                            @foreach ($getSubjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ $getRecord->subject_id == $subject->id ? 'selected' : '' }}>

                                                    {{ $subject->name }}

                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>
                                            <b>Professeur</b>
                                        </label>

                                        <select name="teacher_id" class="form-control">

                                            @foreach ($getTeacher as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    {{ $getRecord->teacher_id == $teacher->id ? 'selected' : '' }}>

                                                    {{ $teacher->name }}
                                                    {{ $teacher->last_name }}

                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">

                                    <b>Mettre à jour</b>

                                </button>

                                <a href="{{ url('admin/assign_class_subject_teacher/list') }}"
                                    class="btn btn-secondary">

                                    Retour

                                </a>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

            @include('layouts.footer')

        </div>

    </div>

    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>

    <script>
        $('#class_id').change(function() {

                    let class_id = $(this).val();

                    if (class_id != '') {

                        $.ajax({

                                url: "{{ url('admin/assign_class_subject_teacher/get_subjects') }}/" + class_id,
                                type: "GET",

                                success: function(data) {

                                    let option = "";

                                    if (data.length > 0) {

                                        data.forEach(function(subject) {

                                            option += '<option value="' + subject.id + '">' + subject.name +
                                                '</option>';

                                        });

                                    } else {

                                        option =
                                            '<option value="">Veuillez lier une ou plusieurs matières à cette classe</option>';

                                    }

                                    $('#subject_id').html(option);

                                }


                            }
                            else {

                                $('#subject_id').html('<option value="">Veuillez choisir une classe</option>');

                            }

                        });
    </script>


</body>

</html>
