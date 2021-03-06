@extends('layout.app')
@section('content')

    @if (session('status'))
        <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
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
    <div class="flex justify-between">
        <div class="flex">
            <div class="flex flex-wrap content-end">

                <form action="{{ route('obligations-index') }}" method="get">
                <div class="relative block w-100 text-gray-700">
                    <select
                        class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        placeholder="Regular input" name="customer">
                        <option value="0">Wybierz klienta</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="px-5">
                <span class="text-gray-700">Radio Buttons</span>
                <div class="mt-2">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio text-indigo-600" name="statusPayment" value="2" @if (request()->get('statusPayment') == '2') checked @endif>
                            <span class="ml-2">Op??acone</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio text-green-500" name="statusPayment" value="1" @if (request()->get('statusPayment') == '1') checked @endif>
                            <span class="ml-2">Nieop??acone</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap content-end">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded h-11">wybierz</button>
            </div>


        </div>
        </form>
        <div class="mt-4 mb-3 justify-items-end">
            <a href="{{ route('auto-obligation-create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">sprawdz</a>
        </div>
    </div>
    @if (count($obligations) == 0)
    <div class="px-3 m-auto w-1/3 p-8 bg-green-200 text-center rounded-md border-green-900  border-solid border-2 shadow-xl mt-4">
        <span class="text-sm shadow-md"> Wygl??da na to, ??e nie masz aktualnych zobowi??za??</span>

    </div>
    @endif
    <div class="flex mt-4 mb-3">
        <a href="{{ route('create-obligation') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dodaj p??atno????</a>
    </div>

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
                                    Tytu??
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Okres zobowi??zania
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kwota
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data p??atno??ci
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>

                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $total = 0;
                                $totalPayment = 0;
                            @endphp
                            @foreach ($obligations as $obligation)

                                @php
                                    $paymentSum = 0;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $obligation->customer->name ?? ''}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $obligation->customer->account ?? '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $obligation->title }}</div>
                                        {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($obligation->status == '1')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Nieop??acony
                                            @elseif ($obligation->status == '2')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Op??acony
                                        @endif

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $obligation->payment_peroid }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $obligation->total_amount }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @foreach ($obligation->payments as $payment)
                                            {{ $payment->date }};
                                            @php
                                                $paymentSum += $payment->amount;
                                                $totalPayment += $payment->amount;

                                            @endphp
                                        @endforeach
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if ($paymentSum == 0)

                                            {{ $paymentSum }}
                                            <form action="{{ route('obligations.destroy', $obligation->id) }}" method="post">
                                            <a href="{{ route('obligations-edit', $obligation->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"> Edytuj</a>
                                            <a href="{{ route('pay-obligation', ['obligation' => $obligation->id, 'amount' => $obligation->total_amount,
                                            'title' => $obligation->title]) }}"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Op??a??</a>
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">usu??</button>
                                            </form>

                                        @elseif ($paymentSum < $obligation->total_amount)
                                                {{ $paymentSum }}<a
                                                    href="{{ route('pay-obligation', ['obligation' => $obligation->id, 'amount' => $obligation->total_amount - $paymentSum,
                                                    ]) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Op??a?? reszt??</a>
                                                <a href="{{ route('obligations.show', $obligation->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">szczeg????y</a>


                                            @elseif ($paymentSum > $obligation->total_amount)
                                                <div class="p-2">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        NADP??ATA
                                                </div>
                                                <div><a href="{{ route('obligations.show', $obligation->id) }}"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">szczeg????y</a></div>

                                            @else ($sum == $obligation->total_amount)

                                                <a href="{{ route('obligations.show', $obligation->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">szczeg????y</a>
                                        @endif

                                        @php
                                            $total += $obligation->total_amount;
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach

                            <!-- More items... -->
                        </tbody>

                        <thead class="">
                            @if (request('statusPayment') == '2')
                                <tr>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Wp??acono:
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $totalPayment }}</td>
                                </tr>
                            @else
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pozosta??o do zap??aty:
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $total - $totalPayment }}</td>
                                </tr>
                            @endif
                            </th>

                    </table>
                </div>
                {{$obligations->links()}}
            </div>
        </div>
    </div>



@endsection
