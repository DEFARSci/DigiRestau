<div class="container">
    <div class="">
        <form class="d-flex">
            <input class="form-control me-2 typeahead"  type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
 </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        var path = "{{ url('search-automatic') }}";

        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { terms: query }, function (data) {
                    return process(data);
                });
            }
        });

        $('input')
    </script>
