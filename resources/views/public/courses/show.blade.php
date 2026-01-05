@extends('public.layouts.app')

@section('title', $course->title)

@section('content')
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>

    <h3>Lessons</h3>

    @foreach($course->lessons as $lesson)
        <a href="{{ route('lessons.show', $lesson) }}">
            {{ $lesson->title }}
        </a><br>
    @endforeach
@endsection
