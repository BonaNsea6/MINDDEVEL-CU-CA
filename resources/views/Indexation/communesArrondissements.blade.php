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

                        <ul>
                            @foreach($errors->all() as $error)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <li>{{ $error }}</li>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        </ul>

                        @if(session()->has('successDelete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p>{{ session()->get('successDelete') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-4 float-right">
                            <h5 class="card-title"><strong>Indexation/Communes</strong></h5>
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
                                        <th scope="col" style="text-align:center">Communes d'arrondissement</th>
                                        <th scope="col" style="text-align:center">Annéee N-2</th>
                                        <th scope="col" style="text-align:center">Montant Part Fixe</th>
                                        <th scope="col" style="text-align:center">Montant Part Variable</th>
                                        <th scope="col" style="text-align:center">Total</th>
                                        <th scope="col" style="text-align:center">Reste</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($communes as $commune)
                                @if($commune->cubId === $user->id)
                                    <tr style="text-align:center;">
                                        <td scope="row">{{ $commune->annee }}</td>
                                        <td scope="row">{{ $commune->carUser->name  }}</td>
                                        <td scope="row"></td>
                                        <td scope="row" style="color:green"></td>
                                        <td scope="row" style="color:red"></td>
                                        <td scope="row" style="color:blue"></td>
                                        <td scope="row"></td>
                                    </tr>
                                @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
@endsection
