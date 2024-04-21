@extends('layouts.admin')
@section('page-content')
<div class="custom-container bg-slate-100">
    <!--welcome  -->
    <div class="flex items-center">
        <div class="flex-1">
            <h2>Welcome {{ Auth::user()->name }}!</h2>
            <div class="bread-crumb">
                <div>Admin</div>
                <div>/</div>
                <div>Home</div>
            </div>
        </div>
        <div class="text-slate-500">{{ today()->format('d/m/Y') }}</div>
    </div>

    <!-- pallets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        <a href="" class="pallet-box">
            <div class="flex-1">
                <div class="title">All Questions</div>
                <div class="h2">{{$questions->count()}}</div>
            </div>
            <div class="ico bg-green-100">
                <i class="bi bi-person-circle text-green-600"></i>
            </div>
        </a>
        <a href="" class="pallet-box">
            <div class="flex-1">
                <div class="title">Recent Questions</div>
                <div class="h2">{{$questions->where('created_at',today())->count()}}</div>
            </div>
            <div class="ico bg-indigo-100">
                <i class="bi bi-person-workspace text-indigo-400"></i>
            </div>
        </a>
        <a href="" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Recent Subscription</div>
                <div class="h2">%</div>
            </div>
            <div class="ico bg-teal-100">
                <i class="bi bi-card-checklist text-teal-600"></i>
            </div>
        </a>
        <a href="" class="pallet-box">
            <div class="flex-1">
                <div class="title">Recent Payments</div>
                <div class="h2"> %</div>
            </div>
            <div class="ico bg-sky-100">
                <i class="bi bi-graph-up text-sky-600"></i>
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
                <div class="grid grid-cols-4">
                    @foreach($grades as $grade)
                    <div class="text-center">
                        <h2>{{ $grade->grade_no }}<sup>th</sup></h2>
                        <p class="text-sm text-slate-600">{{$grade->questions()->today()->count()}}</p>
                    </div>
                    @endforeach
                </div>
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
                                    {{$question->statement_en}}
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
@endsection