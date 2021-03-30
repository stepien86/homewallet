@extends('layout.app')
@section('content')

        <p class="text-lg text-center font-bold m-5">Classic Table Design</p>
        <div class="p-3 mx-auto">
            @if (session('status'))
                <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                    role="alert">
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
        </div>
        <div class="p-6">
            <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-white text-gray-800 shadow-md text-sm">
                <tr class="text-center border-b-2 border-gray-300">
                    <th class="px-4 py-3">Nazwa</th>
                    <th class="px-4 py-3">Tytuł</th>
                    <th class="px-4 py-3">Konto</th>
                    <th class="px-4 py-3">Domyślna kwota</th>
                    <th class="px-4 py-3">Przypomnienie</th>
                    <th class="px-4 py-3">aktywnosc</th>
                    <th class="px-4 py-3">akcja</th>
                    <th class="px-4 py-3"> <a href="{{ route('customers.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded">Dodaj
                            Kontrahenta</a></th>
                </tr>
                @foreach ($customers as $customer)
                    <tr class="text-center border-b border-gray-200">
                        <td class="px-4 py-3">{{ $customer->name }}</td>
                        <td class="px-4 py-3">{{ $customer->title }}</td>
                        <td class="px-4 py-3">{{ $customer->account }}</td>
                        <td class="px-4 py-3">{{ $customer->default_amount }}</td>
                        <td class="px-4 py-3">
                            @if ($customer->reminder == 1)
                                <div>
                                    <span class="ml-2">Atywny</span>
                                </div>
                            @else
                                <div>
                                    <span class="ml-2">Nieatywny</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if ($customer->is_active == 1)
                                <div>
                                    <span class="ml-2">Atywny</span>
                                </div>
                            @else
                                <div>
                                    <span class="ml-2">Nieatywny</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                                <a href="{{ route('customers.show',$customer->id)}}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 border-yellow-700 rounded">szczegóły</a>
                            <a href="customers/payments/{{ $customer->id }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded"> $$ Przelewy $$</a>
                        </td>
                    </tr>

                @endforeach

                <!-- each row -->

            </table>
        </div>

@endsection
