@extends('layout.app')

@section('content')

    <div class="overflow-x-auto sm:px-6 lg:px-8">
        <div class="w-full max-w-7xl mx-auto mt-16 px-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Appointment List</h2>
                <table class="table-auto w-full border-collapse">
                    
                    <thead>
                        <tr class="bg-gray-200">
                        <th class="p-4 text-left">No</th>
                        <th class="p-4 text-left">Name</th>
                        <th class="p-4 text-left">Patient Id</th>
                        <th class="p-4 text-left">Date</th>
                        <th class="p-4 text-left">Time</th>
                        <th class="p-4 text-left">Process</th>
                        <th class="p-4 text-left">Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr class="border-b">
                        <th class="p-4">1</th>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                <img src="asset/aunt-icon.png" alt="patient" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">Hart Hagerty</div>
                                <div class="text-sm opacity-50">United States</div>
                            </div>
                            </div>
                        </td>
                        <td class="p-4">123456</td>
                        <td class="p-4">25/Apr/2023</td>
                        <td class="p-4">15:00</td>
                        <td class="p-4"><img src="asset/verify-icon.png" class="w-10 h-10 ml-5" alt=""></td>
                        <td class="p-4"><a href="/patient"><button class="btn btn-ghost btn-xs">Info</button></a></td>
                        </tr>
                        <!-- row 2 -->
                        <tr class="border-b">
                        <th class="p-4">2</th>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                <img src="asset/bachan-icon.png" alt="patient" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">Hart Hagerty</div>
                                <div class="text-sm opacity-50">United States</div>
                            </div>
                            </div>
                        </td>
                        <td class="p-4">123456</td>
                        <td class="p-4">25/Apr/2023</td>
                        <td class="p-4">15:00</td>
                        <td class="p-4"><img src="asset/verify-icon.png" class="w-10 h-10 ml-5" alt=""></td>
                        <td class="p-4"><a href="/patient"><button class="btn btn-ghost btn-xs">Info</button></a></td>
                        </tr>
                        <!-- row 3 -->
                        <tr class="border-b">
                        <th class="p-4">3</th>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                <img src="asset/aunt-icon.png" alt="patient" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">Hart Hagerty</div>
                                <div class="text-sm opacity-50">United States</div>
                            </div>
                            </div>
                        </td>
                        <td class="p-4">123456</td>
                        <td class="p-4">25/Apr/2023</td>
                        <td class="p-4">15:00</td>
                        <td class="p-4"><img src="asset/verify-icon.png" class="w-10 h-10 ml-5" alt=""></td>
                        <td class="p-4"><a href="/patient"><button class="btn btn-ghost btn-xs">Info</button></a></td>
                        </tr>
                        <!-- row 4 -->
                        <tr class="border-b">
                        <th class="p-4">4</th>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                <img src="asset/young-asian-man-close-shot-600nw-1562907988.webp" alt="patient" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">Hart Hagerty</div>
                                <div class="text-sm opacity-50">United States</div>
                            </div>
                            </div>
                        </td>
                        <td class="p-4">123456</td>
                        <td class="p-4">25/Apr/2023</td>
                        <td class="p-4">15:00</td>
                        <td class="p-4"><img src="asset/delete-x-icon.webp" class="w-10 h-10 ml-5" alt=""></td>
                        <td class="p-4"><a href="/patient"><button class="btn btn-ghost btn-xs">Info</button></a></td>
                        </tr>
                        <!-- row 5 -->
                        <tr class="border-b">
                        <th class="p-4">5</th>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                <img src="asset/bachan-icon.png" alt="patient" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">Hart Hagerty</div>
                                <div class="text-sm opacity-50">United States</div>
                            </div>
                            </div>
                        </td>
                        <td class="p-4">123456</td>
                        <td class="p-4">25/Apr/2023</td>
                        <td class="p-4">15:00</td>
                        <td class="p-4"><img src="asset/delete-x-icon.webp" class="w-10 h-10 ml-5" alt=""></td>
                        <td class="p-4"><a href="/patient"><button class="btn btn-ghost btn-xs">Info</button></a></td>
                        </tr>
                    </tbody>
            
                </table>
        </div>
    </div>
     
@endsection