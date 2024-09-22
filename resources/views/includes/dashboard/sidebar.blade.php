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
        href="{{ route('dashboard.products.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/products*')) ? 'active' : '' }} "
      >
        My Products
      </a>
      <a
        href="{{ route('dashboard.transactions.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }} "
      >
        Transactions
      </a>
      <a
        href="{{ route('dashboard.settings.store') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings/store')) ? 'active' : '' }} "
      >
        Store Settings
      </a>
      <a
        href="{{ route('dashboard.settings.account') }}"
        class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings/account')) ? 'active' : '' }} "
      >
        My Account
      </a>
    </div>
  </div>