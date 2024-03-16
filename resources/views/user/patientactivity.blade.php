@extends('user.layout.main')
@section('content')
<div class="flex items-center justify-between">
    <h1 class="p-5" style="font-size: 20px; font-weight:bold">Patient Activites</h1>
</div>


<div class="relative overflow-x-auto p-5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Patient
                </th>
                <th scope="col" class="px-6 py-3">
                    Activity
                </th>
                <th scope="col" class="px-6 py-3">
                    Date and Time
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach($user as $d)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$d->patient_name}}
                </th>
                <td class="px-6 py-4">
                    {{$d->Activity}}
                </td>
                <td class="px-6 py-4">
                    {{$d->date_time}}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>




@endsection