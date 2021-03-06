@extends('layout.app')
@section('content')
<h1>Nowy Przelew</h1>
<div class="container xl mx-auto">
    @if (session('status'))
        <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold"> {{ session('status') }}</p>
                <p class="text-sm">Make sure you know how these changes affect you.</p>
            </div>
            </div>
        </div>
    @endif
    <form action="{{route('store-payment')}}" method="post">
        @csrf
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2 text-sm">
        <div class="mx-3 md:flex mb-2">
          <div class="md:w-48 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="amount">
              Kwota
            </label>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="amount" type="text" placeholder="{{$amount}}" name="amount">
            @error('amount')
                <p class="text-red-500 text-xs italic">Wpisz kwotę przelewu!</p>
            @enderror</td>
        </div>
        <div class="mx-3 md:flex mb-2">
            <div class="md:w-96 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">
                Tytuł płatności
              </label>
              <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="title" type="text" value="{{$title}}" name="title">
              @error('title')
                  <p class="text-red-500 text-xs italic">Wpisz tytuł przelewu!</p>
              @enderror</td>
          </div>
          <div class="-mx-3 md:flex mb-2">
            <input type="hidden" name="obligation-id" value="{{$idObligation}}">
            <div class="md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
                  Typ płatności
                </label>
                <div class="relative">
                  <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-4 rounded" id="grid-state" name="payment-type">
                    @foreach ($paymentType as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                  </select>
                  <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                </div>
              </div>
              <div class="md:w-96 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
                  Kategoria płatności
                </label>

                <div class="relative">
                  <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-4 rounded" id="grid-state" name="payment-category">
                    @foreach ($paymentCategory as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                </div>
              </div>
          <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
              Data płatnosci
            </label>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-zip" type="date" name="payment-date" value="{{old('payment-date')}}">
            @error('payment-date')
            <p class="text-red-500 text-xs italic">Uzupełnij datę!</p>
        @enderror</td>
          </div>
        </div>
        <div class="md:w-48 px-3 flex-none">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded block mt-auto">
            Button
          </button>
        </div>
      </div>
</div>
</form>

@endsection
