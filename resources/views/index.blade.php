@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')

    <nav class="mb-4">
        <a class="link"
        href="{{ route('task.create') }}">Add Task!!</a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['task' => $task]) }}"
            @class(['line-through' => $task->completed])>{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no Tasks!</div>
    @endforelse

    @if ($task->count())
        <br>
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
