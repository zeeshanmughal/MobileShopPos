@push('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function searchCustomer() {
        var firstName = $('#first_name').val();
        var lastName = $('#last_name').val();

        $.ajax({
            url: '/search-customer', // Replace with the actual route URL
            type: 'post', // or 'get' depending on your implementation
            data: {
                first_name: firstName,
                last_name: lastName,
            },
            success: function(response) {
                // Handle the response here
                $('#customerData').html(response);
            },
            error: function(error) {
                // Handle any errors here
                console.error(error);
            }
        });
    }
</script>


@endpush