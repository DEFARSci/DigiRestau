Bonjour,{{$user->name}}
@if($user->statut === 'client')

    <p>Votre compte <span style="color: green; font-weight:bold">{{ $user->statut }}</span> a bien été créé, mais il doit etre confirmé. Merci de cliquer sur le boutton suivant.</p>
    @component('mail::button',['url' => url("/verification/{$user->id}/{$user->is_actived}")])

    Validation du compte
    @endcomponent

    <p>Ou copier/coller le lien dans votre navigateur pour verifier L' adresse email</p>

    <p><a href="{{url("/verification/{$user->id}/{$user->is_actived}")}}">{{url("/verification/{$user->id}/{$user->is_actived}")}}</a></p>
@endif

Djereudjef<br>
{{ config('app.name') }}

