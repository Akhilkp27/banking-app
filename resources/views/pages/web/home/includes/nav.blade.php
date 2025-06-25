<ul class="nav justify-content-center">
  <ul class="nav nav-pills mt-3">
    <li class="nav-item">
      <a class="nav-link {{ Request::routeIs('customer-home') ? 'active' : '' }}" aria-current="page" href="{{route('customer-home')}}">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::routeIs('customer-deposit') ? 'active' : '' }}" href="{{route('customer-deposit')}}">Deposit</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::routeIs('customer-withdraw') ? 'active' : '' }}" href="{{route('customer-withdraw')}}">Withdraw</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::routeIs('customer-transfer') ? 'active' : '' }}" href="{{route('customer-transfer')}}">Transfer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::routeIs('customer-statement') ? 'active' : '' }}" href="{{route('customer-statement')}}">Statment</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('logout')}}">Logout</a>
    </li>
  </ul>
</ul>