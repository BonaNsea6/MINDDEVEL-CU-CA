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
                            <h5 class="card-title"><strong>Admin/Communautés Urbaines</strong></h5>
                            <a href="" data-bs-toggle="modal" data-bs-target="#config"><strong><h5 class="btn btn-success"><span class="fa fa-download" aria-hidden="true"></span> Fichier </h5></strong></a>
                            <a href=""><strong><h5 class="btn btn-danger">Fermer</h5></strong></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2" id="borderedTabContent">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Communautés urbaines</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Les comptes administratifs</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Les recettes des CUB</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="recette-tab" data-bs-toggle="tab" data-bs-target="#bordered-recette" type="button" role="tab" aria-controls="recette" aria-selected="false">Les recettes des CAR</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="net-tab" data-bs-toggle="tab" data-bs-target="#bordered-net" type="button" role="tab" aria-controls="net" aria-selected="false">Montant percu par les CAR</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabContent">
                                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                        <a href="{{ route('admin.Indexations.viewCommunePDF') }}"><strong><h5 class="btn btn-success"><span class="fa fa-download" aria-hidden="true"></span> Fichier </h5></strong></a>
                                        <table class="table table-bordered table-borderless ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="text-align:center;">Communautés urbaines</th>
                                                    <th scope="col" style="text-align:center;">Communes d'arrondissement</th>
                                                    <th scope="col">Plus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $currentCubId = null;
                                                    $rowspanCount = 0;
                                                @endphp

                                                @foreach($communes as $index => $commune)
                                                    @php
                                                        // Vérifie si la communauté urbaine actuelle est la même que la précédente
                                                        if($commune->cubId !== $currentCubId) {
                                                            // Si oui, mettre à jour la communauté urbaine actuelle
                                                            $currentCubId = $commune->cubId;

                                                            // Calculer combien de fois cette communauté urbaine apparaît dans la liste
                                                            $rowspanCount = $communes->where('cubId', $commune->cubId)->count();
                                                        }
                                                    @endphp

                                                    <tr>
                                                        <td scope="row">{{ $commune->id }}</td>

                                                        @if($rowspanCount > 0)
                                                            <td rowspan="{{ $rowspanCount }}" style="vertical-align:middle;">{{ $commune->cubUser->name }}</td>
                                                            @php $rowspanCount = 0; @endphp
                                                        @endif

                                                        <td style="text-align:center;">{{ $commune->carUser->name }}</td>
                                                        <td>
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#modalFormUpdate" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer cette relation ?')) { document.getElementById('form-{{ $commune->id }}').submit(); }">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <form id="form-{{ $commune->id }}" action="" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

                                        <table class="table table-bordered table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">CTD</th>
                                                    <th scope="col">Année</th>
                                                    <th scope="col">Fichier pdf</th>
                                                    <th scope="col">Fichier excel</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                    $currentUserId = null;
                                                    $rowspanCount = 0;
                                                @endphp
                                                
                                                    @foreach($files as $index => $file)

                                                    @php
                                                        // Vérifie si la communauté urbaine actuelle est la même que la précédente
                                                        if($file->userId !== $currentUserId) {
                                                            // Si oui, mettre à jour la communauté urbaine actuelle
                                                            $currentUserId = $file->userId;

                                                            // Calculer combien de fois cette communauté urbaine apparaît dans la liste
                                                            $rowspanCount = $files->where('userId', $file->userId)->count();
                                                        }
                                                    @endphp

                                                        <tr>
                                                            <td scope="row">{{ $index + 1 }}</td>
                                                            @if($rowspanCount > 0)
                                                                <td rowspan="{{ $rowspanCount }}">{{  $file->user->name}}</td>
                                                                @php $rowspanCount = 0; @endphp
                                                            @endif
                                                            <td scope="row">{{ $file->annee }}</td>
                                                            <td scope="row" style="color:green" style="text-align:center;">
                                                                <a href="{{ route('admin.Indexations.rapportPdf', ['commune' => $file->userId, 'annee' => $file->annee]) }}" class="btn btn-warning">
                                                                <span class="fa fa-download"></span> 
                                                                </a>
                                                            </td>
                                                            <td scope="row" style="color:red" style="text-align:center;">
                                                                <a href="{{ route('admin.Indexations.rapportExcel', ['commune'=> $file->userId, 'annee'=> $file->annee]) }}" class="btn btn-warning"><span class="fa fa-download"></span> </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            </tbody> 
                                        </table>             
                                    </div>

                                    <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <a href="{{ route('admin.Indexations.viewRecetteCommunePDF') }}"><strong><h5 class="btn btn-success"><span class="fa fa-download" aria-hidden="true"></span> Fichier </h5></strong></a>
                                    <table class="table table-bordered table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">CUB</th>
                                                    <th scope="col">annee</th>                                      
                                                    <th scope="col">pic</th>
                                                    <th scope="col">pcac</th>
                                                    <th scope="col">ptc</th>
                                                    <th scope="col">rdp</th>
                                                    <th scope="col">rdpc</th>
                                                    <th scope="col">rtps</th>
                                                    <th scope="col">total</th>
                                                    <th scope="col">Mtnt à verser</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                    $currentUserId = null;
                                                    $rowspanCount = 0;
                                            @endphp

                                                @foreach($recetteCommunautes as $index => $recette)
                                                    @php
                                                            // Vérifie si la communauté urbaine actuelle est la même que la précédente
                                                            if($recette->userId !== $currentUserId) {
                                                                // Si oui, mettre à jour la communauté urbaine actuelle
                                                                $currentUserId = $recette->userId ;

                                                                // Calculer combien de fois cette communauté urbaine apparaît dans la liste
                                                                $rowspanCount = $recetteCommunautes->where('userId', $recette->userId)->count();
                                                            }
                                                    @endphp
                                                        <tr>
                                                            <td scope="row">{{ $index + 1 }}</td>
                                                            @if($rowspanCount > 0)
                                                                <td rowspan="{{ $rowspanCount }}">{{ $recette->user->name  }}</td>
                                                                @php $rowspanCount = 0; @endphp
                                                            @endif
                                                            <td scope="row">{{$recette->annee}}</td>                                                          
                                                            <td scope="row">{{ number_format($recette->pic, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->pcac, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->ptc, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->rdp, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->rdpc, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->rtps, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->Total, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->tauxApplique, 0, ',', '.') }}</td>
                                                        </tr>
                                                @endforeach
                                            </tbody> 
                                        </table>             
                                    </div>
                                    <div class="tab-pane fade" id="bordered-recette" role="tabpanel" aria-labelledby="recette-tab">
                                    <a href="{{ route('admin.Indexations.viewRecetteComPDF') }}"><strong><h5 class="btn btn-success"><span class="fa fa-download" aria-hidden="true"></span> Fichier </h5></strong></a>

                                    <table class="table table-bordered table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">CA</th>
                                                    <th scope="col">Année</th>
                                                    <th scope="col">PIL</th>
                                                    <th scope="col">PEDS</th>
                                                    <th scope="col">PTC</th>
                                                    <th scope="col">Total AN2</th>
                                                    <th scope="col">Total AN3</th>
                                                    <th scope="col">Progression</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Pourcentage</th>
                                                    <th scope="col">Illigibilité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $currentUserId = null;
                                                    $rowspanCount = 0;
                                                @endphp

                                                @foreach($recetteCommune as $index => $recette)
                                                    @php
                                                        if ($recette->userId !== $currentUserId) {
                                                            $currentUserId = $recette->userId;

                                                            // Calculer combien de fois ce userId apparaît consécutivement
                                                            $rowspanCount = $recetteCommune->where('userId', $recette->userId)->count();
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{ $index + 1 }}</td>

                                                        @if ($rowspanCount > 0)
                                                            <td scope="row" rowspan="{{ $rowspanCount }}" style="text-align:center; vertical-align:middle;">{{ $recette->user->name }}</td>
                                                            @php $rowspanCount = 0; @endphp
                                                        @endif

                                                        <td scope="row" style="text-align:center;">{{ $recette->annee }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->pil, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->peds, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->ptc, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->totalAnneeN2, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->totalAnneeN3, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->difference, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->totauxCommunes, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ $recette->tauxRepartition }}%</td>
                                                        @if($recette->illigibilite == "oui")
                                                            <td scope="row" style="background-color:green; color:white;text-align:center;">{{ $recette->illigibilite }}</td>
                                                        @elseif($recette->illigibilite == "non")
                                                            <td scope="row" style="background-color:red; color:white;text-align:center;">{{ $recette->illigibilite }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody> 
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="bordered-net" role="tabpanel" aria-labelledby="net-tab">

                                        <table class="table table-bordered table-borderless datatable">
                                        <thead style="color:white;">
                                            <tr style="background-color:gray;">
                                                <th scope="col" style="text-align:center">N°</th>
                                                <th scope="col" style="text-align:center">Annéee N-2</th>  
                                                <th scope="col" style="text-align:center">Communes</th>           
                                                <th scope="col" style="text-align:center">Montant Part Fixe</th>
                                                <th scope="col" style="text-align:center">Montant Part Variable</th>
                                                <th scope="col" style="text-align:center">Total</th>
                                                <th scope="col" style="text-align:center">Pourcentage </th>
                                                <th scope="col" style="text-align:center">Montant trimestriel </th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($netPercevoirData as $commune)
                                            <tr >
                                                <td scope="row"></td>
                                                <td scope="row" style="text-align:center;">{{ $commune->annee }}</td>
                                                <td scope="row">{{ $commune->user->name }}</td>
                                                <td scope="row" style="color:green; text-align:center;"> {{ number_format($commune->partFixe, 0, ',', '.') }} XAF</td>
                                                <td scope="row" style="color:red; text-align:center;">{{number_format( $commune->partVariable, 0, ',', '.') }} XAF</td>
                                                <td scope="row" style="color:blue; text-align:center;">{{ number_format($commune->total, 0, ',', '.') }} XAF</td>
                                                <td scope="row" style="color:blue; text-align:center;">{{ $commune->tauxRepartition }} %</td>
                                                <td scope="row" style="color:blue; text-align:center;">{{ number_format($commune->totalTrimestriel, 0, ',', '.') }} XAF</td>
                                                <td scope="row"></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        </table>            
                                    </div>
                                </div><!-- End Bordered Tabs -->
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
