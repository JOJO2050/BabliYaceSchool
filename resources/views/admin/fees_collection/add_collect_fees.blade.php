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
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
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
            overflow: hidden
        }

        .student-header {
            background: linear-gradient(135deg, #198754, #20c997);
            color: white;
            padding: 30px
        }

        .student-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px
        }

        .info-card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .06)
        }

        .amount-card {
            border: 0;
            border-radius: 14px;
            min-height: 135px
        }

        .payment-input {
            border-radius: 10px;
            padding: 12px 15px
        }

        .payment-button {
            border-radius: 10px;
            padding: 12px 25px
        }

        .modal-content {
            border-radius: 18px;
            overflow: hidden
        }

        .modal-header-payment {
            background: linear-gradient(135deg, #198754, #20c997);
            color: white;
            padding: 22px 25px;
            border: 0
        }

        .reference-box {
            background: #f1f8f5;
            border: 1px solid #b7dfc8;
            border-radius: 10px;
            padding: 12px 15px;
            color: #198754;
            font-weight: 700
        }

        .receipt {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .12);
            overflow: hidden
        }

        .receipt-header {
            background: linear-gradient(135deg, #198754, #20c997);
            color: #fff;
            padding: 30px
        }

        .receipt-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 700
        }

        .receipt-value {
            font-weight: 600;
            color: #212529
        }
    </style>
    <style>
        .receipt {
            background: #fff;
            border: 0;
            border-radius: 0;
            box-shadow: 0 15px 50px rgba(0, 0, 0, .18);
            overflow: hidden
        }

        .receipt-header {
            background: linear-gradient(135deg, #087f5b, #20c997);
            color: #fff;
            padding: 30px 25px;
            position: relative
        }

        .receipt-header:after {
            content: "";
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 35px;
            background: #fff;
            border-radius: 50% 50% 0 0
        }

        .receipt-logo {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
            padding: 5px;
            border: 3px solid rgba(255, 255, 255, .6);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .15)
        }

        .receipt-school {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: .5px
        }

        .receipt-title {
            font-size: 14px;
            letter-spacing: 2px;
            font-weight: 600;
            opacity: .9
        }

        .receipt-reference {
            display: inline-block;
            background: #fff;
            color: #087f5b;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 800;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .12)
        }

        .receipt-body {
            padding: 35px 30px 25px
        }

        .receipt-student {
            background: #f5faf8;
            border: 1px solid #d9eee6;
            border-radius: 14px;
            padding: 18px
        }

        .receipt-student-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #d1e7dd;
            color: #087f5b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px
        }

        .receipt-label {
            font-size: 10px;
            color: #8a9299;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: .7px;
            margin-bottom: 4px
        }

        .receipt-value {
            font-size: 14px;
            font-weight: 700;
            color: #212529
        }

        .receipt-amount-box {
            background: linear-gradient(135deg, #e8f7f1, #f5fffb);
            border: 1px solid #ccebdd;
            border-radius: 15px;
            padding: 20px;
            text-align: center
        }

        .receipt-amount-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #6c757d;
            font-weight: 800;
            letter-spacing: 1px
        }

        .receipt-amount {
            font-size: 28px;
            font-weight: 900;
            color: #087f5b;
            margin-top: 5px
        }

        .receipt-detail {
            padding: 13px 0;
            border-bottom: 1px dashed #dee2e6
        }

        .receipt-detail:last-child {
            border-bottom: 0
        }

        .receipt-detail-value {
            font-weight: 700;
            color: #343a40
        }

        .receipt-footer {
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 18px 25px;
            text-align: center
        }

        .receipt-footer-text {
            font-size: 12px;
            color: #6c757d
        }

        .receipt-paid {
            color: #198754 !important
        }

        .receipt-remaining {
            color: #dc3545 !important
        }

        .receipt-modal .modal-dialog {
            max-width: 520px
        }

        .receipt-modal .modal-content {
            border: 0
        }

        @media print {
            body * {
                visibility: hidden !important
            }

            .receipt,
            .receipt * {
                visibility: visible !important
            }

            .receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none !important;
                border: 0 !important
            }

            .receipt-modal .modal-dialog {
                max-width: 100% !important;
                margin: 0 !important
            }

            .receipt-modal .modal-footer {
                display: none !important
            }
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
                            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                        </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>
                @include('layouts.header')
            </div>
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-center justify-content-between pt-2 pb-4">
                        <div>
                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;">Espace Administrateur</h3>
                        </div>
                        <div>
                            <a href="{{ $return_url ?? url('admin/fees_collection/collect_fees') }}"
                                class="btn btn-secondary btn-round">
                                <i class="fas fa-arrow-left me-1"></i>Retour sur Scolarité global
                            </a>

                        </div>
                    </div>
                    @include('_message')
                    @if (!empty($getRecord))
                        <div class="card payment-page-card">
                            <div class="student-header">
                                <div class="d-flex align-items-center">
                                    <div class="student-avatar me-4"><i class="fas fa-user-graduate"></i></div>
                                    <div>
                                        <h3 class="mb-1">{{ $getRecord->name }} {{ $getRecord->last_name }}</h3>
                                        <div class="mt-2">
                                            <span
                                                class="badge bg-light text-success me-2">@#MAJ#{{ $getRecord->id }}</span>
                                            <span class="badge bg-dark">{{ $getRecord->class_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <div class="card info-card h-100">
                                            <div class="card-body">
                                                <small class="text-muted">Matricule</small>
                                                <h5 class="mt-2 mb-0">@#MAJ#{{ $getRecord->id }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card info-card h-100">
                                            <div class="card-body">
                                                <small class="text-muted">Élève</small>
                                                <h5 class="mt-2 mb-0">{{ $getRecord->name }}
                                                    {{ $getRecord->last_name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card info-card h-100">
                                            <div class="card-body">
                                                <small class="text-muted">Classe</small>
                                                <h5 class="mt-2 mb-0">{{ $getRecord->class_name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card info-card h-100">
                                            <div class="card-body">
                                                <small class="text-muted">Année scolaire</small>
                                                <h5 class="mt-2 mb-0">{{ date('Y') }}-{{ date('Y') + 1 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <div class="card amount-card shadow-sm" style="border-left:5px solid #0d6efd;">
                                            <div class="card-body">
                                                <small class="text-muted">Scolarité totale</small>
                                                <h3 class="text-primary mt-3 mb-0">
                                                    {{ number_format($getRecord->amount) }} <small
                                                        style="font-size:14px;">FCFA</small></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card amount-card shadow-sm" style="border-left:5px solid #198754;">
                                            <div class="card-body">
                                                <small class="text-muted">Scolarité déjà payée</small>
                                                <h3 class="text-success mt-3 mb-0"><span
                                                        id="paid_amount">{{ number_format($paidAmount ?? 0) }}</span>
                                                    <small style="font-size:14px;">FCFA</small>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card amount-card shadow-sm" style="border-left:5px solid #dc3545;">
                                            <div class="card-body">
                                                <small class="text-muted">Reste à payer</small>
                                                <h3 class="text-danger mt-3 mb-0"><span
                                                        id="remaining_amount">{{ number_format($remainingAmount ?? $getRecord->amount) }}</span>
                                                    <small style="font-size:14px;">FCFA</small>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-success btn-lg payment-button"
                                        data-bs-toggle="modal" data-bs-target="#paymentModal">
                                        <i class="fas fa-money-bill-wave me-2"></i>Faire un versement
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if (isset($payments) && count($payments) > 0)
                            <div class="card border-0 shadow-sm mt-4">
                                <div class="card-header bg-white border-0">
                                    <h5 class="mb-0"><i class="fas fa-history text-success me-2"></i>Historique des
                                        versements</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Référence</th>
                                                    <th>Date</th>
                                                    <th>Montant payé</th>
                                                    <th>Mode</th>
                                                    <th>Reste</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payments as $payment)
                                                    <tr>
                                                        <td><span
                                                                class="badge bg-success">{{ $payment->ref_payement }}</span>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($payment->payment_date ?? $payment->created_at)->format('d/m/Y') }}
                                                        </td>
                                                        <td class="text-success fw-bold">
                                                            {{ number_format($payment->paid_amount) }} FCFA</td>
                                                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_type)) }}
                                                        </td>
                                                        <td class="text-danger fw-bold">
                                                            {{ number_format($payment->remaning_amount) }} FCFA</td>
                                                        <td>
                                                            <a href="{{ url('admin/fees_collection/collect_fees/edit_fees/' . $payment->id) }}"
                                                                class="btn btn-sm btn-outline-primary"
                                                                title="Modifier">

                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-success"
                                                                onclick="showReceipt('{{ $payment->id }}')">
                                                                <i class="fas fa-receipt"></i> Reçu
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-danger">Élève introuvable.</div>
                    @endif
                </div>
            </div>
            @if (!empty($getRecord))
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header-payment">
                                <div>
                                    <h5 class="modal-title mb-1" id="paymentModalLabel"><i
                                            class="fas fa-money-bill-wave me-2"></i>Versement de scolarité</h5>
                                    <small>Enregistrement d'un paiement scolaire</small>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Fermer"></button>
                            </div>
                            <form method="POST"
                                action="{{ url('admin/fees_collection/collect_fees/add_fees/' . $getRecord->id) }}"
                                id="paymentForm">
                                @csrf
                                <div class="modal-body" style="background:#f8faf9;padding:25px;">
                                    <div class="card border-0 shadow-sm mb-4" style="border-radius:14px;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width:55px;height:55px;background:#d1e7dd;color:#198754;"><i
                                                        class="fas fa-user-graduate fa-lg"></i></div>
                                                <div>
                                                    <h5 class="mb-1">{{ $getRecord->name }}
                                                        {{ $getRecord->last_name }}</h5>
                                                    <span class="badge bg-success">@#MAJ#{{ $getRecord->id }}</span>
                                                    <span
                                                        class="badge bg-secondary">{{ $getRecord->class_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm h-100"
                                                style="border-radius:14px;border-left:5px solid #0d6efd!important;">
                                                <div class="card-body">
                                                    <small class="text-muted">Scolarité totale</small>
                                                    <h4 class="mt-2 mb-0 text-primary">
                                                        {{ number_format($getRecord->amount) }} <small>FCFA</small>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm h-100"
                                                style="border-radius:14px;border-left:5px solid #198754!important;">
                                                <div class="card-body">
                                                    <small class="text-muted">Déjà payé</small>
                                                    <h4 class="mt-2 mb-0 text-success"><span
                                                            id="modal_paid_amount">{{ number_format($paidAmount ?? 0) }}</span>
                                                        <small>FCFA</small>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm h-100"
                                                style="border-radius:14px;border-left:5px solid #dc3545!important;">
                                                <div class="card-body">
                                                    <small class="text-muted">Reste à payer</small>
                                                    <h4 class="mt-2 mb-0 text-danger"><span
                                                            id="modal_remaining_amount">{{ number_format($remainingAmount ?? $getRecord->amount) }}</span>
                                                        <small>FCFA</small>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-0 shadow-sm" style="border-radius:14px;">
                                        <div class="card-header bg-white border-0 pt-4 px-4">
                                            <h5 class="mb-0"><i
                                                    class="fas fa-hand-holding-usd text-success me-2"></i>Informations
                                                du versement</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <input type="hidden" name="student_id" value="{{ $getRecord->id }}">
                                            <input type="hidden" name="class_id"
                                                value="{{ $getRecord->class_id }}">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Montant du versement</label>
                                                    <div class="input-group input-group-lg">
                                                        <input type="number" class="form-control payment-input"
                                                            name="amount" id="payment_amount" min="1"
                                                            max="{{ $remainingAmount ?? $getRecord->amount }}"
                                                            step="1" placeholder="Ex : 100000" required>
                                                        <span class="input-group-text">FCFA</span>
                                                    </div>
                                                    <small class="text-muted">Montant remis par l'élève.</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Date du versement</label>
                                                    <input type="date"
                                                        class="form-control form-control-lg payment-input"
                                                        name="payment_date" id="payment_date"
                                                        value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Mode de paiement</label>
                                                    <select class="form-control form-control-lg payment-input"
                                                        name="payment_method" id="payment_method" required>
                                                        <option value="">Sélectionner</option>
                                                        <option value="especes">Espèces</option>
                                                        <option value="mobile_money">Mobile Money</option>
                                                        <option value="virement">Virement bancaire</option>
                                                        <option value="cheque">Chèque</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Référence du paiement</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg payment-input reference-box"
                                                        value="Générée automatiquement après validation" readonly>
                                                    <small class="text-success">
                                                        La référence est générée automatiquement par le système.
                                                    </small>
                                                </div>


                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">Observation</label>
                                                    <textarea class="form-control payment-input" name="observation" id="payment_observation" rows="3"
                                                        placeholder="Observation concernant ce versement..."></textarea>
                                                </div>
                                            </div>
                                            <div class="alert alert-info mt-4 mb-0 d-flex align-items-center"
                                                style="border-radius:10px;">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <div>Le versement sera enregistré au nom de
                                                    <strong>{{ $getRecord->name }}
                                                        {{ $getRecord->last_name }}</strong> avec le matricule
                                                    <strong>@#MAJ#{{ $getRecord->id }}</strong>.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-white border-0 px-4 py-3">
                                    <button type="button" class="btn btn-light border px-4"
                                        data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Annuler</button>
                                    <button type="submit" class="btn btn-success px-4" id="savePayment"><i
                                            class="fas fa-check-circle me-1"></i>Enregistrer le versement</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @include('layouts.footer')
        </div>
    </div>
    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets1/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets1/js/setting-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            var total = Number("{{ $getRecord->amount ?? 0 }}");
            var paid = Number("{{ $paidAmount ?? 0 }}");
            var remaining = Number("{{ $remainingAmount ?? ($getRecord->amount ?? 0) }}");

            $('#payment_amount').on('input', function() {
                var amount = Number($(this).val()) || 0;

                if (amount < 0) {
                    amount = 0;
                }

                if (amount > remaining) {
                    amount = remaining;
                    $(this).val(amount);
                }

                var newRemaining = remaining - amount;

                $('#modal_remaining_amount').text(
                    new Intl.NumberFormat('fr-FR').format(newRemaining)
                );
            });

            $('#paymentForm').on('submit', function(e) {
                var amount = Number($('#payment_amount').val()) || 0;
                var method = $('#payment_method').val();

                if (amount <= 0) {
                    e.preventDefault();
                    alert('Veuillez saisir un montant valide.');
                    return;
                }

                if (amount > remaining) {
                    e.preventDefault();
                    alert('Le montant ne peut pas dépasser le reste à payer.');
                    return;
                }

                if (!method) {
                    e.preventDefault();
                    alert('Veuillez sélectionner le mode de paiement.');
                    return;
                }

                $('#savePayment')
                    .prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin me-1"></i>Enregistrement...');
            });
        });

        function showReceipt(id) {
            var modal = document.getElementById('receiptModal' + id);
            if (modal) {
                var instance = new bootstrap.Modal(modal);
                instance.show();
            }
        }

        function printReceipt(id) {
            var receipt = document.querySelector('#receiptModal' + id + ' .receipt');
            if (!receipt) return;
            var original = document.body.innerHTML;
            document.body.innerHTML = receipt.outerHTML;
            window.print();
            document.body.innerHTML = original;
            window.location.reload();
        }
    </script>

    @if (isset($payments) && count($payments) > 0)
        @foreach ($payments as $payment)
            <div class="modal fade receipt-modal" id="receiptModal{{ $payment->id }}" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content receipt">
                        <div class="receipt-header text-center">
                            <img src="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" class="receipt-logo"
                                alt="Logo">
                            <div class="receipt-school mt-3">BabliYace School</div>
                            <div class="receipt-title mt-1">ÉTABLISSEMENT SCOLAIRE</div>
                            <div class="mt-4">
                                <span class="receipt-reference">{{ $payment->ref_payement }}</span>
                            </div>
                        </div>
                        <div class="receipt-body">
                            <div class="receipt-student mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="receipt-student-icon me-3">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div>
                                        <div class="receipt-label">Élève</div>
                                        <div class="receipt-value">{{ $getRecord->name }} {{ $getRecord->last_name }}
                                        </div>
                                        <div class="mt-1">
                                            <span class="badge bg-success">@#MAJ#{{ $getRecord->id }}</span>
                                            <span class="badge bg-secondary">{{ $getRecord->class_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="receipt-amount-box mb-4">
                                <div class="receipt-amount-label">Montant du versement</div>
                                <div class="receipt-amount">{{ number_format($payment->paid_amount, 0, ',', ' ') }}
                                    FCFA
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="receipt-detail">
                                        <div class="receipt-label">Scolarité totale</div>
                                        <div class="receipt-detail-value">
                                            {{ number_format($payment->total_amount, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="receipt-detail">
                                        <div class="receipt-label">Reste à payer</div>
                                        <div class="receipt-detail-value receipt-remaining">
                                            {{ number_format($payment->remaning_amount, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="receipt-detail">
                                        <div class="receipt-label">Date du versement</div>
                                        <div class="receipt-detail-value">
                                            {{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="receipt-detail">
                                        <div class="receipt-label">Mode de paiement</div>
                                        <div class="receipt-detail-value">
                                            {{ ucfirst(str_replace('_', ' ', $payment->payment_type)) }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="receipt-detail">
                                        <div class="receipt-label">Référence du paiement</div>
                                        <div class="receipt-detail-value receipt-paid">{{ $payment->ref_payement }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="receipt-detail">
                                        <div class="receipt-label">Observation</div>
                                        <div class="receipt-detail-value">
                                            {{ $payment->observation ?: 'Aucune observation' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="receipt-footer">
                            <div class="receipt-footer-text mb-2">
                                <i class="fas fa-check-circle text-success me-1"></i>
                                Paiement enregistré avec succès
                            </div>
                            <div class="receipt-footer-text">
                                Merci pour votre règlement et votre confiance.
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">BabliYace School • Reçu officiel</small>
                            </div>
                        </div>
                        <div class="modal-footer bg-white border-0 justify-content-center">
                            <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Fermer
                            </button>
                            <button type="button" class="btn btn-success px-4"
                                onclick="printReceipt('{{ $payment->id }}')">
                                <i class="fas fa-print me-1"></i>Imprimer le reçu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</body>

</html>
