@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>LOGO</td>
                                    <td>Date</td>
                                    <td>Nom</td>
                                    <td>Prix</td>
                                    <td>Type de livraison</td>
                                    <td>Client</td>
                                    <td align="center">Statut</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commandes as $commande )
                                   @if(Auth::user()->id === $commande->enseigne_id)
                                    <tr>
                                        <td>
                                            @if($commande->consommations->consommation_image != null)
                                                <img src="{{asset('storage'.'/'.$commande->consommations->consommation_image)}}" height="70">
                                             @else
                                                <img src="{{asset('storage/conso.png')}}" alt="profile"  height="70">
                                            @endif
                                        </td>
                                        <td>{{ $commande->commande_added_dateTime}}</td>
                                        <td>{{ $commande->consommations->consommation_titre }}</td>
                                        <td>{{ $commande->consommations->consommation_prix }}</td>
                                        <td>{{ $commande->Type_livraison }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $commande->id }}">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $commande->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Informations Client</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card" style="border:none">
                                                                <div class="card-body col-md-8">
                                                                        <table style="background-color: none;">
                                                                            <tr>
                                                                                <td class="col-md-2">Nom</td>
                                                                                <td class="col-md-2">Adresse</td>
                                                                                <td class="col-md-2">Telephone</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-2">{{$commande->user->nameE}}</td>
                                                                                <td class="col-md-2">{{$commande->user->client->client_adresse}}</td>
                                                                                <td class="col-md-2">{{$commande->user->client->client_numero}}</td>
                                                                            </tr>
                                                                        </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                        <td>
                                            <div class="wrapper">
                                                <div class="select_wrap">
                                                    <ul class="default_option">
                                                    @if($commande->statut ==='encours')
                                                        <li>
                                                            <div class="option pizza">
                                                                <div class="icon"></div>
                                                                <p>encours</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <ul class="select_ul">
                                                        <li>
                                                            <div class="option pizza">
                                                                <div class="icon"></div>
                                                                    <a class="dropdown-item" href="{{route('makeStatutLivre.commande',$commande->id)}}">Livré</a>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="option burger">
                                                                <div class="icon"></div>
                                                                <a class="dropdown-item" href="{{route('makeStatutNonlivre.commande',$commande->id)}}">annulée</a>
                                                            </div>
                                                        </li>
                                                        @endif

                                                    </ul>

                                                    @if($commande->statut != 'encours')
                                                        @if (Auth::user()->id === $commande->enseigne_id)
                                                            @if($commande->statut ==='livre')
                                                                <ul class="default_option">
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <p>commande livrée</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <ul class="select_ul">
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <a class="dropdown-item" href="{{route('makeStatutEncours.commande',$commande->id)}}">Encours</a>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="option burger">
                                                                            <div class="icon"></div>
                                                                            <a class="dropdown-item"  href="{{route('makeStatutNonlivre.commande',$commande->id)}}">annulée</a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            @elseif ($commande->statut ==='annulle')
                                                                <ul class="default_option">
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <p>Commande annulée</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <ul class="select_ul">
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <a class="dropdown-item" href="{{route('makeStatutEncours.commande',$commande->id)}}">Encours</a>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <a class="dropdown-item"  href="{{route('makeStatutLivre.commande',$commande->id)}}">Livré</a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            @else
                                                                <ul class="default_option">
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <p>commande en cours</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <ul class="select_ul">
                                                                    <li>
                                                                        <div class="option pizza">
                                                                            <div class="icon"></div>
                                                                                <a class="dropdown-item" href="{{route('makeStatutLivre.commande',$commande->id)}}">Livré</a>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="option burger">
                                                                            <div class="icon"></div>
                                                                            <a class="dropdown-item"  href="{{route('makeStatutNonlivre.commande',$commande->id)}}">annulée</a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>Action</td>
                                    </tr>
                                   @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
                $(".default_option").click(function(){
                  $(this).parent().toggleClass("active");
                })
                $(".select_ul li").click(function(){
                  var currentele = $(this).html();
                  $(".default_option li").html(currentele);
                  $(this).parents(".select_wrap").removeClass("active");
                })
            });

    </script>
@endsection
