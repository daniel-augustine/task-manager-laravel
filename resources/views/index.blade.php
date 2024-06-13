<!-- <h1>
    Hello all
</h1> -->

@extends('layouts.app')

@section('title' ,'Task viewer')


<!-- @isset($name)
From {{$name}}
@endisset -->


@section('content')
<nav class="mb-5">
    <a href="{{route('tasks.create')}}" class="link">Create New...</a>
</nav>
<div>
    @if(count($tasks))
        <!-- <div> There are tasks</div> -->
        @foreach ($tasks as $task)
            <!-- <div>{{$task->title}}</div> -->
            <div>
                <a href="{{route('task.show', ['task' => $task->id])}}" @class(['line-through'=>$task->completed])>{{$task->title}}</a>
            </div>
        @endforeach
    @else 
        <div> There are no tasks</div>
    @endif
</div>

@if ($tasks->count())
<div>{{$tasks->links()}}</div>
@endif

@endsection
