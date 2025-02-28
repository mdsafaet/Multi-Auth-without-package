<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>




{{-- <script>
 

    $(document).ready(function () {

        
        $('#productForm').submit(function (e) {
            e.preventDefault();
      

           
            var form = $('#productForm')[0];
            var data = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '/api/products', 
                data: data,
                contentType: false, 
                processData: false, 
                success: function (response) {
                    $('#productForm')[0].reset();
                    $('#formResponse').html('<div class="alert alert-success">Product has been uploaded successfully.</div>');
                    $('#exampleModal').modal('hide');
                },
                error: function (response) {
                                   alert('Failed to upload product.');
                                $('#formResponse').html('<div class="alert alert-danger">Failed to upload product.</div>');
                            }
                            
            });
        });
    });
</script> --}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        $('#productForm').on('submit', function(e){
            e.preventDefault();

           
            var form = $('#productForm')[0];
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '/api/products', 
                data: formData,
                contentType: false, 
                processData: false, 
                success: function (response) {
              
                    $('#productForm')[0].reset();
                    $('#formResponse').html('<div class="alert alert-success">Product has been uploaded successfully.</div>');
                    $('#exampleModal').modal('hide');
                    location.reload();
                },
                error: function (response) {
                                   alert('Failed to upload product.');
                                $('#formResponse').html('<div class="alert alert-danger">Failed to upload product.</div>');
                            }
                            
            });
      

        });

    });
</script>













<script>


$(document).ready(function () {

// CSRF Token setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Populate modal with product data
$('.editProduct').on('click', function (e) {
    e.preventDefault();

    let id = $(this).data('id');
    $('#Update_id').val(id);
    $('#upproductName').val($(this).data('name'));
    $('#upproductPrice').val($(this).data('price'));
    $('#upproductquantity').val($(this).data('quantity'));
});

// Handle product update
$('#updateproductForm').on('submit', function (e) {
    e.preventDefault();

    let id = $('#Update_id').val();
    let formData = new FormData(this);
    formData.append('_method', 'PUT'); // Properly append the _method for Laravel

    $.ajax({
        type: 'POST',
        url: '/api/products/' + id, 
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#upformResponse').html('<div class="alert alert-success">✅ Product updated successfully.</div>');
            $('#upexampleModal').modal('hide');
            location.reload();
        },
        error: function (response) {
            alert('❌ Failed to update product.');
            $('#upformResponse').html('<div class="alert alert-danger">❌ Failed to update product.</div>');
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