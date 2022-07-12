<div class="col-xl-4 col-md-6 mb-4" style="height: 400px ;">
    <div class="card border-left-primairy shadow h-100 py-2" style="height: 390px ;">
        <div class="card-body">

            <div class="col-lg-12" id = "list">

                <div class="form-group">
                    <label class="form-control-label" for="client">Product</label>
                    <select name="listing" id="listing" class="form-control form-control-user" required>
                        @foreach ($listings as $listing)
                        <option value="$listing->id">{{$listing->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-control-label" for="quantity">Quantity</label>
                    <input type="number" step="1" class="form-control form-control-user" name="quantity" placeholder="{{ __('0') }}" value="{{ old('quantity') }}" required>
                </div>


                <div class="form-group">
                    <label class="form-control-label" for="price">Discount</label>
                    <input type="number" step="0.01" class="form-control form-control-user" name="discount" placeholder="{{ __('0.00') }}" value="{{ old('discount') }}" required>
                </div>

                <div class="form-group" id="btn">
                    <button type="button" class="btn btn-primary btn-user btn-block">
                        <i class="bi bi-plus-circle"></i> Add Product
                    </button>
                </div>






            </div>

        </div>

    </div>
</div>