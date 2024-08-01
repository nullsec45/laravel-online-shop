 <!-- Sidebar -->
 <div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
      <img src="{{url('/images/dashboard-store-logo.svg')}}" alt="" class="my-4" />
    </div>
    <div class="list-group list-group-flush">
      <a
        href="{{ route('dashboard.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : '' }} "
      >
        Dashboard
      </a>
      <a
        href="{{ route('dashboard.products') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/products*')) ? 'active' : '' }} "
      >
        My Products
      </a>
      <a
        href="{{ route('dashboard.transactions') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }} "
      >
        Transactions
      </a>
      <a
        href="{{ route('dashboard.settings-store') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings*')) ? 'active' : '' }} "
      >
        Store Settings
      </a>
      <a
        href="{{ route('dashboard.settings-account') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/account*')) ? 'active' : '' }} "
      >
        My Account
      </a>
      <a
         href="{{ route('logout') }}"
         onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
         class="list-group-item list-group-item-action"
      >
        Sign Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
  </div>