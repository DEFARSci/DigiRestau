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

                    <form method="post" action="{{ route('update-cat', $categories->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group row justify-content-center">
                                <div class="col-md-8">
                                    <label>Nom</label>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nom"  value="{{ $categories->categorie_nom }}" required>

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
                                <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" required>{{ $categories->categorie_description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div style="text-align: center">
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

