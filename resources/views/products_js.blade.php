<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>




<script>
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        // Handle form submission
        $('#productForm').submit(function (e) {
            e.preventDefault();

            // Use FormData to capture form inputs
            var form = $('#productForm')[0];
            var data = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '/api/products', // Ensure you set the correct URL
                data: data,
                contentType: false, // Required for FormData
                processData: false, // Required for FormData
                success: function (response) {
                    $('#productForm')[0].reset();
                    $('#formResponse').html('<div class="alert alert-success">Product has been uploaded successfully.</div>');
                  
                    // Optionally, close the modal after success
                    $('#exampleModal').modal('hide');
                },
                error: function (response) {
                                   alert('Failed to upload product.');
                                $('#formResponse').html('<div class="alert alert-danger">Failed to upload product.</div>');
                            }
            });
        });
    });
</script>

















<!---- Delete  --->

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
   $(document).on('click', '.delete_product', function(e) {
        e.preventDefault();

        let productId = $(this).data('id');  // Get product ID

        // Show delete confirmation modal
        $('#deleteProductModal').modal('show');

        // Confirm deletion
        $('#deleteProductConfirmBtn').off().on('click', function() {
            $.ajax({
                url: "{{ url('api/products') }}/" + productId,
                method: 'DELETE',
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                        $('#deleteProductModal').modal('hide');
                        location.reload();  // Reload the page to reflect deletion
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while deleting the product.');
                }
            });
        });
    });

</script>