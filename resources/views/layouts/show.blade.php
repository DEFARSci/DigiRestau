@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(App\Models\Notifications::count() > 0)
                @foreach ($notifications as $notification )
                    <div class="col-md-8">
                        <table class="table">
                            @if($notification->type === "commande_encours")
                                <tr>
                                    @foreach($users as $user)
                                        @if($user->id === $notification->sender)
                                            <span>{{ $notification->sending_date}}</span>
                                            <td class="col-md-6"> <i class="fa fa-check bg-success p-1 text-white" aria-hidden="true"></i> votre commande est en cours.<br/><span class="text-primary"> Merci a la prochaine!!!</span><br> Par {{ $user->name }}   </td>
                                            <td class="col-md-2">
                                                <a href = "{{ route('notification.delete',$notification->id) }}" class="btn btn-danger py-2">OK</a>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endif

                            @if($notification->type === "commande_annullee")
                                <tr>
                                    @foreach($users as $user)
                                        @if($user->id === $notification->sender)
                                            <span>{{ $notification->sending_date}}</span>
                                            <td class="col-md-6"> <i class="fa fa-check bg-success p-1 text-white" aria-hidden="true"></i> votre commande a été annulée.<br/><span class="text-primary"> Merci a la prochaine!!!</span><br> Par {{ $user->name }}</td>
                                            <td class="col-md-2">
                                                <a href = "{{ route('notification.delete',$notification->id) }}" class="btn btn-danger py-2">OK</a>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endif

                            @if($notification->type === "livree")
                                <tr>
                                    @foreach($users as $user)
                                        @if($user->id === $notification->created_at)
                                            <span>{{ $notification->sending_date}}</span>
                                            <td class="col-md-6"> <i class="fa fa-check bg-success p-1 text-white" aria-hidden="true"></i> votre commande a été livrée.<br/><span class="text-primary"> Merci a la prochaine!!!</span><br> Par {{ $user->name }}</td>
                                            <td class="col-md-2">
                                                <a href = "{{ route('notification.delete',$notification->id) }}" class="btn btn-danger py-2">OK</a>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endif

                        </table>
                    </div>
                @endforeach
            @else
                <p style="font-size:30px"  class="text-center font-weight-bold">Pas de notification</p>
            @endif
        </div>
    </div>
@endsection
