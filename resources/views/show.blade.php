@extends('layouts.app')


@section('title', $task->title)

@section('content')
    <div class="mb-4">
        <a class="link" href="{{ route('task.index') }}">← Go back to task
            list</a>
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mb-4 text-slate-500">Created {{ $task->created_at->diffForHumans() }} | Updated
        {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">
                Completed
            </span>
        @else
            <span class="font-medium text-red-500">
                not Completed
            </span>
        @endif
    </p>

    <div class="flex gap-2">
        <a class="btn" href="{{ route('task.edit', ['task' => $task]) }}">Edit</a>

        <form action="{{ route('task.toggle-complete', ['task' => $task]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn">Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
        </form>

        <form action="{{ route('task.destroy', ['task' => $task]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn">Delete</button>
        </form>
    </div>
@endsection
