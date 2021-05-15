@extends('layouts.app2')
@section('content')
    <div class="flex justify-center">
        @livewire('note', ['id' => $id])
    </div>
@endsection 