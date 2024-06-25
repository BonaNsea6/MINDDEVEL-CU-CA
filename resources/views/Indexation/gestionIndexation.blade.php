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
                            <h5 class="card-title"><strong>Indexation/Calcul</strong></h5>
                            <a href="" data-bs-toggle="modal" data-bs-target="#soumettreCompte"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Sommettre vos comptes administratifs </h5></strong></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#renseigner"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Renseigner Les informations </h5></strong></a>
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
                                        <th scope="col" style="text-align:center">CUB</th>
                                        <th scope="col" style="text-align:center">Annéee N-2</th>
                                        <th scope="col" style="text-align:center">PIC</th>
                                        <th scope="col" style="text-align:center">PCAC</th>
                                        <th scope="col" style="text-align:center">PTC</th>
                                        <th scope="col" style="text-align:center">RDPC</th>
                                        <th scope="col" style="text-align:center">RDPC</th>
                                        <th scope="col" style="text-align:center">RTPS</th>
                                        <th scope="col" style="text-align:center">TOTAL</th>
                                        <th scope="col" style="text-align:center">Montant à verser</th>
                                        <th scope="col" style="text-align:center">Reste</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($recettes as $recette)
                                    <tr style="text-align:center;">
                                        <td scope="row">{{ $recette->id }}</td>
                                        <td scope="row">{{ $recette->userId}}</td>
                                        <td scope="row">{{ $recette->annee }}</td>
                                        <td scope="row">{{ number_format($recette->pic, 0, ',', '.') }}</td>
                                        <td scope="row">{{ number_format($recette->pcac, 0, ',', '.') }}</td>
                                        <td scope="row">{{ number_format($recette->ptc, 0, ',', '.') }}</td>
                                        <td scope="row">{{ number_format($recette->rdpc, 0, ',', '.') }}</td>
                                        <td scope="row">{{ number_format($recette->rdp, 0, ',', '.') }}</td>
                                        <td scope="row">{{ number_format($recette->rtps, 0, ',', '.') }}</td>
                                        <td scope="row" style="color:green">{{ number_format($recette->Total, 0, ',', '.') }}</td>
                                        <td scope="row" style="color:red">{{ number_format($recette->tauxApplique, 0, ',', '.') }}</td>
                                        <td scope="row" style="color:blue">{{ number_format($recette->resteCUB, 0, ',', '.') }}</td>
                                        <td scope="row"></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>



                             <!-- Modal -->
                    <div class="modal fade" id="soumettreCompte" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFormLabel">Soumettre les comptes administratifs de l'année {{$anneeN2}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="row g-12" method="post" action="{{ route('admin.Indexations.soumettre') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Place ici ton formulaire -->

                                        <div class="mb-3">
                                            <label for="pdf_file" class="form-label">Fichier PDF <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf" required>
                                        </div>
                                        <iframe id="pdfPreview" style="width:100%;height:500px;display:none;"></iframe>

                                        <div class="mb-3">
                                            <label for="excel_file" class="form-label">Fichier Excel <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx,.xls" required>
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

                    <script>
                        document.getElementById('pdf_file').addEventListener('change', function(event) {
                            var file = event.target.files[0];
                            if (file && file.type === 'application/pdf') {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var pdfPreview = document.getElementById('pdfPreview');
                                    pdfPreview.src = e.target.result;
                                    pdfPreview.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        document.getElementById('excel_file').addEventListener('change', function(event) {
                            var file = event.target.files[0];
                            if (file && (file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || file.type === 'application/vnd.ms-excel')) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var excelPreview = document.getElementById('excelPreview');
                                    excelPreview.src = e.target.result;
                                    excelPreview.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>



                        <div class="modal fade" id="renseigner" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFormLabel">Renseigner en FCFA les recettes ci-après pour l'année {{$anneeN2}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        @php                    
                                            $documentSoumis = false;
                                            foreach($documents as $document) {
                                                if($document->userId == $user->id && $document->annee == $anneeN2 ) {
                                                $documentSoumis = true;
                                                break;
                                                }
                                            }
                                        @endphp
                                        @if($documentSoumis)
                                    <form class="row g-12" method="post" action="{{ route('admin.Indexations.soumettreRecettes') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Place ici ton formulaire -->

                                            <div class="mb-3">
                                                <label for="pic" class="form-label">Produit des impôts communaux <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pic" name="pic" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="pcac" class="form-label">Produit des centimes additionnels communaux <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pcac" name="pcac" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ptc" class="form-label">Produit des taxes communales <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="ptc" name="ptc" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rdpc" class="form-label">Revenus du domaine public communal <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rdpc" name="rdpc" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rdp" class="form-label">Revenus du domaine privé communal <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rdp" name="rdp" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rtps" class="form-label">Revenus tirés des prestations de services <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rtps" name="rtps" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button class="btn btn-primary" type="submit">Renseigner</button>
                                        </div>
                                    </form>
                                    @elseif(!$documentSoumis)
                                    <div class="modal-body">
                                        <h2 style="color:red;">Vous ne pouvez pas encore renseigner vos recettes pour l'année {{$anneeN2}}, veuillez d'abord soumettre vos comptes administratifs pour la dite année</h2>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                    @endif
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
