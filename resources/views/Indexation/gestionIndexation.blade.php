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
                            <a href="" data-bs-toggle="modal" data-bs-target="#renseigner"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Renseigner Vos Recettes </h5></strong></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#renseignerCommunes"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Renseigner Les recettes de mes communes </h5></strong></a>
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
                                        <th scope="col" style="text-align:center">Annéee N-2</th>
                                        <th scope="col" style="text-align:center">Mtnt TOTAL</th>
                                        <th scope="col" style="text-align:center">Montant à verser</th>
                                        <th scope="col" style="text-align:center">Reste</th>
                                        <th scope="col" style="text-align:center">Mtnt Fixe à partager</th>
                                        <th scope="col" style="text-align:center">Mtnt Variable à partager</th>
                                        <th scope="col" style="text-align:center">Actions</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($recettes as $recette)
                                
                                    <tr style="text-align:center;">
                                        <td scope="row">{{ $recette->id }}</td>
                                        <td scope="row">{{ $recette->annee }}</td>
                                        <td scope="row" style="color:green">{{ number_format($recette->Total, 0, ',', '.') }} XAF</td>
                                        <td scope="row" style="color:red">{{ number_format($recette->tauxApplique, 0, ',', '.') }} XAF</td>
                                        <td scope="row" style="color:blue">{{ number_format($recette->resteCUB, 0, ',', '.') }} XAF</td>
                                        <td scope="row" style="color:blue">{{ number_format($recette->partFixe , 0, ',', '.') }} XAF</td>
                                        <td scope="row" style="color:blue">{{ number_format($recette->partVariable , 0, ',', '.') }} XAF</td>
                                        <td scope="row">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#modalFormUpdate-{{$recette->id}}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#modalDetail-{{$recette->id}}" class="btn btn-dark"> <i class="bi bi-plus"></i></a>
                                                <a href="#" class="btn btn-danger" onclick="if(confirm('voulez vous vraiment supprimer ces informations sur la  {{$recette->id}}')){document.getElementById('form-{{$recette->id}}').submit()}"> <i class="fa fa-trash"></i></a>
                                                    <form id="form-{{$recette->id}}" action="{{route('commune.Indexations.annulerRecette', ['recette'=>$recette->id])}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete">
                                                    </form>
                                            <form action="{{ route('commune.Indexations.calcul') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" id="submitBtn" > Calcul</button>
                                            </form>
                                            <form action="{{ route('commune.Indexations.viewPDF', ['user'=>$recette->userId,'annee'=>$recette->annee, 'recette'=>$recette->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning" id="submitBtn" > <i class="fa fa-download">Rapport</i></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <script>
                                        // Remplacez cette date par votre date limite
                                        var deadline = new Date('2024-07-05T23:59:59'); // Date limite au format ISO

                                        // Obtenez l'élément du bouton
                                        var submitBtn = document.getElementById('submitBtn');

                                        // Fonction pour vérifier la date actuelle
                                        function checkDate() {
                                            var now = new Date();
                                            if (now >= deadline) {
                                                submitBtn.disabled = false; // Activer le bouton
                                            } else {
                                                submitBtn.disabled = true; // Laisser le bouton désactivé
                                            }
                                        }

                                        // Vérifiez la date immédiatement au chargement de la page
                                        checkDate();

                                        // Vous pouvez également utiliser setInterval pour vérifier la date régulièrement
                                        // Ici, nous vérifions toutes les 1 seconde (1000 ms)
                                        setInterval(checkDate, 1000);
                                    </script>

                        <div class="modal fade" id="modalFormUpdate-{{$recette->id}}" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFormLabel">Mise à jour des recettes ci-après pour l'année {{$anneeN2}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <form class="row g-12" method="post" action="{{ route('commune.Indexations.updateRecette', ['recette'=>$recette->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_method" value="put">
                                        <div class="modal-body">
                                            <!-- Place ici ton formulaire -->

                                            <div class="mb-3">
                                                <label for="pic" class="form-label">Produit des impôts communaux <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pic" name="pic" value="{{ $recette->pic }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="pcac" class="form-label">Produit des centimes additionnels communaux <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pcac" name="pcac" value="{{ $recette->pcac }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ptc" class="form-label">Produit des taxes communales <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="ptc" name="ptc" value="{{ $recette->ptc }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rdpc" class="form-label">Revenus du domaine public communal <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rdpc" name="rdpc" value="{{ $recette->rdpc }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rdp" class="form-label">Revenus du domaine privé communal <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rdp" name="rdp" value="{{ $recette->rdp }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rtps" class="form-label">Revenus tirés des prestations de services <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rtps" name="rtps" value="{{ $recette->rtps }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button class="btn btn-primary" type="submit">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="modalDetail-{{$recette->id}}" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFormLabel">Plus de détails sur les recettes de l'année {{$anneeN2}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            
                                 <div class="modal-body">
                                    <div class="card-body">
                                        <h5 class="card-title">Montant en XAF des différents produits </h5>

                                        <!-- Default List group -->
                                        <ul class="list-group">
                                            <li class="list-group-item">Produit des impôts communaux : </br> <i style="color:blue"> {{ number_format($recette->pic, 0, ',', '.') }}</i> XAF</li>
                                            <li class="list-group-item">Produit des centimes additionnels communaux : <i style="color:blue"> {{ number_format($recette->pcac, 0, ',', '.') }}</i> XAF</li>
                                            <li class="list-group-item">Produit des taxes communales : </br><i style="color:blue">{{ number_format($recette->ptc, 0, ',', '.') }}</i> XAF</li>
                                            <li class="list-group-item">Revenus du domaine public communal :</br><i style="color:blue"> {{ number_format($recette->rdpc, 0, ',', '.') }}</i> XAF</li>
                                            <li class="list-group-item">Revenus du domaine privé communal :</br> <i style="color:blue">{{ number_format($recette->rdp, 0, ',', '.') }} </i> XAF</li>
                                            <li class="list-group-item">Revenus tirés des prestations de services :</br><i style="color:blue"> {{ number_format($recette->rtps, 0, ',', '.') }}</i> XAF </li>
                                        </ul><!-- End Default List group -->

                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Plus d'infos </h5>

                                        <!-- Default List group -->
                                        <ul class="list-group">
                                            <li class="list-group-item">Pour un total de :<i style="color:blue"> {{ number_format($recette->Total, 0, ',', '.') }}</i> XAF </li>
                                            <li class="list-group-item">Explication sur le processus de Retention du montant à partager aux communes:<i style="color:blue">{{$recette->explication}}</i> donc un montant de : <i style="color:green">{{number_format($recette->tauxApplique, 0, ',', '.')}}</i> XAF  </li>
                                            <li class="list-group-item">Chaque commune d'arrondissement aura un montant fixe de : <i style="color:blue">{{ number_format($recette->partCommune, 0, ',', '.')}}</i> XAF</li>
                                        </ul><!-- End Default List group -->

                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Commune(s) éligibles au partage de la part variable </h5>

                                        <!-- Default List group -->
                                        <ul class="list-group">
                                            @foreach($communesEligibles as $communes)
                                            <li class="list-group-item"> <i style="color:blue"> {{ $communes->user_name}}</i> </li>
                                            @endforeach
                                        </ul><!-- End Default List group -->

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Montant total obtenu par chaque commune</h5>

                                        <!-- Default List group -->
                                        <ul class="list-group">
                                            @foreach($netPercevoirData as $montant)
                                            <li class="list-group-item">{{ $montant->commune_name}}  : sa part Fixe est de </br><i style="color:blue">  {{ number_format($montant->partFixe, 0, ',', '.') }}</i> XAF et sa part variable est de<i style="color:blue">  {{ number_format($montant->partVariable, 0, ',', '.') }}</i> XAF pour un total de<i style="color:red"> {{ number_format($montant->total, 0, ',', '.') }} </i>XAF</li>
                                            @endforeach
                                        </ul><!-- End Default List group -->

                                    </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                       
                                </div>
                            </div>
                        </div>
                    </div>


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
                                <form class="row g-12" method="post" action="{{ route('commune.Indexations.storefileCommunaute') }}" enctype="multipart/form-data">
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
                                    <form class="row g-12" method="post" action="{{ route('commune.Indexations.soumettreRecettes') }}" enctype="multipart/form-data">
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



                        <div class="modal fade" id="renseignerCommunes" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFormLabel">Renseigner en FCFA les recettes des différentes communes pour l'année {{$anneeN2}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <form class="row g-12" method="post" action="{{ route('commune.Indexations.soumettreRecettesCommune') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        
                                        <div class="modal-body">
                                            <!-- Place ici ton formulaire -->

                                            <div class="col-md-12">
                                                <label for="sexe" class="form-label">Commune d'arrondissement<span class="text-danger">*</span></label>
                                                <select class="form-select" id="sexe" name="userId" required>
                                                    <option value="">Sélectionnez une commune</option>
                                                        @foreach($communeArr as $commune)
                                                            <option value="{{$commune->id}}">{{$commune->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div> 
                                            <div class="mb-3">
                                                <label for="pil" class="form-label">Produit de l'impot libératoire<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pil" name="pil" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ptc" class="form-label">Produit des taxes communales <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="ptc" name="ptc" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="peds" class="form-label">Produit de l'exploitation du domaine et des services <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="peds" name="peds" required>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button class="btn btn-primary" type="submit">Renseigner</button>
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
