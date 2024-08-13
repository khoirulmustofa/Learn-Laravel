<table class="table">
    <thead class="table-light">
        <tr>
            <th scope="col">No</th>
            <th scope="col"></th>
            <th scope="col">Todo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($todos as $index => $todo)
        <tr wire:key="{{ $todo->id }}">
            <td>{{ (($todos->currentPage() - 1) * $todos->perPage()) + $index + 1 }}</td>
            <td>
                @if ($todo->completed)
                <input class="form-check-input" wire:click='toggle({{ $todo->id }})' class="mr-2" type="checkbox" checked>
                @else
                <input class="form-check-input" wire:click='toggle({{ $todo->id }})' class="mr-2" type="checkbox">
                @endif
            </td>
            <td>

                @if ($todoId === $todo->id)
                <div>
                    <input wire:model='newName' type="text" class="form-control" placeholder="Update todo ..">
                    @error('newName')
                    <code>{{ $message}}</code>
                    @enderror
                </div>

                @else
                @if ($todo->completed)
                <p class="fw-semibold text-decoration-line-through">{{ $todo->name }}</p>
                @else
                <p class="fw-semibold">{{ $todo->name }}</p>
                @endif
                
                <p class="fw-light">{{ $todo->created_at }}</p>
                @endif


            </td>
            <td>

                @if ($todoId === $todo->id)
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button wire:click="update" type="button" class="btn btn-success">Update</button>
                    <button wire:click="cancel" type="button" class="btn btn-secondary">Cancel</button>
                </div>
                @else
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button wire:click="edit({{ $todo->id }})" type="button" class="btn btn-warning">Edit</button>
                    <button wire:click="delete({{ $todo->id }})" wire:confirm="Are you sure you want to delete this todo?" type="button" class="btn btn-danger">Delete</button>
                </div>
                @endif

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-danger text-center">Data not found</td>
        </tr>
        @endforelse


    </tbody>
</table>