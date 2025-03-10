<!-- Update Product Modal -->
<div class="modal fade" id="upexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form inside Modal -->
            <form id="updateproductForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="Update_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="upproductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="upproductName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="upproductPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="upproductPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="upproductimage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="upproductimage" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="upproductquantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="upproductquantity" name="quantity" required>
                    </div>
                    <div id="upformResponse" class="mt-2"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary updateproduct">Update Product</button>
                </div>
            </form>

        </div>
    </div>
</div>