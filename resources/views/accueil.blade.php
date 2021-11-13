@extends('layouts.app')
@section('content')
@include('restaurant.search')
<main class="container py-4">

    <div class="p-4  p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
        <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
      </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($enseignes as $enseigne)
        <div class="col-md-4">
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
        @endforeach
    </div>


  </main>

@endsection
