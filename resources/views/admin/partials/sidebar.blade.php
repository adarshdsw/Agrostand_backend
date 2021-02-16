<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
               <a href="{{ route('admin.dashboard') }}" class="nav-link {{ ($title == 'Dashboard') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.categories.index') }}" class="nav-link {{ ($title == 'Category') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Category
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.commodity.index') }}" class="nav-link {{ ($title == 'Commodity') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Commodity
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.banner.index') }}" class="nav-link {{ ($title == 'Banner') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Banner
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.news.index') }}" class="nav-link {{ ($title == 'News') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     News
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.scheme.index') }}" class="nav-link {{ ($title == 'Schemes') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Schemes
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.brands.index') }}" class="nav-link {{ ($title == 'Brand') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Brands
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.users.index') }}" class="nav-link {{ ($title == 'User') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Users
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.units.index') }}" class="nav-link {{ ($title == 'Unit') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Units
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.pgroups.index') }}" class="nav-link {{ ($title == 'Product Group') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Product Group
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="{{ route('admin.suggestions.index') }}" class="nav-link {{ ($title == 'Suggestions') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-star"></i>
                  <p>
                     Suggestions
                  </p>
               </a>
            </li>

            <li class="nav-item menu-open">
               <a href="javascript:;" class="nav-link" onclick="event.preventDefault(); document.querySelector('#admin-logout-form').submit();">
                  <i class="nav-icon fa fa-sign-out-alt"></i>
                  <p>
                     Logout
                  </p>
               </a>
               <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
            </li>
            
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>