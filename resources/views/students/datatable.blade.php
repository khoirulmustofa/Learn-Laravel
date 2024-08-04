<div class="card-body">
    {{ $dataTable->table() }}
</div>

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush