@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">
            <button class="btn btn-outline-primary" onclick="imprimer()">Imprimer ce Qrcode</button>
            <div id="qrcode" class="py-4">
                <img src="data:image/png;base64, {!! base64_encode($qrcode) !!} "><br/>
            </div>
           </div>
       </div>
    </div>

    <script>
        function imprimer()
        {
        var partiImrimer = document.getElementById('qrcode');
        var newFenetre = window.open('','Print-Window');
        newFenetre.document.open();

        newFenetre.document.write('<html><body onload="window.print()">'+partiImrimer.innerHTML+'</body></html>');
        newFenetre.document.close();
        }
    </script>
@endsection
