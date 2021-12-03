@extends('layouts.app')

@section('content')
    @if(Cart::count() > 0)
    <div class="container">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produits</th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Quantite</th>
                            <th>Sous Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                       @foreach (Cart::content() as $conso)

                       @php $total += $conso->price * $conso->qty @endphp
                            <tr>
                                <td>
                                    @if($conso->consommation_image != null)
                                        <img src="{{ $conso->consommation_image }}" height="80px"/>
                                    </td>
                                    @else
                                        <img src="{{asset('storage/conso.png')}}" alt="profile" height="80px">
                                    @endif
                                </td>
                                <td>{{ $conso->name }}</td>
                                <td>{{ $conso->price }}</td>
                                <td>
                                    {{-- <input type="number" class="form-control" value="{{ $conso->qty }}" min="1" max="100" name="qty" ><br/> --}}
                                    <select name="qty" id="qty" class="custom-select" data-id="{{ $conso->rowId }}">
                                        @for ($i =1 ; $i <= 10 ; $i++)
                                            <option value="{{ $i }}" {{ $i == $conso->qty ? 'selected' : ''}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>

                                <td  id="subtotal{{ $conso->id }}" class="sousTotal">{{  $conso->price * $conso->qty  }}</td>
                                <td>
                                    <form action="{{ route('panier-delte',$conso->rowId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    <h4 id="total">Total: {{ $total }}</h4>
                </div>
            </div>
        </div>
        <div class="center">
            <form method="POST" action="{{ route('commander-final') }}">
                @csrf
                <input id="enseigne" type="hidden" class="form-control" value="{{$conso->options->enseigne_id}}" name="enseigne_id" autocomplete="enseigne_id" autofocus>
                <input id="type" type="hidden" class="form-control" value="{{$conso->options->type_livraison}}" name="type" autocomplete="type" autofocus>
                <input id="numero" type="hidden" class="form-control" value="{{$conso->options->numero}}" name="numero" autocomplete="numero" autofocus>

                <button type="submit" class="btn btn-success">Finaliser votre commande</button>

            </form>
        </div>
    </div>
    @else
        <div class="text-center">
            <p> Votre panier est vide </p>
        </div>
    @endif
    <script>
        (function(){
           const selects =  document.querySelectorAll('#qty')
           Array.from(selects).forEach((element) => {
                element.addEventListener('change', function () {
                    const rowId = element.getAttribute('data-id')
                    axios.patch(`/panierQte/${rowId}`, {
                        qty : this.value
                    }).then(function (response) {
                        console.log(response)
                       location.reload()
                    }).catch(function (error){
                        console.log(error)
                    })
                })
           })
        })();

        // function getQte(id, price)
        // {
        //     var selects =  document.querySelectorAll('#qty'+id)[0];
        //     var value = selects.options[ selects.selectedIndex].value

        //    // var optionQte = document.getElementById('qteSelect'+id);
        //     var subtotal = value * price;
        //     document.getElementById("subtotal"+id).innerHTML = '<td id="subtotal'+id+'">'+subtotal+'</td>'


        //    //var input = document.getElementById("qte"+id).value = '<input type="hidden" name="quantite" id="qte'+id+'">'
        //     console.log(id)
        //     getTotal();
        //     console.log(document.getElementById("qte"+id))

        // }

        // function getTotal()
        // {
        //     var sousTotal = document.querySelectorAll(".sousTotal");
        //     var total = 0;
        //     sousTotal.forEach(element => {
        //         total += parseInt(element.innerText)
        //     });

        //     document.getElementById("total").innerHTML = '<h4 id="total">'+total+'</td>'


        //     // console.log(sousTotal)
        //     // console.log(total)
        // }
    </script>
@endsection
