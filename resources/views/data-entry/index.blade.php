@extends('layouts.basic')

@section('header')
<x-headers.user page="Welcome back!" icon="<i class='bi bi-emoji-smile'></i>"></x-headers.user>
@endsection

@section('sidebar')
<x-sidebars.operator page='home'></x-sidebars.operator>
@endsection

@section('body')
<div class="responsive-container">
    <div class="container">
        <div class="flex flex-row justify-between items-center">
            <div class="bread-crumb">
                <div>Data Entry</div>
                <i class="bx bx-chevron-right"></i>
                <div>Home</div>
            </div>
            <div class="md:hidden text-slate-500">Welcome back!</div>
        </div>

        <!-- pallets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{route('operator.grade.books.index',1)}}" class="pallet-box">
                <div class="ico bg-green-100 text-green-600 text-xl">9</div>
                <div class="flex-1 pl-3">
                    <div class="title">Questions</div>
                    <div class="h2">{{ $questionCount[1] }}</div>
                </div>

            </a>
            <a href="{{route('operator.grade.books.index',2)}}" class="pallet-box">
                <div class="ico bg-indigo-100 text-indigo-600 text-xl">
                    10
                </div>
                <div class="flex-1 pl-3">
                    <div class="title">Questions</div>
                    <div class="h2">{{ $questionCount[2] }}</div>
                </div>

            </a>
            <a href="{{route('operator.grade.books.index',3)}}" class="pallet-box">
                <div class="ico bg-teal-100 text-teal-600 text-xl">
                    11
                </div>
                <div class="flex-1 pl-3">
                    <div class="title">Questions</div>
                    <div class="h2">{{ $questionCount[3] }}</div>
                </div>

            </a>
            <a href="{{route('operator.grade.books.index',4)}}" class="pallet-box">
                <div class="ico bg-sky-100 text-sky-600 text-xl">
                    12
                </div>
                <div class="flex-1 pl-3">
                    <div class="title">Questions</div>
                    <div class="h2">{{ $questionCount[4] }}</div>
                </div>

            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 mt-8 gap-6 rounded">
            <!-- middle panel  -->
            <div class="md:col-span-2">
                <!-- update news  -->
                <div class="p-4 bg-white">
                    <h2>Most Recent</h2>
                    <div class="divider my-3 border-slate-200"></div>
                    <!-- <div class="grid grid-cols-4">
                        @foreach($grades as $grade)
                        <div class="text-center">
                            <h2>{{ $grade->grade_no }}<sup>th</sup></h2>
                            <p class="text-sm text-slate-600">{{$grade->questions()->today()->count()}}</p>
                        </div>
                        @endforeach
                    </div> -->
                    <!-- <div class="divider my-3 border-slate-200"></div> -->
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
                                @foreach($grades as $grade)
                                @foreach($grade->questions()->today()->get()->take(30) as $question) <tr class="tr text-sm">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <!-- middle panel end -->
            <!-- right side bar starts -->
            <div class="">
                <div class="bg-white p-4">
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