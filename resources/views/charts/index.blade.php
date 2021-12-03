@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="customRange1">Année : &nbsp</label>
          @foreach ($years as $year)
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="{{ $year }}" name="year" class="custom-control-input" value="{{ $year }}" @if($actualYear == $year) checked @endif>
              <label class="custom-control-label" for="{{ $year }}">{{ $year }}</label>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div id="ordersChart" style="height: 300px;" class="card-body">
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    const OrdersChart = new Chartisan({
      el: '#ordersChart',
      url: "@chart('chart_static')" + '?year={{ $actualYear }}',
      hooks: new ChartisanHooks()
        .colors(['#c33','red'])
        .responsive()
        .beginAtZero()
    });

    $('input').change(function() {
      let year = $("input[name='year']:checked").val();
      let param = '?year=' + year;;
      OrdersChart.update({
        url: "@chart('chart_static')" + param
      });
      window.history.replaceState('', '', '/statistic/' + year);

    });
  });
</script>
@endsection
