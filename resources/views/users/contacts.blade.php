@extends('layouts.app2')
@section('content')
    <div class="flex justify-center">
        @livewire('contact', ['id' => $id])
    </div>
@endsection 