<div>
    <h6 class="w-100">UPDATE</h6>
    <input type="hidden" wire:model="selected_id">
    <div class="form-group">
        <label for="exampleInputPassword1">Enter Title</label>
        <input type="text" wire:model="title" class="form-control input-sm"  placeholder="Title">
    </div>
    <div class="form-group">
        <label>Enter Note</label>
        <textarea  class="form-control input-sm" placeholder="Enter note" wire:model="note" id="" cols="30" rows="10"></textarea>
    </div>
    <button type="button"
        @if($need_confirm_to_reset)
        wire:click="confirm('resetInput', 'Reset?')"
        @else
        wire:click="resetInput()"
        @endif
        class="btn btn-danger">
        Reset
    </button>
    <button type="button" wire:click="update()" class="btn btn-primary">Update</button>
</div> 