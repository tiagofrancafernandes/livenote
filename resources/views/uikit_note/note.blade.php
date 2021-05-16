@extends('layouts.uikit')

@section('title')
    {{ $note->title }}
@endsection

@section('content')
@livewire('notes.live-note', [$note], key($note->id))
<script>
     document.addEventListener('DOMContentLoaded', (event) => {
            console.log('Here is after Livewire');
     });
</script>
@endsection