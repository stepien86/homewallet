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
    <form action="{{route('obligations-index')}}" method="get">
    <div class="relative inline-block w-full text-gray-700">
        <select class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Regular input" name="customer">
            <option value="0">Wybierz klienta</option>
          @foreach ($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->name}}</option>
          @endforeach
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
          <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </div>
      </div>
      <div class="block">
        <span class="text-gray-700">Radio Buttons</span>
        <div class="mt-2">
          <div>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio text-indigo-600" name="statusPayment" value="2" @if (request()->get('statusPayment') == '2') checked @endif >
              <span class="ml-2">Opłacone</span>
            </label>
          </div>
          <div>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio text-green-500" name="statusPayment" value="1" @if (request()->get('statusPayment') == '1') checked @endif>
              <span class="ml-2">Nieopłacone</span>
            </label>
          </div>
        </div>
      </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">wybierz</button>
</form>
<div class="mt-4 mb-3">
    <a href="{{route('auto-obligation-create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">sprawdz</a>
</div>
<div class="mt-4 mb-3">
    <a href="{{route('create-obligation')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dodaj płatność</a>
</div>

@if (count($obligations) == 0)
    pustooo
@endif
    <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Obiorca
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Tytuł
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Data zobowiązania
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Kwota
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Data płatności
                    </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $total = 0;
                    $paymentSum = 0;
                @endphp
                @foreach ($obligations as $obligation)
                <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">

                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{$obligation->customer->name}}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{$obligation->customer->account}}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{$obligation->title}}</div>
                  {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">

                    @if ($obligation->status == '1')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Nieopłacony
                    @elseif ($obligation->status == '2')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Opłacony
                    @endif

                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{$obligation->payment_peroid}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{$obligation->total_amount}}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @foreach ($obligation->payments as $payment)
                      {{$payment->date}};
                        @php
                              $paymentSum += $payment->amount;
                        @endphp
                      @endforeach
                  </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    @if ($paymentSum == 0)
                        {{$paymentSum}}<a href="{{route('obligations-edit', $obligation->id) }}" class="text-indigo-600 hover:text-indigo-900"> Edytuj</a>
                        <a href="{{route('pay-obligation', ['obligation' => $obligation->id, 'amount' => $obligation->total_amount])}}" class="text-indigo-600 hover:text-indigo-900">Opłać</a>

                    @elseif ($paymentSum < $obligation->total_amount)
                    {{$paymentSum}}<a href="{{route('pay-obligation', ['obligation' => $obligation->id, 'amount' => $obligation->total_amount-$paymentSum])}}" class="text-indigo-600 hover:text-indigo-900">Opłać resztę</a>
                        <a href="{{route('obligations.show', $obligation->id)}}" class="text-indigo-600 hover:text-indigo-900">szczegóły</a>
                    @else ($sum == $obligation->total_amount)
                        <a href="{{route('obligations.show', $obligation->id)}}" class="text-indigo-600 hover:text-indigo-900">szczegóły</a>
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
                @if (request('statusPayment')== '2')
                <tr>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Wpłacono:
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$total}}</td>
                </tr>
                @else
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pozostało do zapłaty:
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$total-$paymentSum}}</td>
                </tr>
                @endif
            </th>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
