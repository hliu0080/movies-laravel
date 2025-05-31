<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Title</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("select").change(function(event) {
                if ($('select').val() !== 'Select') {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('highestSalesTheater') }}",
                        data: {
                            'date': $('select').val()
                        },
                        success: function(response) {
                            $('#result').text(response.theaterName);
                        }
                    });
                }
            });

            $("form").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('highestSalesTheater') }}",
                    data: {
                        'date': $('#date').prop('value')
                    },
                    success: function(response) {
                        $('#result').text(response.theaterName);
                    },
                    error: function(response) {
                        $('#result').text('ERROR: ' + response.responseJSON.message);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div style="display: grid; place-items: center;">
        <h1>Select or enter a date to find out which movie theater generated the most sales for that day:</h1>

        <form action="">
            <select>
                <option>Select</option>
                @foreach ($dates as $date)
                <option value={{ $date }}>{{ $date }}</option>
                @endforeach
            </select>

            <p>Or</p>
            <input type="date" id="date"/>

            <input type="submit" value="Submit">
        </form>

        <p id="result"></p>
    </div>
</body>
</html>
