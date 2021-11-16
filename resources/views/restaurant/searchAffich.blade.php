@extends('layouts.app')
@section('content')
<main class="container py-4">

    <div class="row">
        <p>coucou</p>
        {{-- @foreach ($enseignes as $enseigne)
        <div class="col-md-4 py-2">
                <div class="card" style="width: 18rem; background:#F7F8F8">
                    @if($enseigne->etablissement_logo != null)
                        <img src="/photoProfile/{{$enseigne->etablissement_logo}}" height="300px"/>
                    @else
                        <img src="{{asset('photoProfile/default.jpg')}}" alt="profile" height="300px">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title text-center" style="font-weight: bold;">{{ $enseigne->user->nameEnseigne }}</h5>
                    <span class="text-success" style="font-weight: bold; font-family:poppins">{{ $enseigne->user->type }}</span>
                    <p class="card-text flex-end">
                        <span class=""><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $enseigne->etablissement_adresse }}</span><br>
                        <span class=""><i class="fa fa-mobile" aria-hidden="true"></i> {{ $enseigne->etablissement_numero_tel }}</span>
                    </p>
                    <a href="{{ route('voirMenu',$enseigne->user->id) }}" class="stretched-link btn btn-dark" style="width:250px">Voir menu</a>
                </div>
                </div>
        </div>
        @endforeach --}}
    </div>


  </main>

@endsection
