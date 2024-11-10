<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Product CRUD</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>

        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Create Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Product ID</label>
                                <input value="{{ old('product_id') }}" type="text" class="@error('product_id') is-invalid @enderror form-control" placeholder="Product ID" name="product_id">
                                @error('product_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control" placeholder="Name" name="name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea placeholder="Description" class="form-control" name="description"   cols="20" rows="5"> {{ old('description') }} </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Price</label>
                                <input value="{{ old('price') }}" type="number" class="@error('price') @enderror form-control" placeholder="Price" name="price">
                                @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Stock</label>
                                <input type="text" class="form-control" placeholder="Stock" name="stock">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control" placeholder="Name" name="image">
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                            
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>