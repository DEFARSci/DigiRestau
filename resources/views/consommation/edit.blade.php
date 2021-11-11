@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>

                    <form method="post" action="{{ route('update-option', $options->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <label>Consommation</label>
                                <select class="form-select" aria-label="" name="conso_id">
                                    @foreach ($conso as $cat )
                                        <option value="{{ $cat->id }}" >{{ $cat->consommation_titre }}</option>
                                    @endforeach
                                </select>
                                @error('categorie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <label>Nom</label>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nom"  value="{{ $options->option_conso_titre }}" required>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <label>Description</label>
                                <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description">{{ $options->option_conso_description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <label>Prix</label>
                                    <input id="prix" type="text" class="form-control @error('title') is-invalid @enderror" name="prix" placeholder="Prix"  value="{{ $options->option_conso_prix }}" required>

                                    @error('prix')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter') }}
                                </button>
                            </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

