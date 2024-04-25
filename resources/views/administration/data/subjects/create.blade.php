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
            <a href="/">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.data.index')}}">Data</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.subjects.index')}}">Subjects</a>
            <i class="bx bx-chevron-right"></i>
            <div>New</div>
        </div>

        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="container-light">
            <div class="flex items-center">
                <h3 class="text-green-600 bg-green-100 px-3 py-1 rounded-full">New Subject <i class="bx bx-book"></i></h3>
            </div>
            <div class="flex justify-center items-center mt-12">
                <!-- page message -->
                <form action="{{route('admin.subjects.store')}}" method='post' class="grid md:grid-cols-2 gap-x-12 gap-y-8 md:w-2/3">
                    @csrf
                    <div class="md:col-span-full">
                        <label>Subject Name (english)</label>
                        <input type="text" name='name_en' class="custom-input-borderless" placeholder="Enter subject name" value="" required>
                    </div>
                    <div class="md:col-span-full">
                        <label>Subject Name (urdu)</label>
                        <input type="text" name='name_ur' class="custom-input-borderless" placeholder="Enter subject name" value="" required>
                    </div>
                    <div class="">
                        <label>Display Order</label>
                        <input type="number" name='display_order' class="custom-input-borderless" placeholder="Enter display order" value="1" min=0 required>
                    </div>
                    <div class="md:col-span-full">
                        <button type="submit" class="btn-green rounded mt-6">Create</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    @endsection