@extends('layouts.app')
@section('content')
<h1 class="text-center" style="text-decoration: underline; color:orangered; font-weight:bold; font-size:55px">Menu</h1>
<div class="container">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    {{-- <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-center">
            @foreach (App\Models\CategorieConso::has('user')->get() as $categorie )
                <a class="p-2 link-secondary text-decoration-none text-dark font-weight-bold" href="{{ route('voirMenuShow',['menu' => $categorie->id]) }}">{{ $categorie->categorie_nom }}</a>
          @endforeach
        </nav>
      </div> --}}
      <div class="row">
            @foreach ($conso as $con)
            <div class="col-md-4 py-2">
              <div class="card" style="width: 18rem; background:#F7F8F8">
                @if($con->consommation_image != null)
                    <img src="{{asset('storage'.'/'.$con->consommation_image)}}" height="287" width="287">
                @else
                    <img src="{{asset('storage/conso.png')}}" alt="profile" height="285" width="285">
                @endif
                <div class="card-body">
                    <p class="card-text">{{$con->consommation_description}}</p>
                    <h5 class="card-title" style="font-weight: bold;">{{ $con->consommation_titre }}</h5>
                    @if ($con->consommation_prix != null)
                        <p class="card-text">{{$con->consommation_prix}} CFA</p>
                    @else
                        <p class="card-text">0 CFA</p>
                    @endif
                    <p class="card-text text-success text-uppercase">{{$con->categorie->categorie_nom}}</p>
                    @if($con->statut == 0)
                       <!-- Button commander -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commander-{{$con->id}}">
                            Commander
                        </button>
                          <!-- Modal -->
                        <div class="modal fade" id="commander-{{$con->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Commander</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form method="post" action="{{route('commander')}}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="modal-body">
                                                <h1>{{$con->consommation_titre}}</h1>
                                                @if($con->consommation_image != null)
                                                    <img src="{{asset('storage'.'/'.$con->consommation_image)}}"  width="100">
                                                @else
                                                    <img src="{{asset('storage/conso.png')}}" alt="profile"  width="100">
                                                @endif
                                                <br/>
                                                <h1>Prix: {{$con->consommation_prix}} CFA</h1>
                                                <input id="conso" type="hidden" class="form-control" value="{{$con->id}}" name="consommation_id" autocomplete="consommation_id" autofocus>
                                                <input id="enseigne" type="hidden" class="form-control" value="{{$con->user_id}}" name="enseigne_id" autocomplete="enseigne_id" autofocus>
                                                <label>Quantite</label>
                                                <input type="number" class="form-control" value="1" name="quantite" ><br/>
                                                <select id="AddrType" onchange="showPlace()" name="type" class="form-control">
                                                    <option value="livraison">Livraison</option>
                                                    <option value="sur_place">Sur place</option>
                                                    <option value="a_emporter">a emporter</option>
                                                    <option value="autre">autre</option>
                                                </select><br/>
                                                    <label>Choisir une option</label>
                                                        <select class="form-control" name="option" required >
                                                            @foreach($con->optionsConso as $option)
                                                                @if($option->consommation_id == $con->id)
                                                                    <option value="{{ $option->id }}">{{$option->option_conso_titre}} || Prix: {{$option->option_conso_prix}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>

                                                {{-- @foreach ($optionConso as $option )
                                                    @if($option->consommation_id == $con->id)
                                                        <select class="form-control" name="option" required >
                                                                <option selected>Choisir une option de consommation....</option>
                                                                <option value="{{ $option->id }}">{{ $option->option_conso_titre }}</option>
                                                        </select>
                                                    @endif
                                                @endforeach --}}
                                                <div id="stateText" style="visibility: hidden">
                                                    Numero Table <input type="text" class="form-control" id="STATE" name="numero"/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Ajouter au panier') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    @else
                        <button  class="btn text-white bg-dark" disabled>
                            {{ __('Plat non disponible') }}
                        </button>
                    @endif
                </div>
              </div>
          </div>
            @endforeach
      </div>
    </div>
@endsection
