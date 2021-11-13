@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Listes des enseignes') }}</div>
                <div class="card-body">
                    <table class="table">

                        <tbody>
                            @foreach ($listeEnseignes as $liste)
                                <tr>
                                    <td>
                                       <a href="{{ route('voirMenu',$liste->user->id) }}" >{{ $liste->user->nameEnseigne }}</a><br/>
                                        <span><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{ $liste->etablissement_adresse }}
                                        </span><br/>
                                        <span><i class="fa fa-mobile" aria-hidden="true"></i>
                                            {{ $liste->etablissement_numero_tel }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        @if($liste->etablissement_logo != null)
                                            <img src="/photoProfile/{{$liste->etablissement_logo}}" height="50px"/>
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
@endsection
