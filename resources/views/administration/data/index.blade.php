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
            <div>Data Management</div>
        </div>

        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="grid grid-cols-2 gap-8">
            <div class="p-12 bg-white">
                <h2>Grades</h2>
                <label for="">Grade data is very sensitive. Avoid removing grade as it may cause irreversible loss of all associated data</label>
                <div class="mt-5">
                    <a href="{{ route('admin.grades.index') }}" class="btn btn-blue mt-5">Manage Now</a>
                </div>
            </div>
            <div class="p-12 bg-white">
                <h2>Subjects</h2>
                <label for="">Subjects data is very sensitive. Avoid removing any subject as it may cause irreversible loss of all associated data</label>
                <div class="mt-5">
                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-blue mt-5">Manage Now</a>
                </div>
            </div>
            <div class="p-12 bg-white">
                <h2>Books & Chapter Titles</h2>
                <label for="">Books data is very sensitive. Avoid removing any book as it may cause irreversible loss of all associated data</label>
                <div class="mt-5">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-blue mt-5">Manage Now</a>
                </div>
            </div>
            <div class="p-12 bg-white">
                <h2>Questions</h2>
                <label for="">Grade data is very sensitive. Avoid removing grade as it may cause irreversible loss of all associated data</label>
                <div class="mt-5">
                    <a href="{{ route('admin.question-search.index') }}" class="btn btn-blue mt-5">Manage Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection