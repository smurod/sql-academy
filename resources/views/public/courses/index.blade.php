<h1>Courses</h1>

@if($courses->count())
    @foreach($courses as $course)
        <div style="border:1px solid #ffffff; margin-bottom:10px; padding:10px;">
            <h3>{{ $course->title }}</h3>
            <p>{{ $course->description }}</p>
        </div>
    @endforeach
@else
    <p>No courses yet</p>
@endif
