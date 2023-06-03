<div>
    <nav class="navbar navbar-light bg-light border-b-2  justify-content-center">
        <div class="container">
                <span class="navbar-brand mb-0 h1">Categories List</span>
                <button type="button" class="btn btn-sm btn-primary"  wire:click.prevent="addCategory">
                Add Category
                </button>
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
                            <button type="button" class="btn btn-primary btn-sm"  wire:click="edit({{ $category->id }})">
                                <i class="bi bi-pencil-square"></i>
                            </button>
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

    <!-- Create Modal-->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <form wire:submit.prevent="store">
                <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>category name</label><br>
                            <input type="text" wire:model.defer="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="enter the title">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">description</label>
                            <textarea wire:model.defer="description" name="description" class="form-control" id="exampleInputEmail1" placeholder="описание.."></textarea>
                        </div>
                        <div wire:ignore class="form-group">
                            <label>select parent category</label><br>
                            <select class="form-control" wire:model.defer="paren_id" id="select2" name="parent_id" style="width: 70%;" required>
                                <option value="" disabled>select subcategories...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <form wire:submit.prevent="update">
                <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыт"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>category name</label><br>
                            <input type="text" wire:model.defer="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="enter the title">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">description</label>
                            <textarea wire:model.defer="description" name="description" class="form-control" id="exampleInputEmail1" placeholder="описание.."></textarea>
                        </div>
                        <div wire:ignore class="form-group">
                            <label>select parent category</label><br>
                            <select class="form-control" wire:model.defer="paren_id" id="select2_edit" name="parent_id" style="width: 70%;" required>
                                <option value="" disabled>select subcategories...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
</div>

@push('scripts')
<script>
    window.livewire.on('open-create-modal', () => {
        $('#createModal').modal('show');

        $('#select2').select2({
            theme: "bootstrap-5",
            dropdownParent: $('#createModal')
        });
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2("val");
            @this.set('parent_id', data);
        });
    })


    window.livewire.on('open-edit-modal', () => {
          $('#editModal').modal('show');

          $('#select2_edit').select2({
            theme: "bootstrap-5",
            dropdownParent: $('#editModal')
          });
      $('#select2_edit').on('change', function (e) {
          var data = $('#select2_edit').select2("val");
          @this.set('parent_id', data);
      });
          
  })

    window.addEventListener('created', event => {
        $('#createModal').modal('hide');

    })

     window.addEventListener('updated', event => {
        $('#editModal').modal('hide');
        // toastr.info(event.detail.message, 'Info!');
    })
    
</script>

<script>
  window.addEventListener('delete-confirm', event => {
    Swal.fire({
      title: 'Вы уверены?',
      text: "Вы не сможете вернуть это!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'отмена',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Да, удалить!'
    }).then((result) => {
    if (result.isConfirmed) {
      Livewire.emit('deleteConfirmed')
      }
    })
  })

  window.addEventListener('deleted', event => {
    Swal.fire(
      'Удалено!',
      event.detail.message,
      'success'
    )
  })
</script>

@endpush
