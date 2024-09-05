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
                            <h5 class="card-title"><strong>Indexation/Informations sur vos Communes d'arrondissements</strong></h5>
                            <a href=""><strong><h5 class="btn btn-danger">Fermer</h5></strong></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2" id="borderedTabContent">

                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Vos Communes</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Net à percevoir</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabContent">
                                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                        <table class="table table-bordered table-borderless ">
                                            <thead>
                                            </thead>
                                            <tbody>
                        
                                                <ul class="list-group">
                                                    @foreach($communeArr as $commune)
                                                        <li class="list-group-item" style="background-color:green;"> <i style="color:white"> {{ $commune->name }}</i> </li>
                                                     @endforeach
                                                </ul><!-- End Default List group -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

                                    <table class="table table-bordered table-borderless datatable">
                                    <thead style="color:white;">
                                        <tr style="background-color:gray;">
                                            <th scope="col" style="text-align:center">N°</th>
                                            <th scope="col" style="text-align:center">Annéee N-2</th>
                                            <th scope="col" style="text-align:center">Communes d'arrondissement</th>                   
                                            <th scope="col" style="text-align:center">Montant Part Fixe</th>
                                            <th scope="col" style="text-align:center">Montant Part Variable</th>
                                            <th scope="col" style="text-align:center">Total</th>
                                            <th scope="col" style="text-align:center">Reste</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($netPercevoirData as $commune)
                                        <tr style="text-align:center;">
                                            <td scope="row"></td>
                                            <td scope="row">{{ $commune->annee }}</td>
                                            <td scope="row">{{ $commune->commune_name }}</td>
                                            <td scope="row" style="color:green">{{ $commune->partFixe }} XAF</td>
                                            <td scope="row" style="color:red">{{ $commune->partVariable }} XAF</td>
                                            <td scope="row" style="color:blue">{{ $commune->total }} XAF</td>
                                            <td scope="row"></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>            
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
@endsection
