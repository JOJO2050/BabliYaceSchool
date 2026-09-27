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
                            <h4>Ajouter une liaison Classe - Matière - Professeur</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="">
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-md-5 mb-3">
                                        <label>
                                            <b>Classe</b>
                                            <span style="color:red">*</span>
                                        </label>

                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="">Choisir une classe</option>

                                            @foreach ($getClass as $class)
                                                <option value="{{ $class->id }}">
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>
                                            <b>Status</b>
                                        </label>

                                        <select name="status" class="form-control">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>

                                </div>

                                <hr>

                                <h5>Matières et professeurs</h5>

                                <div id="subject_area">
                                    <div class="alert alert-info">
                                        Veuillez sélectionner une classe pour afficher les matières.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">
                                    <b>Enregistrer</b>
                                </button>

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

                        let html = "";

                        if (data.length > 0) {

                            data.forEach(function(subject) {

                                html += `
                                <div class="row mb-3">

                                    <div class="col-md-5">
                                        <label><b>${subject.name}</b></label>
                                        <input type="hidden"
                                               name="subject_id[]"
                                               value="${subject.id}">
                                    </div>

                                    <div class="col-md-5">
                                        <select name="teacher[${subject.id}]"
                                                class="form-control">

                                            <option value="">
                                                -- Aucun professeur --
                                            </option>

                                            @foreach ($getTeacher as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    ${subject.teacher_id == {{ $teacher->id }} ? 'selected' : ''}>
                                                    {{ $teacher->name }} {{ $teacher->last_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                            `;

                            });

                        } else {

                            html = `
                            <div class="alert alert-warning">
                                Aucune matière trouvée pour cette classe.
                            </div>
                        `;

                        }

                        $('#subject_area').html(html);

                    },

                    error: function() {

                        $('#subject_area').html(`
                        <div class="alert alert-danger">
                            Une erreur est survenue lors du chargement des matières.
                        </div>
                    `);

                    }

                });

            } else {

                $('#subject_area').html(`
                <div class="alert alert-info">
                    Veuillez sélectionner une classe.
                </div>
            `);

            }

        });
    </script>

</body>

</html>
