@extends('layouts.app1')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <p>{{ session()->get('success') }}</p>
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
                        <h5 class="card-title"><strong> utilisateurs déjà créés :</strong></h5>
                        <a href="" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-success">
                            <span class="bi bi-plus" aria-hidden="true"></span> Utilisateur
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#communesCommunautes"><strong><h5 class="btn btn-success"><span class="bi bi-plus" aria-hidden="true"></span> Affecter les communes aux communautés urbaines </h5></strong></a>
                        <a href="" class="btn btn-danger">Fermer</a>
                    </div>

                    <table class="table table-bordered table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom complet</th>
                                <th scope="col">Role</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Boite Postale</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date d'Inscription</th>
                                <th scope="col">Modifier/supprimer</th>
                                <th scope="col">Plus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td scope="row">U{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td style="text-align:center;">{{ $user->role->name  }}</td>
                                    <td style="text-align:center;">{{ $user->telephone }}</td>
                                    <td>{{ $user->boite_postale }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="text-align:center;">{{ $user->created_at }}</td>
                                    <td style="text-align:center;">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalFormUpdate-{{$user->id}}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                                    @if($user->id != $userId ) 
                                        <a href="#" class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer l\'Utilisateur {{ $user->name }} ?')) { document.getElementById('form-{{ $user->id }}').submit(); }">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form id="form-{{ $user->id }}" action="{{ route('admin.Indexations.supprimerUtilisateur', ['user' => $user->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </td>
                                </tr>



                                <div class="modal fade" id="modalFormUpdate-{{$user->id}}" tabindex="-3" aria-labelledby="modalFormLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFormLabel">Mise à jour de  {{$user->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <form class="row g-12" method="post" action="{{ route('admin.Indexations.updateUtilisateur', ['user'=>$user->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_method" value="put">
                                        <div class="modal-body">
                                            <!-- Place ici ton formulaire -->

                                            <div class="col-md-12">
                                        <label for="name" class="form-label">Nom complet<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom"  value = "{{$user->name}}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value = "{{$user->email}}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="sexe" class="form-label">Role<span class="text-danger">*</span></label>
                                        <select class="form-select" id="sexe" name="roleId" required>
                                            <option value="{{$user->roleId}}">{{$user->role->name }}</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="telephone" class="form-label">Téléphone<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" value = "{{$user->telephone}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="telephone" class="form-label">Boite postale<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telephone" name="boite_postale" placeholder="Boite postale" value = "{{$user->boite_postale}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Mot de passe<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" value = "{{$user->password}}" required>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="modalForm" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <form class="row g-12" method="post" action="{{ route('admin.Indexations.nouvelUser') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Formulaire de création d'un nouvel utilisateur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nom complet<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="sexe" class="form-label">Role<span class="text-danger">*</span></label>
                                        <select class="form-select" id="sexe" name="roleId" required>
                                            <option value=""></option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="telephone" class="form-label">Téléphone<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="telephone" class="form-label">Boite postale<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telephone" name="boite_postale" placeholder="Boite postale">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Mot de passe<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End Modal Dialog Scrollable -->


                <div class="modal fade" id="communesCommunautes" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <form class="row g-12" method="post" action="{{ route('admin.Indexations.affectation') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Affecter les communes aux communautés d'arrondissement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <label for="sexe" class="form-label">Communautés urbaines<span class="text-danger">*</span></label>
                                        <select class="form-select" id="cub" name="comId" required>
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                @if($user->roleId == 2)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="sexe" class="form-label">Communes d'arrondissement<span class="text-danger">*</span></label>
                                        <select class="form-select" id="car" name="communesId" required>
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                @if($user->id != 1 && $user->id != 2 && !in_array($user->id, $affectedCommuneIds))
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button class="btn btn-primary" type="submit">Affecter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End Modal Dialog Scrollable -->
            </div>
        </div>
    </div>
</section>
@endsection
