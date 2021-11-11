@extends('layouts.header')
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

    <div class="row mb-2">
      @foreach ($enseignes as $enseigne)
      <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary">{{ $enseigne->user->name }}</strong>
              <h3 class="mb-0">Type: {{ $enseigne->user->type }}</h3>
              <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
              <a href="{{ route('voirMenu',$enseigne->user->id) }}" class="stretched-link btn btn-dark">Voir le menu</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              @if($enseigne->etablissement_logo != null)
                  <img src="/photoProfile/{{$enseigne->etablissement_logo}}" width="250" height="250"/>
              @else
                  <img src="{{asset('photoProfile/default.jpg')}}" alt="profile" width="250" height="250">
              @endif
            </div>
          </div>

      </div>
      @endforeach
    </div>


  </main>

@endsection
