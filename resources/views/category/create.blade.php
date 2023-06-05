@extends('layouts.app')

@section('content')


<div class="row g-5">
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Create Category</h4>
        <form action="{{ route('category.store') }}" class="needs-validation" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-6">
              <label for="name" class="form-label">category name</label>
              <div class="input-group has-validation">
                <input type="text" name="name" class="form-control" id="name" placeholder="Username" required>
                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
              <label for="exampleInputEmail1" class="form-label">description</label>
              <textarea name="description" class="form-control" id="exampleInputEmail1" placeholder="description.."></textarea>
              </div>
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-control" id="select2" name="parent_id" style="width: 100%;" required>
                  @foreach($parentCategories as $parentCategory)
                      <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <hr class="my-4">
          <div class="col-6">
              <a href="{{ route('home') }}" type="submit" class="btn btn-danger">Cancel</a>
              <button type="submit" class="btn btn-success">Save</button>
          </div>
          
          

        </form>
      </div>
    </div>
@endsection

@push('scripts')

<script>

  $(document).ready(function() {
        $('#select2').select2({
            theme: "bootstrap-5",
             placeholder: "Select a parent category",
            // allowClear: true
        })
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2('val');
            
        })
  });

</script>

@endpush