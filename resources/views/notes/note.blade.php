<div>    
    <div class="col-md-6">

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Sorry!</strong> invalid input.<br><br>
            <ul style="list-style-type:none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('error'))
    <div class="form-group col-md-12">
        <div class="alert alert-danger p-3 m-0">
            {{ session()->get('error') }}
        </div>
    </div>
    @endif


    @if($updateMode)
        @include('notes.update')
    @else
        @include('notes.create')
    @endif


    <table class="table table-striped" style="margin-top:20px;">
        <tr>
            <td>NO</td>
            <td>TITLE</td>
            <td>ACTION</td>
        </tr>

        @foreach($data as $row)
            <tr>
                <td>{{$row->id ?? $loop->index + 1}}</td>
                <td>{{$row->title}}</td>
                <td>
                    <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-danger py-0">Edit</button> | 
                    <button type="button" 
                        @if($need_confirm_to_delete)
                        wire:click="confirm('destroy', 'Delete?', {{ $row->id }})"
                        @else
                        wire:click="destroy({{ $row->id }})"
                        @endif
                        class="btn btn-sm btn-outline-danger py-0">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
    </div>

</div>
<script>
Livewire.on('confirm', e => {
    // console.log(e);
    var message = e.message ? e.message : 'You sure?';
    if (!confirm(message)) { return }
    @this[e.callback](...e.argv)
})
</script>