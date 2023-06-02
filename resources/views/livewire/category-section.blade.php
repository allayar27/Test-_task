<div>
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>
{{--            @foreach($categories as $category)--}}
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" width="2%">#</th>
                    <th scope="col" width="7%">название</th>
                    <th scope="col" width="7%">описание</th>
                    <th scope="col" width="7%">количество подкатегорий</th>
                    <th scope="col" width="7%">количество товаров</th>
                    <th scope="col" width="7%">родительская категория</th>
                    <th scope="col" width="1%" colspan="2">действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->count_subcategories }}</td>
                        <td>{{ $category->count_products }}</td>
                        <td>{{ $category->parent ? $category->parent->name : 'Нет' }}</td>
                        <td>
                            <a href="" type="submit">
                                <i class="bi bi-pencil-square" style="font-size: 1rem; color: blue;"></i>
                            </a>
                        </td>
                        <form action="" method="post">
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
                            <td>
                                <button type="submit">
                                    <i class="bi bi-trash" style="font-size: 1rem; color: red;"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center" class="px-6 py-4 whitespace-no-wrap text-sm leading">
                            {{ __('No data not found') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>


</div>
