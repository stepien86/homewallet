@extends('layout.app')
    @section('content')

    <p class="text-lg text-center font-bold m-5">Classic Table Design</p>
    <div class="p-6">


    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-white text-gray-800 shadow-md text-sm">
      <tr class="text-left border-b-2 border-gray-300">
        <th class="px-4 py-3">Nazwa</th>
        <th class="px-4 py-3">Tytuł</th>
        <th class="px-4 py-3">Konto</th>
        <th class="px-4 py-3">Przypomnnienie</th>
        <th class="px-4 py-3">Aktywnosc</th>
        <th class="px-4 py-3">akcja</th>
      </tr>
        <form action="{{route('customers-update', $customer->id)}}" method="post">
            @csrf
        <tr class="border-b border-gray-200">
            <td class="px-4 py-3"><input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" id="" value="{{$customer->name}}"></td>
            <td class="px-4 py-3"><input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" id="" value="{{$customer->title}}"></td>
            <td class="px-4 py-3"><input type="text" name="account" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" id="" value="{{$customer->account}}"></td>
            <td class="px-4 py-3">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="reminder" class="form-checkbox" {{ ($customer->reminder == 1 ? 'checked' : '1')}}>
                        <span class="ml-2">Atywne</span>
                    </label>
              </div>
            </td>
            <td class="px-4 py-3">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="isActive" class="form-checkbox" {{ ($customer->is_active == 1 ? 'checked' : '1')}}>
                        <span class="ml-2">Atywny</span>
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
