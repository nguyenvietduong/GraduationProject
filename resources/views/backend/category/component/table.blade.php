<table class="table mb-0 checkbox-all" id="datatable_1">
    <thead class="table-light">
        <tr>
            <th style="width: 16px;">
                <div class="form-check mb-0 ms-n1">
                    <input type="checkbox" class="form-check-input" name="select-all" id="select-all">
                </div>
            </th>
            <th>Category Name</th>
            <th>Parent ID</th>
            <th>Created At</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($categories_back) && is_object($categories_back) && $categories_back->isNotEmpty())
            @foreach ($categories_back as $category)
                <tr>
                    <td style="width: 16px;">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="{{ $category->id }}" name="check"
                                id="customCheck{{ $category->id }}">
                        </div>
                    </td>
                    <td>
                        {{ $category->name ?? 'No data available' }}
                    </td>
                    <td>
                        {{ $category->parent ? $category->parent->name : 'No data available' }}
                    </td>
                    <td>
                        <span>{{ date('d/m/Y H:i:s', strtotime($category->created_at)) }}</span>
                    </td>
                    <td class="text-center">
                        <!-- Example Trigger for category -->
                        <div class="d-flex align-items-center">
                            <!-- Trigger Modal -->
                            <i class="fas fa-eye btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#modal" data-modal-type="category"
                                data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}"
                                data-category-parent="{{ $category->parent ? $category->parent->name : 'No data available' }}"
                                data-category-created="{{ $category->created_at->format('d/m/Y H:i:s') }}"
                                data-category-updated="{{ $category->updated_at->format('d/m/Y H:i:s') }}">
                            </i>

                            <!-- Link to Edit category -->
                            <a href="{{ route('admin.category.edit', $category->id) }}" class="me-2">
                                <i class="fas fa-edit btn btn-primary btn-sm"></i>
                            </a>

                            <!-- Form for Delete category -->
                            <form id="myFormDelete-{{ $category->id }}"
                                action="{{ route('admin.category.destroy', $category->id) }}" method="post"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmAndSubmit('myFormDelete-{{ $category->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>
</table>
<!-- Add pagination links -->
<div class="pagination-container">
    {{ $categories_back->links() }}
</div>
