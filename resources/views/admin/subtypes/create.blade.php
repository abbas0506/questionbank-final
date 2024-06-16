@extends('layouts.basic')
@section('header')
<x-headers.user page="Sub Types" icon="<i class='bi bi-database-gear'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.admin page='subtypes'></x-sidebars.admin>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="bread-crumb">
            <a href="/">Home</a>
            <i class="bx bx-chevron-right"></i>
            <a href="{{route('admin.subtypes.index')}}">Subtypes</a>
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
                <h3 class="text-green-600 bg-green-100 px-3 py-1 rounded-full">New subtype <i class="bi-mortarboard"></i></h3>
            </div>
            <div class="flex justify-center items-center mt-12">
                <!-- page message -->
                <form action="{{route('admin.subtypes.store')}}" method='post' class="md:w-2/3" onsubmit="return validate(event)">
                    @csrf
                    <div>
                        <label>subtype Name</label>
                        <input type="text" name='name' class="custom-input-borderless" placeholder="Enter subtype name" value="" required>
                    </div>
                    <button type="submit" class="btn-green rounded mt-6">Save</button>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection