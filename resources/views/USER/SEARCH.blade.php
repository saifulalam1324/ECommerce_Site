<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Live Search</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="p-3">

<form onsubmit="return false;" class="d-flex mb-2">
    <input type="text" id="search" class="form-control" placeholder="Search by category or model...">
</form>

<ul id="result" class="list-group position-absolute w-100"
    style="display:none;z-index:1000;"></ul>

<!-- ✅ Load full jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val().trim();

        if (!query) {
            $('#result').hide().empty();
            return;
        }

        $.ajax({
            url: "{{ route('Search') }}",
            type: "GET",
            data: { query: query },
            success: function(data) {
                $('#result').empty().show();
                if (data.length === 0) {
                    $('#result').append('<li class="list-group-item">No results found</li>');
                } else {
                    data.forEach(item => {
                        $('#result').append(`<li class="list-group-item">${item.category} - ${item.model}</li>`);
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search,#result').length) {
            $('#result').hide();
        }
    });
});

</script>

</body>
</html>
