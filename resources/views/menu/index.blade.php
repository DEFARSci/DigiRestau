@extends('layouts.header')

@section('content')

<div class="container py-4">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-center">
            @foreach (App\Models\CategorieConso::all() as $categorie )
            <a class="p-2 link-secondary" href="{{ route('voirMenuShow',['menu' => $categorie->id]) }}">{{ $categorie->categorie_nom }}</a>
          @endforeach
        </nav>
      </div>
    <h1 class="text-center py-4" style="text-decoration: underline; color:orangered; font-weight:bold; font-size:55px">Menu</h1>
      <div class="row g-2">
            @foreach ($conso as $con)
            <div class="col-md-3">
              <div class="card" style="width: 18rem;">
                <img src="{{asset('storage'.'/'.$con->consommation_image)}}" height="287" width="287">
                <div class="card-body">
                    <p class="card-text">{{$con->consommation_description}}</p>
                    <p class="card-text">Prix: {{$con->consommation_prix}}</p>
                    <p class="card-text text-success text-uppercase">{{$con->categorie->categorie_nom}}</p>
                    @if($con->statut == 0)
                        <a href="" class="btn text-white" style="background:#3b5998">
                        {{ __('Commander') }}
                        </a>
                    @else
                        <a href="" class="btn text-white" style="background:#3b5998">
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
