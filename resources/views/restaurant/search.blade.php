<div class="container">
        <form class="d-flex" action="{{ route('autocomplete') }}" method="GET">
            <input type="text" id="search" class="form-control" name="search" value="{{ request()->search ?? '' }}" placeholder="Rechercher une enseigne"/>
        </form>
 </div>

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
