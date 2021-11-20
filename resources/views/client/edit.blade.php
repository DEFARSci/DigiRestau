@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>
        <div class="col-md-8">
            <form method="POST" action="{{ route('client.updateCompte', $user) }}" enctype = "multipart/form-data">
                @csrf
                @method('PATCH')
            <div class="card" style="border-radius: 20px;">
                <div class="text-center font-weight-bold mt-4"  style="color:#3b5998; font-size:20px">{{ __('LOGO') }}</div>
                <hr>
                <div class="card-body">
                        <div class="form-group row">
                            {{-- <div class="col-md-8 offset-md-2 justify-content-center"> --}}
                            <div class="col-md-4 offset-md-1 justify-content-center ">
                                @if($user->client->client_photo != null)
                                    <img src="/photoProfile/{{ $user->client->client_photo }}" alt="profile" class="rounded-circle" width="100" height="100">
                                    @else
                                    <img src="{{asset('photoProfile/default.jpg')}}" alt="profile" class="rounded-circle" width="100" height="100">
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="file-ip-1" class="">Choisissez une image</label>
                                <input type="file" id="file-ip-1" onchange="showPrevent(event);" class=" @error('client_photo') is-invalid @enderror" name="client_photo">
                                @error('client_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="preview">
                                        <img id="file-ip-1-preview" class="imgFile" />
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
            <br/>
            <div class="card" style="border-radius: 20px;">
                <div class="text-center font-weight-bold mt-4"  style="color:#3b5998; font-size:20px">{{ __('Profil') }}</div>
                <hr>
                <div class="card-body">
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <label>Nom</label>
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom" name="nom" value="{{ old('nomE') ?? $user->nameE }}"  required>

                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <label>Email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') ?? $user->email }}"  required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @foreach($comptes as $profile)
                        @if($user->id === $profile->user_id)
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8 ">
                                    <label>Telephone</label>
                                    <input id="client_numero" type="text" class="form-control @error('client_numero') is-invalid @enderror" placeholder="Telephone" name="client_numero" value="{{ old('client_numero') ?? $profile->client_numero }}" required>

                                    @error('client_numero')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <label>Adresse</label>
                                    <input id="client_adresse" type="text" class="form-control @error('client_adresse') is-invalid @enderror" placeholder="Adresse" name="client_adresse" value="{{ old('client_adresse') ?? $profile->client_adresse }}" required>

                                    @error('client_adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row offset-md-1 justify-content-center">
                                <div class="col-md-4">
                                    <label for="latitude" class="">{{ __('latitude') }}</label>

                                    <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ $profile->latitude }}" required>

                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password" class="">{{ __('longitude') }}</label>

                                    <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ $profile->longitude }}" required>

                                        @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-2" style="margin-top:30px">
                                    <a  class="btn btn-success" id="btnLocalisation" class="btn btn-primary">
                                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn text-white" style="background-color:#3b5998">
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection
