@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
        <!-- Generer -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Generer un qr code
    </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remplir les informations</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Creer un Qr code') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('add') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="table" class="col-md-4 col-form-label text-md-right">{{ __('Table') }}</label>

                                    <div class="col-md-6">
                                        <input id="table" type="text" class="form-control @error('table') is-invalid @enderror" name="table" required>

                                        @error('table')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dureef" class="col-md-4 col-form-label text-md-right">{{ __('Heure de fin') }}</label>

                                    <div class="col-md-6">
                                        <input id="duree" type="time" class="form-control @error('dureef') is-invalid @enderror" name="dureef" required>

                                        @error('dureef')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Generer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Afficher les informations --}}
  <div class="row justify-content-center py-4">
      <div class="col-md-8">
          <table class="table text-center">
                <thead>
                    <tr>
                        <td>Table</td>
                        <td>Heure d'expiration</td>
                        <td>Date de Generation</td>
                        <td>Scanner</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tokens as $token )
                        <tr>
                            <td>{{ $token->token_order_table }}</td>
                            <td>{{ $token->token_order_duration_fin }}</td>
                            <td>{{ $token->created_at }}</td>
                            <td>
                                    <a href="{{ route('showQrCode',$token->id) }}" class="btn btn-success">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
          </table>
      </div>
  </div>
</div>
@endsection
