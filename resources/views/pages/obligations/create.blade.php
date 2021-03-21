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

        <div class="flex flex-col text-sm">
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
                                        Data zobowiązania
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kwota
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <form action="{{route('store-obligation')}}" method="post">
                                @csrf
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" name="customer" id="">
                                                    @foreach ($customers as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                  </div>
                                                </div>
                                            </div>
                                            @error('customer')
                                                <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
                                            @enderror
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"></div>
                                        <input type="text" name="title" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                                        {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                        @error('title')
                                            <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
                                        @enderror
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <input type="date" name="paymentPeroid" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                                        @error('paymentPeroid')
                                            <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
                                        @enderror
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <input type="text" name="total_amount" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                                        @error('total_amount')
                                            <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
                                        @enderror
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                            Zapisz
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
