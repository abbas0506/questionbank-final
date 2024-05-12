@extends('layouts.basic')
@section('header')
<x-headers.user page="Paper Creation" icon="<i class='bi bi-files'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.collaborator page='paper'></x-sidebars.collaborator>
@endsection

@php
$colors=config('globals.colors');
$i=0;
$activeBook=$paper->book;
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Papers</div>
        </div>


        <!-- <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6"> -->

        <form action="{{ route('collaborator.paper.questions.store',$paper) }}" method="post">
            @csrf

            <input type="hidden" name="type_id" id="type_id" value='{{ $type->id }}' class="custom-input-borderless text-sm">
            <input type="hidden" id='book_id' value="{{ $paper->book->id }}">
            <div class="flex flex-wrap items-center space-x-8">
                <div class="font-semibold text-green-700"><i class="bi-files"></i> {{ $paper->book->name }} <i class="bi-node-plus-fill ml-4"></i> Add {{ $type->name}}</div>
                <a href="{{ route('collaborator.papers.show', $paper) }}" class="text-blue-600 hover:text-blue-800 text-xs">Show Paper <i class="bi-eye"></i></a>
            </div>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8 bg-slate-100 border border-dashed rounded-lg p-5 mt-5">
                @if($paper->book->subtype_mappings->count())
                <div class="">
                    <label>Sub Type</label>
                    <select name="subtype_id" id="subtype_id" class="custom-input-borderless text-sm">
                        @foreach($paper->book->subtypes($type->id) as $subtype)
                        <option value="{{ $subtype->id }}">{{ $subtype->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="" id='display_format_cover'>
                    <label>Display Format</label>
                    <select name="display_format" id="display_format" class="custom-input-borderless text-sm">
                        <option value="compact">Compact Question</option>
                        <option value="vertical">Vertical List</option>
                        <option value="horizontal">Horizontal List </option>
                        <option value="alt">OR Separated Alternative</option>
                    </select>
                </div>
                <div class="grid" id='marks_cover'>
                    <label>Marks (each)</label>
                    <input type="number" name="marks_each" class="custom-input-borderless" value="1">
                </div>
                <!-- advanced options -->
                <!-- <div class="">
                        <label>Exercise Ratio</label>
                        <select name="exercise_ratio" id="display_format" class="custom-input-borderless text-sm">
                            <option value="0">0 %</option>
                            <option value="10">10 %</option>
                            <option value="20">20 %</option>
                            <option value="30">30 %</option>
                            <option value="50">50 %</option>
                            <option value="75">75 %</option>
                            <option value="100">100 %</option>
                        </select>
                    </div>
                    <div class="">
                        <label>Conceptual Ratio</label>
                        <select name="conceptual_ratio" class="custom-input-borderless text-sm">
                            <option value="0">0 %</option>
                            <option value="10">10 %</option>
                            <option value="20">20 %</option>
                            <option value="30">30 %</option>
                            <option value="50">50 %</option>
                            <option value="75">75 %</option>
                            <option value="100">100 %</option>
                        </select>
                    </div>
                    <div class="">
                        <label>Importance Level</label>
                        <input type="number" name="frequency" class="custom-input-borderless" value="1">
                    </div> -->


            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-8 h-[16rem] overflow-y-auto">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-x-16 text-left">

                    <div class="grid col-span-full text-sm">
                        @foreach($selectedChapters->sortBy('chapter_no') as $chapter)
                        <div class="flex items-center odd:bg-transparent px-3">
                            <label for='chapter{{$chapter->id}}' class="flex-1 text-sm text-slate-800 py-3 hover:cursor-pointer">{{ $chapter->chapter_no}}. &nbsp {{ $chapter->name }} </label>
                            <input type="hidden" name='chapter_ids_array[]' value="{{$chapter->id}}">
                            <input type="number" name='parts_count_array[]' autocomplete="off" class="parts-count custom-input-borderless w-16 h-8 text-center px-0" min='0' value="0" oninput="syncNumOfParts()">

                        </div>
                        @endforeach
                    </div>

                </div>

            </div>
            <!-- Modal footer -->

            <div class="flex flex-wrap justify-center items-center p-4 md:p-5 gap-6 border-t border-gray-200 rounded-b dark:border-gray-600">

                <div>
                    <label>Total Parts</label>
                    <input type="number" id="parts_total" class="custom-input-borderless w-16 h-8 text-center font-bold" value="0" disabled>
                </div>
                <div> <label>Choices</label>
                    <input type="number" name="choices" class="custom-input-borderless w-16 h-8 text-center font-bold text-red-600" value="0">
                </div>
                <div>
                    <button data-modal-hide="default-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Q.</button>
                </div>
            </div>

    </div>

</div>
</form>
<!-- </div> -->
</div>

</div>
@endsection