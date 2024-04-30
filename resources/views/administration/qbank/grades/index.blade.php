@extends('layouts.basic')
@section('header')
<x-headers.user page="Q. Bank" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin page='qbank'></x-sidebars.admin>
@endsection

@php
$colors=config('globals.colors');
$i=0;
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('admin')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Grades</div>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <!-- fixed button for new grade -->
        <a href="{{route('admin.grades.create')}}" class="fixed bottom-6 right-6 btn-green w-14 h-14 flex justify-center items-center rounded-full text-sm">New</a>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
            @foreach($grades as $grade)
            <div class="flex flex-col border rounded-lg overflow-hidden">
                <div class="flex justify-center items-center h-24 bg-slate-100">
                    <div class="flex w-16 h-16 justify-center items-center rounded-full bg-{{ $colors[$i%4] }}-100 text-{{ $colors[$i%4] }}-600 text-2xl"><i class="bi-mortarboard"></i></div>

                </div>
                <div class="p-4">
                    <h3> <a href="{{ route('admin.grade.books.index', $grade) }}">{{ $grade->name }} </h3></a>
                    <div class="text-slate-400 text-xs">{{ $grade->questions()->objective()->count()}} objective, {{ $grade->questions()->subjective()->count()}} subjective</div>
                    <div class="flex flex-row items-center space-x-5 text-slate-600 text-xs mt-5">
                        <div><i class="bi-question-circle"></i> <span class="font-medium"> {{ $grade->questions()->count() }}</span></div>
                        <div class=""><i class="bx bx-book"></i> <span class="font-medium">{{ $grade->books->count() }}</span></div>
                        @if($grade->questions()->today()->count())
                        <div><i class="bi-arrow-up"></i>{{ $grade->questions()->today()->count() }}</div>
                        @endif

                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{route('admin.grades.edit', $grade)}}">
                                <i class="bx bx-pencil text-green-600"></i>
                            </a>
                            <form action="{{route('admin.grades.destroy',$grade)}}" method="POST" onsubmit="return confirmDel(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent p-0 border-0">
                                    <i class="bx bx-trash text-red-600"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            @php $i++; @endphp
            @endforeach
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