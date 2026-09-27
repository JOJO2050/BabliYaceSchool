<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : '' }}-BabliYaceSchoolDashboard</title>
    <meta content="width=device-width,initial-scale=1.0,shrink-to-fit=no" name="viewport" />

    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon" />

    <script src="{{ asset('assets1/js/plugin/webfont/webfont.min.js') }}"></script>

    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets1/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">

    <style>
        .payment-page-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .student-header {
            background: linear-gradient(135deg, #198754, #20c997);
            color: white;
            padding: 30px;
        }

        .student-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .info-card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .06);
        }

        .amount-card {
            border: 0;
            border-radius: 14px;
            min-height: 135px;
        }

        .payment-input {
            border-radius: 10px;
            padding: 12px 15px;
        }

        .payment-button {
            border-radius: 10px;
            padding: 12px 25px;
        }

        .reference-box {
            background: #f1f8f5;
            border: 1px solid #b7dfc8;
            border-radius: 10px;
            padding: 12px 15px;
            color: #198754;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main-panel">

            <div class="main-header">

                <div class="main-header-logo">

                    <div class="logo-header" data-background-color="dark">

                        <a href="index.html" class="logo">
                            <img src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>

                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>

                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>

                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>

                    </div>

                </div>

                @include('layouts.header')

            </div>

            <div class="container">

                <div class="page-inner">

                    <div class="d-flex align-items-center justify-content-between pt-2 pb-4">

                        <div>

                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;">
                                Espace Administrateur
                            </h3>

                        </div>

                        <div>

                            <a href="{{ url('admin/fees_collection/collect_fees/add_fees/' . $student->id) }}"
                                class="btn btn-secondary btn-round">

                                <i class="fas fa-arrow-left me-1"></i>

                                Retour

                            </a>

                        </div>

                    </div>

                    @include('_message')

                    <div class="card payment-page-card">

                        <div class="student-header">

                            <div class="d-flex align-items-center">

                                <div class="student-avatar me-4">
                                    <i class="fas fa-user-graduate"></i>
                                </div>

                                <div>

                                    <h3 class="mb-1">
                                        {{ $student->name }}
                                        {{ $student->last_name }}
                                    </h3>

                                    <div class="mt-2">

                                        <span class="badge bg-light text-success me-2">
                                            @#MAJ#{{ $student->id }}
                                        </span>

                                        <span class="badge bg-dark">
                                            {{ $student->class_name }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-body p-4">

                            <div class="row g-4 mb-4">

                                <div class="col-md-4">

                                    <div class="card amount-card shadow-sm" style="border-left:5px solid #0d6efd;">

                                        <div class="card-body">

                                            <small class="text-muted">
                                                Scolarité totale
                                            </small>

                                            <h3 class="text-primary mt-3 mb-0">

                                                {{ number_format($totalAmount) }}

                                                <small style="font-size:14px;">
                                                    FCFA
                                                </small>

                                            </h3>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="card amount-card shadow-sm" style="border-left:5px solid #198754;">

                                        <div class="card-body">

                                            <small class="text-muted">
                                                Total payé hors ce versement
                                            </small>

                                            <h3 class="text-success mt-3 mb-0">

                                                {{ number_format($totalPaidWithoutCurrent) }}

                                                <small style="font-size:14px;">
                                                    FCFA
                                                </small>

                                            </h3>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="card amount-card shadow-sm" style="border-left:5px solid #dc3545;">

                                        <div class="card-body">

                                            <small class="text-muted">
                                                Maximum pour ce versement
                                            </small>

                                            <h3 class="text-danger mt-3 mb-0">

                                                <span id="maximum_amount">
                                                    {{ number_format($maximumAmount) }}
                                                </span>

                                                <small style="font-size:14px;">
                                                    FCFA
                                                </small>

                                            </h3>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card border-0 shadow-sm" style="border-radius:14px;">

                                <div class="card-header bg-white border-0 pt-4 px-4">

                                    <h5 class="mb-0">

                                        <i class="fas fa-edit text-success me-2"></i>

                                        Modifier le versement

                                    </h5>

                                </div>

                                <div class="card-body p-4">

                                    <form method="POST"
                                        action="{{ url('admin/fees_collection/collect_fees/edit_fees/' . $payment->id) }}"
                                        id="editPaymentForm">

                                        @csrf

                                        <input type="hidden" name="student_id" value="{{ $student->id }}">

                                        <input type="hidden" name="class_id" value="{{ $payment->class_id }}">

                                        <div class="row g-3">

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Élève
                                                </label>

                                                <input type="text" class="form-control form-control-lg payment-input"
                                                    value="{{ $student->name }} {{ $student->last_name }}" readonly>

                                            </div>

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Référence
                                                </label>

                                                <input type="text" class="form-control form-control-lg reference-box"
                                                    value="{{ $payment->ref_payement }}" readonly>

                                            </div>

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Montant du versement
                                                </label>

                                                <div class="input-group input-group-lg">

                                                    <input type="number" class="form-control payment-input"
                                                        name="amount" id="payment_amount"
                                                        value="{{ $payment->paid_amount }}" min="1"
                                                        max="{{ $maximumAmount }}" step="1" required>

                                                    <span class="input-group-text">
                                                        FCFA
                                                    </span>

                                                </div>

                                                <small class="text-muted">
                                                    Maximum autorisé :
                                                    {{ number_format($maximumAmount) }}
                                                    FCFA
                                                </small>

                                            </div>

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Date du versement
                                                </label>

                                                <input type="date"
                                                    class="form-control form-control-lg payment-input"
                                                    name="payment_date"
                                                    value="{{ \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') }}"
                                                    required>

                                            </div>

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Mode de paiement
                                                </label>

                                                <select class="form-control form-control-lg payment-input"
                                                    name="payment_method" required>

                                                    <option value="">
                                                        Sélectionner
                                                    </option>

                                                    <option value="especes"
                                                        {{ $payment->payment_type == 'especes' ? 'selected' : '' }}>
                                                        Espèces
                                                    </option>

                                                    <option value="mobile_money"
                                                        {{ $payment->payment_type == 'mobile_money' ? 'selected' : '' }}>
                                                        Mobile Money
                                                    </option>

                                                    <option value="virement"
                                                        {{ $payment->payment_type == 'virement' ? 'selected' : '' }}>
                                                        Virement bancaire
                                                    </option>

                                                    <option value="cheque"
                                                        {{ $payment->payment_type == 'cheque' ? 'selected' : '' }}>
                                                        Chèque
                                                    </option>

                                                </select>

                                            </div>

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Observation
                                                </label>

                                                <input type="text"
                                                    class="form-control form-control-lg payment-input"
                                                    name="observation" value="{{ $payment->observation }}"
                                                    placeholder="Observation">

                                            </div>

                                            <div class="col-md-12">

                                                <div class="alert alert-info mb-0">

                                                    <i class="fas fa-info-circle me-2"></i>

                                                    Après modification, le système recalculera automatiquement le total
                                                    payé et le reste à payer de l'élève.

                                                </div>

                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end gap-2 mt-4">

                                            <a href="{{ url('admin/fees_collection/collect_fees/add_fees/' . $student->id) }}"
                                                class="btn btn-light border px-4">

                                                <i class="fas fa-times me-1"></i>

                                                Annuler

                                            </a>

                                            <button type="submit" class="btn btn-success px-4" id="updatePayment">

                                                <i class="fas fa-check-circle me-1"></i>

                                                Enregistrer les modifications

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @include('layouts.footer')

        </div>

    </div>

    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets1/js/kaiadmin.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            var maximum = Number("{{ $maximumAmount }}");

            $('#payment_amount').on('input', function() {

                var amount = Number($(this).val()) || 0;

                if (amount < 0) {
                    amount = 0;
                }

                if (amount > maximum) {
                    amount = maximum;
                    $(this).val(amount);
                }

            });

            $('#editPaymentForm').on('submit', function(e) {

                var amount = Number($('#payment_amount').val()) || 0;

                if (amount <= 0) {

                    e.preventDefault();

                    alert('Veuillez saisir un montant valide.');

                    return;
                }

                if (amount > maximum) {

                    e.preventDefault();

                    alert('Le montant dépasse le maximum autorisé.');

                    return;
                }

                $('#updatePayment')
                    .prop('disabled', true)
                    .html(
                        '<i class="fas fa-spinner fa-spin me-1"></i>Modification...'
                    );

            });

        });
    </script>

</body>

</html>
