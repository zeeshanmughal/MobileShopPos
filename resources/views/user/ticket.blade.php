@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Assuming you have a form with appropriate input fields
    // You can attach this function to an event like a button click
    $('#yourButton').click(function() {
        var duration = $('#duration').val(); // Assuming you have an input field with id 'duration'
        var rows = $('#rows').val(); // Assuming you have an input field with id 'rows'

        $.ajax({
            url: 'your-route-url', // Replace with the actual route URL
            type: 'post', // or 'get' depending on your implementation
            data: {
                duration: duration,
                rows: rows,
                // Add other data if needed
            },
            success: function(response) {
                // Handle the response here
                console.log(response);
            },
            error: function(error) {
                // Handle any errors here
                console.error(error);
            }
        });
    });
</script>


@endpush