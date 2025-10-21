@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-0 text-primary" style="border: none; border-radius: 10px;">
                <div class="card-header " style="background-color:rgb(25, 65, 135); color: white; border-radius: 10px 10px 0 0 !important;">
                    <h3 class="mb-0">
                        <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Carte Patients -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid #198754 !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #198754 !important;">
                                                Patients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $patientCount ?? 0 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x" style="color: #198754;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Médecins -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2" style="border-left: 0.25rem solid #198754 !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #198754 !important;">
                                                Médecins</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $medecinCount ?? 0 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-md fa-2x" style="color: #198754;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Rendez-vous -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #198754 !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #198754 !important;">
                                                Rendez-vous</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rdvCount ?? 0 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check fa-2x" style="color: #198754;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Consultations -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 0.25rem solid #198754 !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="color: #198754 !important;">
                                                Consultations</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $consultationCount ?? 0 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-notes-medical fa-2x" style="color: #198754;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Graphique -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4" style="border: none; border-radius: 10px;">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: rgb(25, 65, 135); color: white; border-radius: 10px 10px 0 0 !important;">
                                    <h6 class="m-0 font-weight-bold">Activité récente</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                       <canvas id="rdvChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Derniers patients -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4" style="border: none; border-radius: 10px;">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: rgb(25, 65, 135); color: white; border-radius: 10px 10px 0 0 !important;">
                                    <h6 class="m-0 font-weight-bold">Derniers patients</h6>
                                </div>
                                <div class="card-body">
                                    @foreach($recentPatients ?? [] as $patient)
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle me-2" width="40" height="40"
                                                src="https://ui-avatars.com/api/?name={{ isset($patient) && is_object($patient) ? urlencode($patient->nom) . '+' . urlencode($patient->prenom) : '' }}&background=random">
                                            <div>
                                                <div class="font-weight-bold">{{ $patient->prenom }} {{ $patient->nom }}</div>
                                                <div class="small text-gray-500">{{ $patient->created_at->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const rdvData = @json($rdvChartData);

    const ctx = document.getElementById('rdvChart').getContext('2d');
    const rdvChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ],
            datasets: [{
                label: 'Rendez-vous par mois',
                data: rdvData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
@endpush