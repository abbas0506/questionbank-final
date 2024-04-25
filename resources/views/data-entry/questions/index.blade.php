@extends('layouts.basic')
@section('header')
<x-headers.user page="Questions" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.operator page='questions'></x-sidebars.operator>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('operator.book.chapters.index', $book)}}">{{ $book->name }}</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('operator.book.chapter.questions.index', [$book, $chapter])}}">Ch. {{ $chapter->chapter_no }}</a>
            <i class="bx bx-chevron-right"></i>
            <div>Questions</div>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="container-light">
            <h2>{{ $book->name }}</h2>
            <p>{{$chapter->chapter_no}}. {{ $chapter->name }}</p>
            <div class="flex items-center flex-wrap justify-between gap-3 mt-3">
                <!-- search -->
                <div class="flex relative w-full md:w-1/3">
                    <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                    <i class="bx bx-search absolute top-2 right-2"></i>
                </div>
                <a href="{{route('operator.book.chapter.questions.create',[$book->id, $chapter->id])}}" class="btn-green rounded">New</a>
            </div>


            @php $sr=1; @endphp
            <div class="overflow-x-auto">
                <table class="table-fixed w-full mt-3">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="w-16">Sr</th>
                            <th class="w-48">Question</th>
                            <th class="w-24">Type</th>
                            <th class="w-16">View</th>
                            <th class="w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($questions->sortByDesc('updated_at') as $question)
                        <tr class="tr">
                            <td>{{$sr++}}</td>
                            <td class="text-left">{{ $question->statement }}</td>
                            <td>{{ $question->type->name }}</td>
                            <td>
                                <a href="{{ route('operator.book.chapter.questions.show',[$book,$chapter,$question]) }}">
                                    <i class="bx bx-show-alt"></i>
                                </a>
                            </td>
                            <td>
                                <div class="flex justify-center items-center space-x-3">
                                    <a href="{{route('operator.book.chapter.questions.edit', [$book->id, $chapter->id, $question])}}">
                                        <i class="bx bx-pencil text-green-600"></i>
                                    </a>
                                    <span class="text-slate-400">|</span>
                                    <form action="{{route('operator.book.chapter.questions.destroy', [$book->id, $chapter->id, $question])}}" method="POST" onsubmit="return confirmDel(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-transparent p-0 border-0">
                                            <i class="bx bx-trash text-red-600"></i>
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirmDel(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }

    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }
</script>

@endsection