@extends('layouts.app')
@section('content')
@include('restaurant.search')
<main class="container py-4">

    <div class="row">
        @foreach ($filterResult as $filter )
            <div class="col-md-4 py-2">
                <div class="card" style="width: 18rem; background:#F7F8F8">
                    @if($filter->etablissement->etablissement_logo != null)
                        <img src="/photoProfile/{{$filter->etablissement->etablissement_logo}}" height="300px"/>
                    @else
                        <img src="{{asset('photoProfile/default.jpg')}}" alt="profile" height="300px">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title text-center" style="font-weight: bold;">{{ $filter->name}}</h5>
                    <span class="text-success" style="font-weight: bold; font-family:poppins">{{ $filter->type }}</span>
                    <p class="card-text flex-end">
                        <span class=""><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $filter->etablissement->etablissement_adresse }}</span><br>
                        <span class=""><i class="fa fa-mobile" aria-hidden="true"></i> {{ $filter->etablissement->etablissement_numero_tel }}</span>
                    </p>
                    <a href="{{ route('voirMenu',$filter->id) }}" class="stretched-link btn btn-dark" style="width:250px">Voir menu</a>
                </div>
                </div>
        </div>
        @endforeach

    </div>


  </main>

@endsection
