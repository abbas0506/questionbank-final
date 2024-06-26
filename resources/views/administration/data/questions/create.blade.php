@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>New Question</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.data.index')}}">Data</a>
        <div>/</div>
        <a href="{{route('admin.book.chapter.questions.index',[$book,$chapter])}}">Questions</a>
        <div>/</div>
        <div>New</div>
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
            <form action="{{route('admin.book.chapter.questions.store', [$book->id, $chapter->id])}}" method='post' class="grid md:grid-cols-3 gap-6 md:gap-y-8 md:gap-x-16 mt-12" onsubmit="return validate(event)">
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
                    <textarea type="text" id='statement_en' name="statement_en" class="custom-input py-2 mt-2" rows='3' placeholder="Type here"></textarea>
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

                <!-- Comprehension question -->
                <div id='divComprehension' class="questionable col-span-full hidden">
                    <label for="">Comprehension Questions</label>
                    <div class="grid gap-4 mt-2">

                        <input type="text" name='question_a' class="custom-input-borderless" placeholder="a.">
                        <input type="text" name='question_b' class="custom-input-borderless" placeholder="b.">
                        <input type="text" name='question_c' class="custom-input-borderless" placeholder="c.">
                        <input type="text" name='question_d' class="custom-input-borderless" placeholder="d.">
                        <input type="text" name='question_e' class="custom-input-borderless" placeholder="e.">
                        <input type="text" name='question_f' class="custom-input-borderless" placeholder="f.">

                    </div>
                </div>


                <div class="col-span-full border p-6">
                    <!-- <span id="math" class="text-left no-line-break text-slate-400">Preview</span> -->
                    <span id="math" class="text-left text-slate-400">Preview</span>
                </div>
                <div class="grid gap-1">
                    <label>Exercise No.</label>
                    <select name="exercise_no" id="" class="custom-input-borderless">
                        <option value="">Out of exercise</option>
                        @if($book->subject->name_en!='Mathematics')
                        <option value="0">Basic exercise</option>
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
                    <input type="number" name="bise_frequency" value="1" min=0 class="custom-input-borderless">
                </div>
                <input type="hidden" name='chapter_no' value="{{ $chapter->chapter_no }}">
                <div class="text-right col-span-full">
                    <button type="submit" class="btn-teal">Create Now</button>
                </div>
            </form>

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