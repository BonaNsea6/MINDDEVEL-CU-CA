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
                            <h5 class="card-title"><strong>Indexation/Configurations</strong></h5>
                            <a href="" data-bs-toggle="modal" data-bs-target="#config"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Configurer </h5></strong></a>
                            <a href=""><strong><h5 class="btn btn-danger">Fermer</h5></strong></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="modal fade" id="config" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFormLabel">Configurer les déleais de soumissions des comptes administratifs pour  de l'année {{$anneeN2}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="row g-12" method="post" action="{{ route('commune.Indexations.configurerDelaie') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Place ici ton formulaire -->
                                        <iframe id="pdfPreview" style="width:100%;height:500px;display:none;"></iframe>

                                        <div class="mb-3">
                                            <label for="excel_file" class="form-label">choisir une Date limite de soumission <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="excel_file" name="delaie"  required>
                                        </div>
                                        <iframe id="excelPreview" style="width:100%;height:500px;display:none;"></iframe>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button class="btn btn-primary" type="submit">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
