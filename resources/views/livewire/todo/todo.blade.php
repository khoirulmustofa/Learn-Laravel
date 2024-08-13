<div>
    @if (session('success'))
    <div class="alert alert-success p-2" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger p-2" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">List Todo</span>
                <span class="badge bg-primary rounded-pill">{{ $todos->total() }}</span>
            </h4>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search here ...">
            <hr>
            @include('livewire.todo.list')
            {{ $todos->links() }}
        </div>
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Create Todo</span>
            </h4>
            @include('livewire.todo.create')
        </div>

    </div>
</div>