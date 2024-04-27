@extends('layouts.basic')

@section('header')
<x-headers.user page="Welcome back!" icon="<i class='bi bi-emoji-smile'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.operator page='home'></x-sidebars.operator>
@endsection

@section('body')

@php
$colors=config('globals.colors');
@endphp
<div class="responsive-container">
    <div class="container">
        <div class="flex flex-row justify-between items-center">
            <div class="bread-crumb">
                <div><i class="bi-house"></i> home</div>
            </div>
            <div class="md:hidden text-slate-500">Welcome back!</div>
        </div>

        <!-- pallets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @php $i=0; @endphp
            @foreach($grades as $grade)
            <a href="{{route('operator.grade.book.chapters.index',[$grade,0])}}" class="pallet-box">
                <div class="ico bg-{{ $colors[$i%4] }}-100 text-{{ $colors[$i%4] }}-600 text-lg"><i class="bi-mortarboard-fill"></i></div>
                <div class="flex-1 pl-3">
                    <h2>{{ $grade->name }}</h2>
                    <div class="flex items-center space-x-4 text-slate-600 text-xs">
                        <div><i class="bi-question-circle"></i> {{ $grade->questions->count() }}</div>
                        <div><i class="bi-book"></i> {{ $grade->books->count() }}</div>
                        @if($grade->questions()->today()->count())
                        <div><i class="bi-arrow-up"></i>{{ $grade->questions()->today()->count() }}</div>
                        @endif
                    </div>
                </div>
            </a>
            @php $i++; @endphp
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 mt-8 gap-6">
            <!-- middle panel  -->
            <div class="md:col-span-2 border rounded-lg">
                <!-- update news  -->
                <div class="p-4">
                    <h2>Most Recent</h2>
                    <div class="overflow-x-auto mt-4">
                        <table class="table-fixed w-full">
                            <thead>
                                <tr class="">
                                    <th class="w-10">Sr</th>
                                    <th class="w-24">Subject</th>
                                    <th class='w-60'>Question</th>
                                    <th class='w-16'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sr=1;
                                @endphp
                                @foreach($questions->sortByDesc('id')->take(20) as $question) <tr class="tr text-sm">
                                    <td>{{$sr++}}</td>
                                    <td class="text-left">
                                        {{ $question->book->subject->name_en }} - {{ $grade->grade_no }}
                                    </td>
                                    <td class="text-left">
                                        <span class="font-semibold text-teal-700">{{ $question->type->name }}</span>
                                        <br>
                                        {{$question->statement}}
                                    </td>
                                    <td>
                                        <a href=""><i class="bx bx-pencil"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <!-- middle panel end -->
            <!-- right side bar starts -->
            <div class="">
                <div class="bg-white p-4 rounded-lg border">
                    <h2>Profile</h2>
                    <div class="flex flex-col">
                        <div class="flex text-sm mt-4">
                            <div class="w-8"><i class="bi-person"></i></div>
                            <div>{{ Auth::user()->name }}</div>
                        </div>
                        <div class="flex text-sm mt-2">
                            <div class="w-8"><i class="bi-envelope-at"></i></div>
                            <div>{{ Auth::user()->email }}</div>
                        </div>
                        <div class="divider border-blue-200 mt-4"></div>
                        <div class="flex text-sm mt-4">
                            <div class="w-8"><i class="bi-key"></i></div>
                            <a href="{{route('passwords.edit', Auth::user()->id)}}" class="link">Change Password</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection