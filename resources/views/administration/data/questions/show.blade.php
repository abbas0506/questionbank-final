@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>View Question</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.book.chapter.questions.index',[$book,$chapter])}}">Questions</a>
        <div>/</div>
        <div>View</div>
    </div>

    <div class="content-section md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-2 items-end">
            <div>
                <h2>{{ $book->name }}</h2>
                <p>{{ $chapter->chapter_no }}. {{$chapter->name}}</p>
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
                    <div class="custom-input-borderless">{{ $question->statement_en }}</div>
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
            $('#statement_en').bind('input propertychange', function() {
                $('#math').html($('#statement_en').val());
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