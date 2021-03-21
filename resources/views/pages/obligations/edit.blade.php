@extends('layout.app')
@section('content')
    <h1>zobowiązania</h1>

    <div class="container lg mx-auto">
        {{-- <div>
        <ul>
            <li><a href="/obligations/?status=1">Nieopłacone</a></li>
            <li><a href="/obligations/?status=2">Opłacone</a></li>
        </ul>
    </div> --}}

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Obiorca
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tytuł
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data zobowiązania
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kwota
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data płatności
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <form action="{{route('obligations-update', $obligation->id)}}" method="post">
                                @csrf
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $obligation->customer->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $obligation->customer->account }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"></div>
                                        <input type="text" name="title" class="px-2 py-3" value="{{ $obligation->title }}">
                                        {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($obligation->status == '1')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Nieopłacony
                                            @elseif ($obligation->status == '2')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Opłacony
                                        @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <input type="date" name="paymentPeroid" class="px-2 py-3" value="{{ $obligation->payment_peroid }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <input type="text" name="total_amount" class="px-2 py-3" value="{{ $obligation->total_amount }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                            Zapisz
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    </td>
                                </tr>

                                <!-- More items... -->
                            </tbody>
                        </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
