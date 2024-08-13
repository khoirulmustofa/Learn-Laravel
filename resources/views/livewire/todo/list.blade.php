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

                <p class="fw-semibold">{{ $todo->name }}</p>
                <p class="fw-light">{{ $todo->created_at }}</p>
            </td>
            <td>
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" class="btn btn-warning">Edit</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-danger text-center">Data not found</td>
        </tr>
        @endforelse


    </tbody>
</table>