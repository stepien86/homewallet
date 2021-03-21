@extends('layout.app')

@section('content')

    <div class="container-md">
        <div class="flex flex-col w-full items-center">
            <table class="table-auto divide-y divide-gray-200 bg-white mt-4">
                <thead class="px-3 py-3">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontrahent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">tytuł</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Okres płatności</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">całkowita kwota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </thead>
                <tr class="text-center border-b border-gray-200">

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$customer->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$obligation->title}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$obligation->payment_peroid}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$obligation->total_amount}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        @if ($obligation->status == '1')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Nieopłacony
                    @elseif ($obligation->status == '2')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Opłacony
                    @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="flex flex-col w-full items-center">
            <table class="table-auto divide-y divide-gray-200 bg-white mt-4">
                <thead class="px-3 py-3">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data przelewu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Typ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">kwota</th>

                </thead>
                @foreach ($payments as $payment)
                <tr class="text-center border-b border-gray-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$payment->id}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$payment->date}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$payment->type->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$payment->amount}}</td>
                </tr>

                @endforeach


            </table>
        </div>
    </div>

@endsection
