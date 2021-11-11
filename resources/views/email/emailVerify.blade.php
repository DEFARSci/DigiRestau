Bonjour,{{$user->name}}
@if($user->statut === 'client')

<p>Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page,</p>

@component('mail::button',['url' => route('verification_user',$user->is_actived)])

Validation du compte
@endcomponent

<p>Ou copier/coller le lien dans votre navigateur pour verifier L' adresse email</p>

<p><a href="{{route('verification_user',$user->is_actived)}}">{{route('verification_user',$user->is_actived)}}</a></p>
@endif

Djereudjef<br>
{{ config('app.name') }}

