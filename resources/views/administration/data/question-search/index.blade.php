@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Question Managment</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <div>Question Search</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="content-section md:p-12">
        <!-- search -->
        <div class="flex relative w-full md:w-1/3 mx-auto">
            <input type="text" id='searchby' placeholder="Search questions here..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>
    </div>

    <div class="content-section md:p-12">
        <div class="w-full md:w-2/3 mx-auto text-center">
            <h2 class="text-center">Search Questions by Grade</h2>
            <div class="flex items-center justify-center gap-x-4 mt-5">
                @foreach($grades as $grade)
                <div data-bound='books-{{$grade->id}}' class="round-tab">{{ $grade->grade_no }}</div>
                @endforeach
            </div>
            <div id='messageBeforeGradeSelection' class="flex justify-center items-center text-center text-teal-500 mt-8">
                Please select a grade from the above
            </div>

            @foreach($grades as $grade)
            <div id="books-{{$grade->id}}" class="books hidden">
                <div class="flex justify-center items-center text-center p-3 bg-teal-100 rounded-md mt-8 relative">
                    Choose a Subject
                    <div class="absolute w-4 h-4 transform rotate-45 -bottom-2 left-5 bg-teal-100"></div>
                </div>
                @foreach($grade->books as $book)
                <a href="{{route('admin.question-search.show',$book)}}" class="flex p-3 border-b">{{$book->subject->name_en}}</a>
                @endforeach
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection

@section('script')
<script type="module">
    $('.round-tab').click(function() {
        $('.round-tab').removeClass('active')
        $(this).addClass('active');
        $('#messageBeforeGradeSelection').hide();
        $('.books').hide();
        $('#' + $(this).attr('data-bound')).show()

    })
</script>
@endsection