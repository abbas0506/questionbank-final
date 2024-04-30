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
            <a href="{{route('admin.grade.books.index', $book->grade)}}">{{ $chapter->book->grade->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.book.chapters.index', $book)}}">{{ $book->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.chapter.questions.index', $chapter)}}">Ch.{{ $chapter->chapter_no }}</a>

        </div>

        <div class="container-light">
            <div class="flex flex-wrap items-center gap-4">
                <h3 class="bg-green-800 text-green-100 px-3 py-1 rounded-full">New Question</h3>
                <div class="flex items-center space-x-1 ">
                    <h3>{{ $chapter->book->name }}</h3>
                    <i class="bx bx-chevron-right"></i>
                    <p class="text-sm">Chapter {{ $chapter->chapter_no }}</p>
                </div>
            </div>
            <div class="divider my-5"></div>
            <div class="md:w-3/4 mx-auto">
                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif
                <form action="{{route('admin.chapter.questions.store', [$book->id, $chapter->id])}}" method='post' class="grid md:grid-cols-3 gap-6 md:gap-y-8 md:gap-x-16 mt-12" onsubmit="return validate(event)">
                    @csrf
                    <input type="hidden" id='book_id' value="{{ $book->id }}">
                    <div class="grid gap-y-1">
                        <label>Question Type</label>
                        <select name="type_id" id="type_id" class="custom-input-borderless text-sm">
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" @selected(session('type_id')==$type->id)> {{ $type->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid gap-y-1">
                        <label>Sub Type</label>
                        <select name="subtype_id" id="subtype_id" class="custom-input-borderless text-sm">
                            <!-- <option value="">Select ...</option> -->
                            @if(Session::has('subtypes'))
                            @foreach(session('subtypes') as $subtype)
                            <option value="{{ $subtype->id }}" @selected(session('subtype_id')==$subtype->id)>{{$subtype->name}}</option>
                            @endforeach
                            @elseif($subtypes->count()>0)
                            @foreach($subtypes as $subtype)
                            <option value="{{ $subtype->id }}" @selected(session('subtype_id')==$subtype->id)>{{$subtype->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="grid gap-y-1">
                        <label for="">Marks</label>
                        <input type="number" name="marks" value="{{ session('marks') ? session('marks') : 1}}" min=1 class="custom-input-borderless">
                    </div>

                    <div class="grid gap-y-1 col-span-full">
                        <label for="">Question Statement</label>
                        <textarea type="text" id='statement' name="statement" class="custom-input py-2 mt-2" rows='3' placeholder="Type here"></textarea>
                    </div>

                    <!-- MCQs -->
                    <div id='divMcq' class="questionable col-span-full">
                        <label for="">Choices</label>
                        <div class="grid gap-4 mt-2">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_a' class="correct w-4 h-4" value='1' checked>
                                <input type="text" name='choice_a' class="custom-input-borderless choice md:w-1/2" placeholder="a.">
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_b' class="correct w-4 h-4" value='1'>
                                <input type="text" name='choice_b' class="custom-input-borderless choice md:w-1/2" placeholder="b.">
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_c' class="correct w-4 h-4" value='1'>
                                <input type="text" name='choice_c' class="custom-input-borderless choice md:w-1/2" placeholder="c.">
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name='check_d' class="correct w-4 h-4" value='1'>
                                <input type="text" name='choice_d' class="custom-input-borderless choice md:w-1/2" placeholder="d.">
                            </div>
                        </div>
                    </div>

                    <!-- Paraphrasing question -->
                    <div id='divParaphrasing' class="questionable col-span-full hidden">
                        <label for="">Paraphrasing: Poetry Lines</label>
                        <div class="grid gap-4 md:grid-cols-2 mt-2">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line 1">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line 2">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line 3">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line 4">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="Poetry line 5">
                            <input type="text" name='poetry_lines[]' class="custom-input-borderless" placeholder="">
                        </div>
                    </div>

                    <!-- Comprehension question -->
                    <div id='divComprehension' class="questionable col-span-full hidden">
                        <label for="">Comprehension Questions</label>
                        <div class="grid gap-4 mt-2">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                            <input type="text" name='sub_questions[]' class="custom-input-borderless" placeholder="Sub Q.">
                        </div>
                    </div>

                    <!-- preview -->
                    <div class="col-span-full border p-6">
                        <!-- <span id="math" class="text-left no-line-break text-slate-400">Preview</span> -->
                        <span id="math" class="text-left text-slate-400">Preview</span>
                    </div>
                    <div class="grid gap-1">
                        <label>Exercise No.</label>
                        <select name="exercise_no" id="" class="custom-input-borderless">
                            <option value="">NA</option>
                            @if($book->subject->name_en!='Mathematics')
                            <option value="0">Basic</option>
                            @else
                            @for($i=1;$i<=20;$i++) <option value="{{$i}}" @selected(session('exercise_no')==$i)>{{ $chapter->chapter_no }}.{{$i}}</option>
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
                    <input type="hidden" name='chapter_no' value="{{ $chapter->chapter_no }}">
                    <div class="text-right col-span-full">
                        <button type="submit" class="btn-green">Create Now</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="module">
    $(document).ready(function() {
        // show or hide on page load
        if ($('#type_id').val() == 1) {
            $('.questionable').hide()
            $('#divMcq').show()
        } else if ($('#subtype_id').val() == 18) {
            $('.questionable').hide()
            $('#divParaphrasing').show()
        } else if ($('#subtype_id').val() == 19) {
            $('.questionable').hide()
            $('#divComprehension').show()
        }


        $('#statement').bind('input propertychange', function() {
            $('#math').html($('#statement').val());
            MathJax.typeset();
        });

        $('#type_id').change(function() {
            //objetive selected
            if ($(this).val() == 1) {
                $('.questionable').hide()
                $('#divMcq').show()
            } else {
                $('#divMcq').hide()
            }

            var token = $("meta[name='csrf-token']").attr("content");
            var book_id = $('#book_id').val();

            //fetch subtypes

            $.ajax({
                type: 'GET',
                url: "{{url('fetchSubTypesByTypeId')}}",
                data: {
                    "type_id": $(this).val(),
                    "book_id": book_id,
                    "_token": token,
                },
                success: function(response) {
                    //
                    $('#subtype_id').html(response.options);
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