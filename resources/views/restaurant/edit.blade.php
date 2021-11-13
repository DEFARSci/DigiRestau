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
            <form method="POST" action="{{ route('restaurant.updateCompte', $user) }}" enctype = "multipart/form-data">
                @csrf
                @method('PATCH')
            <div class="card" style="border-radius: 20px;">
                <div class="text-center font-weight-bold mt-4"  style="color:#3b5998; font-size:20px">{{ __('Avatar') }}</div>
                <hr>
                <div class="card-body">
                        <div class="form-group row">
                            {{-- <div class="col-md-8 offset-md-2 justify-content-center"> --}}
                               <div class="col-md-4 offset-md-1 justify-content-center ">
                                @if($user->etablissement->etablissement_logo != null)
                                <img src="/photoProfile/{{ $user->etablissement->etablissement_logo }}" alt="profile" class="rounded-circle" width="100" height="100">
                              @else
                                <img src="{{asset('photoProfile/default.jpg')}}" alt="profile" class="rounded-circle" width="100" height="100">
                             @endif
                               </div>
                               <div class="col-md-4">
                                <label for="file-ip-1" class="">Choisissez une image</label>
                                <input type="file" id="file-ip-1" onchange="showPrevent(event);" class=" @error('etablissement_logo') is-invalid @enderror" name="etablissement_logo">
                                @error('etablissement_logo')
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
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom" name="nom" value="{{ old('nom') ?? $user->nameEnseigne }}"  required>

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
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8 ">
                                <label>Type</label>
                                {{-- <input type="text" value="{{ $user->type }}" class="form-control @error('type') is-invalid @enderror" required> --}}

                                <select class="form-select @error('type') is-invalid @enderror" name="type" >
                                    @if($user->type )
                                    {{-- <option selected>{{ $user->type }}</option> --}}
                                    <option >Restaurant</option>
                                    <option >Cafe</option>
                                    <option >Terasse</option>
                                    @endif

                              </select>
                                @error('type')
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
                                    <input id="etablissement_numero_tel" type="text" class="form-control @error('etablissement_numero_tel') is-invalid @enderror" placeholder="Telephone" name="etablissement_numero_tel" value="{{ old('etablissement_numero_tel') ?? $profile->etablissement_numero_tel }}"  autocomplete="etablissement_numero_tel" required>

                                    @error('etablissement_numero_tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <label>Adresse</label>
                                    <input id="etablissement_adresse" type="text" class="form-control @error('etablissement_adresse') is-invalid @enderror" placeholder="Adresse" name="etablissement_adresse" value="{{ old('etablissement_adresse') ?? $profile->etablissement_adresse }}" required>

                                    @error('etablissement_adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row offset-md-1 justify-content-center">
                                <div class="col-md-4">
                                    <label for="latitude" class="">{{ __('latitude') }}</label>

                                    <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') ?? $profile->latitude }}">

                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password" class="">{{ __('longitude') }}</label>

                                    <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{old('longitude') ?? $profile->longitude }}">

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
