<div class="container">
    <div class="">
        <form class="d-flex" action="{{ route('autocomplete') }}" method="GET">
                <input class="form-control me-2 typeahead" name="query" value="{{ request()->query("query") }}"  type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
 </div>
 <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

</script>
