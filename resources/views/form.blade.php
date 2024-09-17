@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('content')
    <form action="{{ isset($task) ? route('task.update', ['task' => $task]) : route('task.store') }}" method="post">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
                @class(['border-red-500' => $errors->has('title')])>
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" @class(['border-red-500' => $errors->has('description')])>

                {{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Description</label>
            <textarea name="long_description" id="long_description" cols="30" rows="10" @class(['border-red-500' => $errors->has('title')])>
                {{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2 mx-2">
            <button type="submit" class="btn"> @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{ route('task.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
