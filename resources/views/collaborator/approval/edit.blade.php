@extends('layouts.basic')
@section('header')
<x-headers.user page="Approve Qs." icon="<i class='bi bi-bookmark-check'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.collaborator page='approval'></x-sidebars.collaborator>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Approval</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- mid panel  -->
            <div class="md:col-span-2 order-last md:order-first">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex items-center space-x-1 ">
                        <h2>{{ $question->chapter->book->name }}</h2>
                        <i class="bx bx-chevron-right"></i>
                        <p class="text-sm text-slate-600">Ch. {{ $question->chapter->chapter_no }}</p>
                    </div>
                    <form action="{{route('collaborator.approvals.destroy', $question)}}" method="POST" onsubmit="return confirmDel(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-red rounded text-slate-200">
                            <i class="bx bx-trash"></i> Remove
                        </button>
                    </form>
                </div>
                <div class="divider my-5"></div>
                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif

                <form action="{{route('collaborator.approvals.update', $question)}}" method='post' class="grid md:grid-cols-3 gap-6 md:gap-y-8 md:gap-x-16 mt-12" onsubmit="return validate(event)">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-y-1">
                        <label>Question Type</label>
                        <p>{{ $question->type->name }}</p>
                    </div>

                    <div class="grid gap-y-1">
                        <label>Sub Type</label>
                        <p>{{ $question->subtype->name }}</p>
                    </div>

                    <div class="grid gap-y-1">
                        <label for="">Marks</label>
                        <input type="number" name="marks" value="{{ $question->marks }}" min=1 class="custom-input-borderless">
                    </div>

                    <div class="grid gap-y-1 col-span-full">
                        <label for="">Question Statement</label>
                        <textarea type="text" id='statement' name="statement" class="custom-input py-2 mt-2" rows='3' placeholder="Type here">{{ $question->statement }}</textarea>
                    </div>

                    <!-- MCQs -->
                    @if($question->subtype->tagname=='mcq')
                    <div id='divMcq' class="questionable col-span-full">
                        <label for="">Choices</label>
                        <div class="grid gap-4 mt-2">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_a' class="correct w-4 h-4" value='1' @checked($question->mcq->correct=='a')>
                                <input type="text" name='choice_a' class="custom-input-borderless choice md:w-1/2" placeholder="a." value="{{ $question->mcq->choice_a }}">
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_b' class="correct w-4 h-4" value='1' @checked($question->mcq->correct=='b')>
                                <input type="text" name='choice_b' class="custom-input-borderless choice md:w-1/2" placeholder="b." value="{{ $question->mcq->choice_b }}">
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_c' class="correct w-4 h-4" value='1' @checked($question->mcq->correct=='c')>
                                <input type="text" name='choice_c' class="custom-input-borderless choice md:w-1/2" placeholder="c." value="{{ $question->mcq->choice_c }}">
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_d' class="correct w-4 h-4" value='1' @checked($question->mcq->correct=='d')>
                                <input type="text" name='choice_d' class="custom-input-borderless choice md:w-1/2" placeholder="d." value="{{ $question->mcq->choice_d }}">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($question->subtype->tagname=='paraphrasing')
                    <!-- paraphrasing question -->
                    <div id='divParaphrasing' class="questionable col-span-full">
                        <label for="">Paraphrasing: Poetry Lines</label>
                        <div class="grid gap-4 md:grid-cols-2 mt-2">
                            @foreach($question->paraphrasings as $paraphrasing)
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line 1" value="{{ $paraphrasing->poetry_line }}">
                            @endforeach
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="">

                        </div>
                    </div>
                    @endif

                    @if($question->subtype->tagname=='comprehension')
                    <!-- Comprehension question -->
                    <div class="col-span-full">
                        <label for="">Comprehension Questions</label>
                        <div class="grid gap-4 mt-2">
                            @foreach($question->comprehensions as $comprehension)
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Q." value="{{ $comprehension->sub_question }}">
                            @endforeach
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Q.">

                        </div>
                    </div>
                    @endif
                    <!-- preview -->
                    <div class="col-span-full border p-6">
                        <!-- <span id="math" class="text-left no-line-break text-slate-400">Preview</span> -->
                        <span id="math" class="text-left text-slate-400">Preview</span>
                    </div>
                    <div class="grid gap-1">
                        <label>Exercise No.</label>
                        <select name="exercise_no" id="" class="custom-input-borderless">
                            <option value="">NA</option>
                            @if($question->chapter->book->subject->name_en!='Mathematics')
                            <option value="0">Basic</option>
                            @else
                            @for($i=1;$i<=20;$i++) <option value="{{$i}}" @selected(session('exercise_no')==$i)>{{ $question->chapterchapter_no }}.{{$i}}</option>
                                @endfor
                                @endif
                        </select>
                    </div>

                    <div class="grid gap-1">
                        <label>Conceptual?</label>
                        <select name="is_conceptual" id="" class="custom-input-borderless">
                            <option value="1" @selected(session('is_conceptual'))>Yes</option>
                            <option value="0" @selected(!session('is_conceptual'))>No</option>
                        </select>
                    </div>

                    <div class="grid gap-y-1">
                        <label for="">Bise Frequency</label>
                        <input type="number" name="frequency" value="1" min=0 class="custom-input-borderless">
                    </div>
                    <input type="hidden" name='chapter_no' value="{{ $question->chapterchapter_no }}">
                    <div class="flex justify-end items-center gap-4 col-span-full">
                        <a href="{{url('/')}}" class="btn-blue rounded">Cancel</a>
                        <button type="submit" class="btn-green rounded">Save & Approve</button>
                    </div>
                </form>

            </div>
            <!-- right panel -->
            <div>
                <div class="p-4 border rounded-lg">
                    <h2>Similar Questions <i class="bi bi-collection"></i></h2>

                    <!-- <div class="flex relative w-full mt-4">
                        <input type="text" id='searchby' placeholder="Search ..." class="custom-input-borderless w-full" oninput="search(event)">
                        <i class="bx bx-search absolute top-2 right-2"></i>
                    </div>
                    <div class="text-right">
                        <input type="hidden" id='question_id' value="{{ $question->id }}">
                        <button class="btn-green rounded mt-4" id="btnCheckSimilarity">Search</button>
                    </div> -->
                    <div id="similarityQuestions" class="text-xs h-64 overflow-y-auto odd:bg-slate-100">

                        @foreach($similarQuestions as $question)
                        <i class="bi-dot"></i>
                        <p>{{ $question->statement }}</p>
                        @endforeach
                    </div>

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

            $('#btnCheckSimilarity').click(function() {
                //objetive selected

                var token = $("meta[name='csrf-token']").attr("content");
                var question_id = $('#question_id').val();

                //fetch subtypes

                $.ajax({
                    type: 'GET',
                    url: "{{url('findSimilarQuestions')}}",
                    data: {
                        "question_id": question_id,
                        "_token": token,
                    },
                    success: function(response) {
                        //
                        $('#similarityCheck').html(response.options);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'warning',
                            title: errorThrown
                        });
                    }
                }); //ajax end



            });

            $('#subtype_id').change(function() {
                // paraphrasing
                if ($(this).val() == 18) {
                    $('.questionable').hide()
                    $('#divParaphrasing').show()
                } else {
                    $('#divParaphrasing').hide()
                }

                // if comprehension option 
                if ($(this).val() == 19) {
                    $('.questionable').hide()
                    $('#divComprehension').show()
                } else {
                    $('#divComprehension').hide()
                }

            })

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