<!-- iam working here -->
@extends('layouts.app')

@section('title', 'Add task')

<!-- @section('styles') -->
<!-- <style>
    .error-message{
        color : red;
        font-size: 0.8rem;
    }
</style> -->
<!-- @endsection -->

@section('content')

<form method="POST" action="{{route('tasks.store')}}">
    @csrf
    <!-- {{$errors}} -->
    <div class="mb-4">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title')}}" @class(['border-red-500' =>$errors->has('title')])>
        @error('title')
        <p class="error">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea rows="5" name="description" id="description" @class(['border-red-500' =>$errors->has('description')])>
        {{ old('description')}}
        </textarea>
        @error('description')
        <p class="error">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="long_description"> Long Description</label>
        <textarea rows="10" name="long_description" id="long_description" @class(['border-red-500' =>$errors->has('long_description')])>
        {{ old('long_description')}}
        </textarea>
        @error('long_description')
        <p class="error">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4 flex items-center gap-2">
        <button class="btn" type="submit">Add Task</button>
        <a href="{{route('tasks.index')}}">Cancel</a>
    </div>
</form>

@endsection