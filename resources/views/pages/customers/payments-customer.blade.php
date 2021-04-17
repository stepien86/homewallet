@extends('layout.app')
@section('content')
    <h1>Nowy Przelew</h1>
    <div class="container lg mx-auto">
        @if (session('status'))
            <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg></div>
                    <div>
                        <p class="font-bold"> {{ session('status') }}</p>
                        <p class="text-sm">Make sure you know how these changes affect you.</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="pb-4">
            <div>
                <form action="{{ route('customers-payments', $id) }}" method="get">
                    <input class="appearance-none bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="date" name="date-from" id="">
                    <input class="appearance-none bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="date" name="date-to" id="">
                    <button type="submit"
                        class="w-28 px-3 py-3 bg-blue-500 hover:bg-blue-700 text-white rounded">Sortuj</button>
                </form>
            </div>
        </div>
        <div>
            <h1></h1>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <h2>Przelewy do zobowiązań</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Odbiorca
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kwota
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategoria
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Typ przelewu
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data płatności
                                </th>

                            </tr>
                        </thead>
                        @php
                            $total = 0;
                        @endphp
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($obligationsPayments as $obligation)

                                @foreach ($obligation->payments as $payment)
                                    @php
                                        $total += $payment->amount;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $payment->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">

                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $obligation->customer->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">

                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $payment->amount }}</div>
                                            {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $payment->category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $payment->type->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $payment->date }}

                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach
                            <!-- More items... -->
                        </tbody>
                        <thead class="">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Suma:
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $total }}</td>
                            </tr>
                        </thead>
                    </table>

                </div>
                <div class="mt-2 mb-2 px-2">

                </div>
            </div>
        </div>
    </div>


@endsection
