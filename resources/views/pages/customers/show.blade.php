@extends('layout.app')
    @section('content')

    <p class="text-lg text-center font-bold m-5">Classic Table Design</p>
    <div class="p-6">


    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-white text-gray-800 shadow-md text-sm">
      <tr class="text-left border-b-2 border-gray-300">
        <th class="px-4 py-3">Nazwa</th>
        <th class="px-4 py-3">Tytuł</th>
        <th class="px-4 py-3">Konto</th>
        <th class="px-4 py-3">Domyślna kwota</th>
        <th class="px-4 py-3">Przypomnnienie</th>
        <th class="px-4 py-3">Aktywnosc</th>
        <th class="px-4 py-3">akcja</th>
      </tr>

        <tr class="border-b border-gray-200">
            <td class="px-4 py-3">{{$customer->name}}</td>
            <td class="px-4 py-3">{{$customer->title}}</td>
            <td class="px-4 py-3">{{$customer->account}}</td>
            <td class="px-4 py-3">{{$customer->default_amount}}</td>
            <td class="px-4 py-3">
                <div>
                     @if ($customer->reminder == '0')
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Nieaktywne
                    @elseif ($customer->reminder == '1')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Aktywne
                @endif
              </div>
            </td>
            <td class="px-4 py-3">
                <div>
                    @if ($customer->is_active == '0')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Nieaktywny
                                            @elseif ($customer->is_active == '1')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Aktywny
                                        @endif
              </div>
            </td>
            <td class="px-4 py-3 flex flex-wrap">
                <div class="flex flex-wrap px-1">
                    <a href="{{ route('customers.edit',$customer->id)}}"class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded">Edytuj</a>
                </div>

                <div class="flex flex-wrap px-1">
                    <form action="{{route('customers.destroy', $customer->id)}}" method="post">
                    @method('delete')
                    @csrf
                    @if ($obligation > 0)
                    <button type="submit" class="bg-gray-500  text-white font-bold py-2 px-4 border-gray-700 rounded" disabled >usuń</button>
                    @else
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border-red-700 rounded" @if ($obligation > 0)  disabled @endif>usuń</button>
                    @endif
                    </form>
                </div>

            </td>
        </tr>



    <!-- each row -->

    </table>
</div>
    @endsection
