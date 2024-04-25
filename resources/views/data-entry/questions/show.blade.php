@extends('layouts.basic')
@section('header')
<x-headers.user page="Data" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin page='data'></x-sidebars.admin>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('admin')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.data.index')}}">Data</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.book.chapter.questions.index',[$book,$chapter])}}">Questions</a>
            <i class="bx bx-chevron-right"></i>
            <div>View</div>
        </div>

        <div class="container-light">
            <div class="flex flex-wrap items-center justify-between">
                <h3 class="text-green-600 bg-green-100 px-3 py-1 rounded-full">View Question <i class="bx bx-show-alt"></i></h3>
                <div>
                    <h3>{{ $book->name }}</h3>
                    <p class="text-sm">Chapter {{ $chapter->chapter_no }}</p>
                </div>
            </div>
            <div class="divider my-5"></div>
            <div class="md:w-3/4 mx-auto mt-8">
                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif
                <div class="grid gap-6 md:gap-y-8 md:gap-x-16 mt-12">

                    <div class="grid gap-y-1">
                        <label>Question Type</label>
                        <div>{{ $question->type->name }}</div>
                    </div>
                    <div class="grid gap-y-1">
                        <label for="">Marks</label>
                        <div>{{ $question->marks }}</div>
                    </div>

                    <div class="grid gap-y-1 col-span-full">
                        <label for="">Question Statement</label>
                        <div class="custom-input-borderless">{{ $question->statement }}</div>
                    </div>
                    <!-- MCQs -->
                    @if($question->subtype->tagname=='mcq')
                    <div class="text-sm">
                        <label for="">Choices</label>
                        <div class="grid gap-4 mt-2">
                            <div class="text-sm md:w-1/2">a. &nbsp{{ $question->mcq->choice_a }}</div>
                            <div class="text-sm md:w-1/2">b. &nbsp{{ $question->mcq->choice_b }}</div>
                            <div class="text-sm md:w-1/2">c. &nbsp{{ $question->mcq->choice_c }}</div>
                            <div class="text-sm md:w-1/2">d. &nbsp{{ $question->mcq->choice_d }}</div>
                        </div>
                    </div>
                    @endif
                    <!-- Paraphrasing -->
                    @if($question->subtype->tagname=='paraphrasing')
                    <div class="text-sm">
                        <label for="">Parahrasing: Poetry lines</label>
                        <div class="grid gap-4 md:grid-cols-2 mt-2">
                            @foreach($question->paraphrasings as $paraphrasing)
                            <div class="text-sm">{{ $paraphrasing->poetry_line }}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Comprehension -->
                    @if($question->subtype->tagname=='comprehension')
                    <div class="text-sm">
                        <label for="">Comprehension Questions</label>
                        <div class="grid gap-4 mt-2">
                            @php
                            $i=1;
                            @endphp
                            @foreach($question->comprehensions as $comprehension)
                            <div class="text-sm">{{ Roman::lowercase($i++) }} &nbsp {{ $comprehension->sub_question }}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="grid gap-1">
                        <label>Exercise No.</label>
                        <div>{{ $question->exercise_no }}</div>
                    </div>

                    <div class="grid gap-1">
                        <label>Conceptual?</label>
                        <div>@if($question->is_conceptual) Yes @else No @endif</div>
                    </div>

                    <div class="grid gap-y-1">
                        <label for="">Bise Frequency</label>
                        <div>{{ $question->bise_frequency }}</div>
                    </div>

                </div>
            </div>
        </div>
        @endsection
        @section('script')
        <script type="module">
            $(document).ready(function() {
                $('#statement').bind('input propertychange', function() {
                    $('#math').html($('#statement').val());
                    MathJax.typeset();
                });

                $('#questionable_type').change(function() {
                    if ($(this).val() == 'App\\Models\\Mcq')
                        $('#choices_div').show()
                    else
                        $('#choices_div').hide()
                });

                $('.choice').bind('input propertychange', function() {
                    $('#math').html($(this).val());
                    MathJax.typeset();
                });


                $('.correct').change(function() {
                    $('.correct').not(this).prop('checked', false);
                    $(this).prop('checked', true)
                });
            });
        </script>
        @endsection