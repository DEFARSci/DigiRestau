<div class="container">
    <div class="">
        <form class="d-flex" action="{{ route('autocomplete') }}" method="GET">
            <input type="text" id="search" name="search" value="{{ request()->search ?? '' }}" placeholder="Search" class="form-control" />
        </form>
    </div>
 </div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
 <script type="text/javascript">
    var route = "{{ route('autocomplete') }}";
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });

</script>
