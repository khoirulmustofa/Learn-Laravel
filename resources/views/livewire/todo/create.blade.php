<div>
    <form>
        @csrf
        <div class="input-group mb-3">
            <input type="text" wire:model="name" class="form-control" placeholder="Your todo ..." aria-describedby="basic-addon2">
            <span id="basic-addon2"><button wire:click.prevent="create" type="submit" class="btn btn-success">Save</button></span>
        </div>
    </form>
    @error('name')
    <code>{{ $message }}</code>
    @enderror
</div>