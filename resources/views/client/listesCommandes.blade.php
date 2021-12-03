@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <h1> {{ App\Models\Commande::count()}} Commandes</h1>
                @foreach ($commandes as $commande )
                    <div class="card" style="margin-top:10px ">
                        <div class="card-header">N` {{ $commande->id }}</div>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <td>Produits</td>
                                        <td>Nom</td>
                                        <td>Prix</td>
                                        <td>Quantite</td>
                                        <td>Enseigne</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @foreach ($commande->carts as $cart )
                                    @php $total += $cart['price'] * $cart["qty"] @endphp
                                        <tr>
                                            <td>

                                             <img src="{{asset('storage/defaultImage.jpg')}}" alt="profile"  height="70">

                                            </td>
                                            <td>{{$cart["name"] }}</td>
                                            <td>{{$cart["price"] }}</td>
                                            <td>{{$cart["qty"] }}</td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $commande->id }}">
                                                    Voir
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $commande->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Informations enseigne</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <td>Nom</td>
                                                                        <td>Adresse</td>
                                                                        <td>Telephone</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $commande->enseigne->name }}</td>
                                                                        <td>{{ $commande->enseigne->etablissement->etablissement_adresse }}</td>
                                                                        <td>{{ $commande->enseigne->etablissement->etablissement_numero_tel }}</td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <strong>Total: {{ $total }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Produits</td>
                            <td>Nom</td>
                            <td>Prix</td>
                            <td>Quantite</td>
                            <td>Enseigne</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $commande)
                            @if(Auth::user()->id == $commande->commande_user_id)
                                <tr>
                                    <td>
                                        @if($commande->consommations->consommation_image != null)
                                        <img src="{{asset('storage'.'/'.$commande->consommations->consommation_image)}}" height="70">
                                        @else
                                            <img src="{{asset('storage/conso.png')}}" alt="profile"  height="70">
                                        @endif
                                    </td>
                                    <td>{{ $commande->consommations->consommation_titre }}</td>
                                    <td>{{ $commande->option }}</td>
                                    <td>{{ $commande->user->optionCommandes->quantite }}</td>
                                    <td>{{ $commande->enseigne->name }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection --}}
