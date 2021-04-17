    <nav class="p-6 flex justify-between bg-white">
        <ul class="flex items-center">
            <li><a class="p-3" href="/">Home</a></li>
            <li><a class="p-3" href="{{route('customers.index')}}">Odbiorcy</a></li>
            <li><a class="p-3" href="{{route('payments')}}">Przelewy</a>
            {{-- <ul class="mt-2">
                <li><a class="p-3" href="{{route('new-payment')}}">Nowy przelew</a></li>
            </ul> --}}
            </li>
            <li><a class="p-3" href="{{route('obligations-index')}}">Płatności</a></li>
            <li><a class="p-3" href="#">Statistic</a></li>

        </ul>
        <ul class="flex items-center">
            <li><a class="p-3" href="#">Łukasz</a></li>
            <li><a class="p-3" href="#">Login</a></li>
            <li><a class="p-3" href="#">Register</a></li>
            <li><a class="p-3" href="#">Logout</a></li>
        </ul>
    </nav>
