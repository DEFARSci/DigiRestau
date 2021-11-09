Bonjour,{{$user->name}}
@if($user->statut == 'client')
@component('mail::button',['url' => route('verification_user',$user->is_actived)])

Validation du compte
@endcomponent

<p>Ou copier/coller le lien dans votre navigateur pour verifier L' adresse email</p>

<p><a href="{{route('verification_user',$user->is_actived)}}">{{route('verification_user',$user->is_actived)}}</a></p>
@endif

Djereudjef<br>
{{ config('app.name') }}

