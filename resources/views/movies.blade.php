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

            $("form").submit(function(event) {
                event.preventDefault();

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
            });
        });
    </script>
</head>
<body>
    <div>
        <h1>Select a date to find out which movie theater generated the most sales for that day:</h1>

        <form action="">
            <select>
                @foreach ($dates as $date)
                <option value={{ $date }}>{{ $date }}</option>
                @endforeach
            </select>
            <input type="submit" value="Submit">
        </form>

        <p id="result"></p>
    </div>
</body>
</html>
