 <!-- Sidebar -->
 <div class="border-right" id="sidebar-wrapper">
     <div class="sidebar-heading text-center">
         <img src="{{url('/images/admin.png')}}" alt="" class="my-4 img-fluid" width="200" />
     </div>
     <div class="list-group list-group-flush">
         <a href="{{ route('admin.dashboard') }}"
             class="list-group-item list-group-item-action {{ (request()->is('admin/dashboard**')) ? 'active' : '' }} ">
             Dashboard
         </a>
         <a href="{{ route('admin.products.index') }}"
             class="list-group-item list-group-item-action {{ (request()->is('admin/products*')) ? 'active' : '' }} ">
            Products
         </a>
         <a href="{{ route('admin.product-galleries.index') }}"
             class="list-group-item list-group-item-action {{ (request()->is('admin/product-galleries*')) ? 'active' : '' }} ">
            Product Galleries
         </a>
         <a href="{{ route('admin.categories.index') }}"
             class="list-group-item list-group-item-action {{ (request()->is('admin/categories*')) ? 'active' : '' }} ">
             Categories
         </a>
        <a href="{{ route('admin.users.index') }}"
             class="list-group-item list-group-item-action {{ (request()->is('admin/users*')) ? 'active' : '' }} ">
             users
         </a>
        <a href="{{ route('dashboard.settings.account') }}"
           class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings/account')) ? 'active' : '' }} ">
        My Account
      </a>
     </div>
 </div>