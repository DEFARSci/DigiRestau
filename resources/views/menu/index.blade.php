@extends('layouts.app')

@section('content')
<h1 class="text-center" style="text-decoration: underline; color:orangered; font-weight:bold; font-size:55px">Menu</h1>

<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-center">
            @foreach (App\Models\CategorieConso::has('user')->get() as $categorie )
                <a class="p-2 link-secondary text-decoration-none text-dark font-weight-bold" href="{{ route('voirMenuShow',['menu' => $categorie->id]) }}">{{ $categorie->categorie_nom }}</a>
          @endforeach
        </nav>
      </div>
      <div class="row">
            @foreach ($conso as $con)
            <div class="col-md-3 m-3">
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
                    @foreach($con->optionsConso as $option)
                        <p class="card-text text-right">{{$option->option_conso_titre}}</p>
                    @endforeach
                    @if($con->statut == 0)
                        <a href="" class="btn text-white" style="background:#3b5998">
                        {{ __('Commander') }}
                        </a>
                    @else
                        <a href="" class="btn text-white bg-dark">
                            {{ __('Plat non disponible') }}
                        </a>
                    @endif
                </div>
              </div>
          </div>
            @endforeach
      </div>
    </div>
@endsection
