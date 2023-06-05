<div>
    <nav class="navbar navbar-light bg-light border-b-2  justify-content-center">
        <div class="container">
                <span class="navbar-brand mb-0 h1">Categories List</span>
                <a href="{{ route('category.create') }}" type="button" class="btn btn-sm btn-primary">
                Add Category
                </a>
        </div>
    </nav>
    <section class="mb-auto">
        <div class="container overflow-hidden">
            <div class="row mb">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">category name</th>
                        <th scope="col">description</th>
                        <th scope="col">subcategories count</th>
                        <th scope="col">products count</th>
                        <th scope="col">parent category</th>
                        <th scope="col" width="2%" colspan="2">actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @forelse($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->children_count }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}" type="button" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm"  wire:click="deleteConfirm({{ $category->id }})">
                               <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center" class="px-6 py-4 whitespace-no-wrap text-sm leading">
                                {{ __('No data not found') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

</section>
</div>

@push('scripts')
<script>
  window.addEventListener('delete-confirm', event => {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
      Livewire.emit('deleteConfirmed')
      }
    })
  })

  window.addEventListener('deleted', event => {
    Swal.fire(
      'Deleted!',
      event.detail.message,
      'success'
    )
  })
</script>

@endpush
