@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach

                    <table class="table">
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Email</td>
                                <td>Statut</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            @if($user->statut == 'enseigne')
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->approved == 0)
                                            Inactive
                                        @else
                                            Active
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('approved', $user->id) }}">
                                            @if($user->approved ==1)
                                                Inactive
                                            @else
                                                Active
                                            @endif
                                        </a>
                                        <a href="#">Supprimer</a>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
