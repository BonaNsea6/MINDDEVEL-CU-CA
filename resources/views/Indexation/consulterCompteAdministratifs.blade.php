@extends('layouts.app1')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p class="bi bi-check-circle me-1">{{ session('success') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session()->has('successError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p>{{ session()->get('successError') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <li>{{ $error }}</li>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endforeach
                            </ul>
                        @endif

                        @if(session()->has('successDelete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p>{{ session()->get('successDelete') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-4 float-right">
                            <h5 class="card-title"><strong>Indexation/Consulter les comptes administratifs des communes d'arrondissement</strong></h5>
                            <!-- <a href="" data-bs-toggle="modal" data-bs-target="#config"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Configurer </h5></strong></a> -->
                            <a href=""><strong><h5 class="btn btn-danger">Fermer</h5></strong></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <table class="table table-bordered table-borderless datatable">
                                <thead style="color:white;">
                                    <tr style="background-color:gray;">
                                        <th scope="col" style="text-align:center">N°</th>
                                        <th scope="col" style="text-align:center">Année N-2</th>
                                        <th scope="col" style="text-align:center">Communes d'arrondissement</th>
                                        <th scope="col" style="text-align:center">Fichier PDF</th>
                                        <th scope="col" style="text-align:center">Fichier Excel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($netPercevoirData as $index => $commune)
                                        <tr style="text-align:center;">
                                            <td scope="row">{{ $index + 1 }}</td>
                                            <td scope="row">{{ $commune->annee }}</td>
                                            <td scope="row">{{ $commune->commune_name }}</td>
                                            <td scope="row" style="color:green">
                                                <a href="{{ route('commune.Indexations.rapportPdf', ['commune' => $commune->userId, 'annee' => $commune->annee]) }}" class="btn btn-warning">
                                                    Ouvrir PDF
                                                </a>
                                            </td>
                                            <td scope="row" style="color:red">
                                                <a href="{{ route('commune.Indexations.rapportExcel', ['commune'=> $commune->userId, 'annee'=> $commune->annee]) }}" class="btn btn-warning">Ouvrir Excel</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
