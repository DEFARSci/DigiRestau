@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
               <div class="card-body">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>
                {{-- Liste Categorie --}}
                <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" style="background:black">
                    {{ __('LISTE CATEGORIES') }}
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Categorie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Nom</td>
                                        <td>Descriptio</td>
                                        <td colspan="2">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $cat )
                                        @if(Auth::user()->id === $cat->user_id)
                                            <tr>
                                                <td>{{ $cat->categorie_nom }}</td>
                                                <td>{{ $cat->categorie_description }}</td>
                                                <td>
                                                    <a href="{{ route('delete-cat',$cat->id) }}" >
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('edit-cat',$cat->id) }}" >
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    </div>
                </div>
                    {{-- AJOUT CATEGOIRE --}}
                    <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background:black">
                        {{ __('CATEGORIES') }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Categorie</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('addCat') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Nom</label>
                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nom" required>

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Description</label>
                                            <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description"></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Ajouter') }}
                                        </button>
                                    </div>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    <!-- ADD CONSO -->
                    <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background:#3b5998">
                        {{ __('AJOUT CONSOMMATION') }}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajout Conso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{route('add-conso')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Categorie</label>
                                            <select class="form-select" aria-label="" name="categorie" required>
                                                @foreach ($cateConso as $cat )
                                                @if(Auth::user()->id === $cat->user_id)
                                                    <option value="{{ $cat->id }}">{{ $cat->categorie_nom }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('categorie')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-2 justify-content-center">
                                            <label for="file-ip-1" class="">Choisissez une image</label>
                                            <input type="file" id="file-ip-1" onchange="showPrevent(event);" class=" @error('image') is-invalid @enderror" name="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="preview">
                                                    <img id="file-ip-1-preview" class="imgFile" />
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Nom</label>
                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nom" required>

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Description</label>
                                            <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description"></textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Prix</label>
                                            <input id="prix" type="text" class="form-control @error('prix') is-invalid @enderror" name="prix" placeholder="Prix">

                                            @error('prix')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- ADD Options CONSO -->
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#example">
                        {{ __('OPTIONS CONSO') }}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Options Consommations</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{route('addOption-conso')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Consommation</label>
                                            <select class="form-select" aria-label="" name="conso" required>
                                                @foreach ($Consommation as $con )
                                                @if(Auth::user()->id === $con->user_id)
                                                    <option value="{{ $con->id }}" >{{ $con->consommation_titre }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('conso')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Nom</label>
                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nom" required>

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Description</label>
                                            <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description"></textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-8">
                                            <label>Prix</label>
                                            <input id="prix" type="text" class="form-control @error('prix') is-invalid @enderror" name="prix" placeholder="Prix" required>

                                            @error('prix')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                      {{-- Liste Options Conso --}}
                    <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#static1" style="background:black">
                        {{ __('OPTIONS') }}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="static1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Liste Options Consommations</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Option</td>
                                            <td>Consommation</td>
                                            <td>Description</td>
                                            <td>Prix</td>
                                            <td colspan="2">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($optionconso as $option )
                                            @if(Auth::user()->id === $option->user_id)
                                                <tr>
                                                    <td>{{ $option->option_conso_titre }}</td>
                                                    <td>{{ $option->consomation->consommation_titre }}</td>
                                                    <td>{{ $option->option_conso_description }}</td>
                                                    <td>{{ $option->option_conso_prix }}</td>
                                                    <td>
                                                        <a href="{{ route('delete-option',$option->id) }}" >
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{ route('edit-option',$option->id) }}" >
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        </div>
                    </div>
                     {{-- Liste users clients --}}
                     <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Generer
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button type="button"  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticGenerate">
                                Voir Qr Code
                            </button>

                          <a class="dropdown-item" href="{{ route('pdf') }}">Telecharger qr code</a>
                        </div>
                      </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticGenerate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Generer un qr Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="data:image/png;base64, {!! base64_encode($qrcode) !!} "><br/>

                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        </div>
                    </div>
               </div>

               {{-- Liste des consommations --}}
               <div class="card">
                    <div class="card-header">{{ __('Listes des consommations') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>LOGO</td>
                                    <td>Categorie</td>
                                    <td>Nom</td>
                                    <td>Prix</td>
                                    <td>Statut</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conso as $con )
                                    @if(Auth::user()->id === $con->user_id)
                                        <tr>
                                            <td>
                                                @if($con->consommation_image != null)
                                                    <img src="{{asset('storage'.'/'.$con->consommation_image)}}" width="100">
                                                @else
                                                    <img src="{{asset('storage/conso.png')}}" alt="profile"  width="100">
                                                @endif
                                            </td>
                                            <td>{{ $con->categorie->categorie_nom }}</td>
                                            <td>{{ $con->consommation_titre }}</td>
                                                @if ($con->consommation_prix != null)
                                                    <td>{{ $con->consommation_prix }} CFA</td>
                                                @else
                                                    <td>0 CFA</td>
                                                @endif
                                            <td>
                                                @if($con->statut == 0)
                                                    <form method="post" action="{{route('unactive.conso',$con->id)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-dark">Activer</button>

                                                    </form>
                                                @else
                                                        <form method="post" action="{{route('active.conso',$con->id)}}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-secondary text-white">Desactiver</button>
                                                        </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('delete-conso',$con->id) }}" >
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                 {{-- UPDATE CONSO --}}
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#static-{{ $con->id }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                                  <!-- Modal -->
                                                <div class="modal fade" id="static-{{ $con->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Consommation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" action="{{ route('update-conso', $con->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                        <div class="modal-body">
                                                                <div class="form-group row justify-content-center">
                                                                    <div class="col-md-8">
                                                                        <label>Nom</label>
                                                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nom"  value="{{ $con->consommation_titre }}" required>

                                                                        @error('title')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row justify-content-center">
                                                                    <div class="col-md-8">
                                                                        <label>Description</label>
                                                                    <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description">{{ $con->consommation_description }}</textarea>
                                                                        @error('description')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row justify-content-center">
                                                                    <div class="col-md-8">
                                                                        <label>Prix</label>
                                                                        <input id="prix" type="text" class="form-control @error('prix') is-invalid @enderror" name="prix" placeholder="Prix"  value="{{ $con->consommation_prix }}" required>

                                                                        @error('prix')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-8 offset-md-2 justify-content-center">
                                                                        <label for="file-ip-1" class="">Choisissez une image</label>
                                                                        <input type="file" id="file-ip-1" onchange="showPrevent(event);" class=" @error('image') is-invalid @enderror" name="image">
                                                                        @error('image')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                            <div class="preview">
                                                                                <img id="file-ip-1-preview" class="imgFile" />
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row justify-content-center">
                                                                    <div class="col-md-8">
                                                                        <label>Categorie</label>
                                                                        <select class="form-select" aria-label="" name="categorie">
                                                                            @foreach ($cateConso as $cat )
                                                                            @if(Auth::user()->id === $cat->user_id)
                                                                                <option value="{{ $cat->id }}">{{ $cat->categorie_nom }}</option>
                                                                            @endif
                                                                            @endforeach
                                                                        </select>
                                                                        @error('categorie')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Ajouter') }}
                                                                    </button>
                                                                </div>
                                                        </div>
                                                    </form>
                                                    </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
