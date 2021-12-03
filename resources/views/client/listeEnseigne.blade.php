@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(request()->input('rechercher'))
                    <h6> {{ $listeEnseignes->count() }} resultat(s) pour la recherche "{{ request()->rechercher }}"</h6>
                @endif
                <form class="d-flex" action="{{ route('searchEnseigne') }}" method="GET">
                    <input type="text" id="rechercher" name="rechercher" value="{{ request()->rechercher ?? '' }}" placeholder="Rechercher une enseigne" class="form-control" />
                </form>
                <form action="{{ route('searchEnseigneAdvanced') }}" method="GET">

                    <div class="form-check form-check-inline py-4">
                        <input class="form-check-input" type="checkbox" name="search" id="inlineCheckbox1" value="restaurant">
                        <label class="form-check-label" for="inlineCheckbox1">Restaurant</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="search" id="inlineCheckbox2" value="bar">
                        <label class="form-check-label" for="inlineCheckbox2">Bar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="search" id="inlineCheckbox2" value="cafe">
                        <label class="form-check-label" for="inlineCheckbox2">Café</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="search" id="inlineCheckbox2" value="terasse">
                        <label class="form-check-label" for="inlineCheckbox2">Terasse</label>
                    </div>
                    <button  type="submit" class="btn btn-secondary form-inline">Trier</button>
                </form>
            </div>
        <div class="col-md-8 p-4">
            <div class="card">
                <div class="card-header">{{ __('Listes des enseignes') }}</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @foreach ($listeEnseignes as $liste)
                                <tr>
                                    <td>
                                       <a href="{{ route('voirMenu',$liste->id) }}" class="text-uppercase" >{{ $liste->name }}</a><br/>
                                        <span><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{ $liste->etablissement->etablissement_adresse }}
                                        </span><br/>
                                        <span><i class="fa fa-mobile" aria-hidden="true"></i>
                                            {{ $liste->etablissement->etablissement_numero_tel }}
                                        </span>
                                        <span class="text-success"><br/>
                                            #{{ $liste->type }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        @if($liste->etablissement_logo != null)
                                            <img src="/photoProfile/{{$liste->etablissement->etablissement_logo}}" height="50px"/>
                                        @else
                                            <img src="{{asset('photoProfile/default.jpg')}}" alt="profile" height="50px">
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>
        var route = "{{ route('searchEnseigne') }}";
         $('#rechercher').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection
