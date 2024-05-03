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
@endphp

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{url('/')}}">Home</a>
            <i class="bx bx-chevron-right"></i>
            <div>Papers</div>
        </div>


        <div class="w-full md:w-4/5 mx-auto text-center mt-12 px-5">

            <div class="px-6 py-2 w-full border border-dashed border-slate-200 mt-6 relative">
                <h2 class="text-center">{{$paper->title}}</h2>
                <p class="text-slate-600 text-sm text-center">{{$paper->paper_date->format('d/m/Y')}}</p>
                <div class="flex flex-row justify-evenly mt-5">
                    <div class="flex items-center space-x-2">
                        <label for="">Paper Date</label>
                        <h3>{{$paper->paper_date->format('M d, Y')}}</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="">Marks</label>
                        <h3>25</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="">Duration</label>
                        <h3>{{$paper->duration}}</h3>
                    </div>
                </div>
                <a href="{{route('collaborator.papers.edit',$paper)}}" class="absolute top-2 right-2 btn-sky flex justify-center items-center rounded-full p-0 w-5 h-5"><i class="bx bx-pencil text-xs"></i></a>
            </div>
            <div class="flex justify-center items-center my-8">
                <button type="submit" class="btn-green flex justify-center items-center"> Add Question to Paper</button>
            </div>
            <!-- show print button only if test has some questions -->


            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif



        </div>
        @endsection

        @section('script')
        <script type="module">
            $('#add-question-btn').click(function() {
                $('#add-modal').addClass('shown');
            });

            $('.show-modal').click(function() {
                $('#modal-' + $(this).attr('modal-id')).addClass('shown');
            });

            $('.close-modal').click(function() {
                $(this).closest('.modal').removeClass('shown');
            })

            $('.show-confirm').click(function(event) {
                var form = $(this).closest("form");
                // var name = $(this).data("name");
                event.preventDefault();
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
                        //submit corresponding form
                        form.submit();
                    }
                });
            });
        </script>
        @endsection