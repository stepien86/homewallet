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
        <th class="px-4 py-3">Przypomnienie</th>
        <th class="px-4 py-3">aktywnosc</th>
        <th class="px-4 py-3">akcja</th>
      </tr>
        <form action="{{route('customers-store')}}" method="post">
            @csrf
        <tr class="border-b border-gray-200">
            <td class="px-4 py-3"><input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Nazwa" id="" value="{{old('name')}}">
            @error('name')
                <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
            @enderror</td>
            <td class="px-4 py-3"><input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Tytuł zobowiązania" id="" value="{{old('title')}}">
                @error('title')
                <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
            @enderror</td>
            <td class="px-4 py-3"><input type="text" name="account" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="nr konta" id="" value="{{old('account')}}">
                @error('account')
                <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
            @enderror</td>
            <td class="px-4 py-3"><input type="text" name="defaultAmount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="200" id="" value="{{old('defaultAmount')}}">
                @error('account')
                <p class="text-red-500 text-xs italic">Uzupełnij pole</p>
            @enderror</td>
            <td class="px-4 py-3">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="reminder" class="form-checkbox">
                    </label>
              </div>
            </td>
            <td class="px-4 py-3">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="isActive" class="form-checkbox">

                    </label>
              </div>
            </td>
            <td class="px-4 py-3"><button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-blue-700 rounded">zapisz</button></td>
        </tr>
    </form>


    <!-- each row -->

    </table>
</div>
    @endsection
