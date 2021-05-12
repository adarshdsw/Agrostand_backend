<div class="main-menu menu-fixed  menu-dark  menu-accordion menu-shadow" data-scroll-to-active="true">
   <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
         <li class="nav-item mr-auto">
            <a class="navbar-brand" href="index.html">
               <div class="brand-logo">
                  <img src="images/logo/logo.png" class="logo" alt="">
               </div>
               <h2 class="brand-text mb-0">
                  Friday Fan
               </h2>
            </a>
         </li>
         <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
            <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
            <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
            </a>
         </li>
      </ul>
   </div>
   <div class="shadow-bottom"></div>
   <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
         <li class="nav-item active">
            <a href="{{route('admin.home')}}">
            <i class="" data-icon="desktop"></i>
            	<span class="menu-title">Dashboard</span>
            </a>
         </li>
         <li class="navigation-header"><span>Staffs Management</span></li>
         <li class="nav-item ">
            <a href="{{route('admin.departments.index')}}" >
               <i class="" data-icon="envelope-pull"></i>
               <span class="menu-title">Departments</span>
            </a>
         </li>
         <li class="nav-item ">
            <a href="#" >
               <i class="" data-icon="envelope-pull"></i>
               <span class="menu-title">Staff List</span>
            </a>
         </li>
          <li class="navigation-header"><span>All User Management</span></li>
         <li class="nav-item ">
            <a href="{{route('admin.departments.index')}}" >
               <i class="" data-icon="envelope-pull"></i>
               <span class="menu-title">Associate List</span>
            </a>
         </li>
         <li class="nav-item ">
            <a href="#" >
               <i class="" data-icon="envelope-pull"></i>
               <span class="menu-title">Supplier List</span>
            </a>
         </li>
                 <li class="nav-item ">
            <a href="#" >
               <i class="" data-icon="envelope-pull"></i>
               <span class="menu-title">Buyer List</span>
            </a>
         </li>
        <!-- <li class="nav-item">
            <a href="{{ route('admin.settings') }}">
				  <span class="menu-title">Account Settings</span>
			   </a>
        </li> -->
         <!-- <li class="nav-item ">
            <a href="#">
               <i class="menu" data-icon="users"></i>
                  <span class="menu-title">Departments</span>
            </a>
            <ul class="menu-content">
               <li class=>
                  <a href="{{route('admin.departments.index')}}" >
                    <i class="bx bx-right-arrow-alt"></i>
                  <span class="menu-item">List</span>
                  </a>
               </li>
               <li >
                  <a href="{{route('admin.departments.create')}}" >
                     <i class="bx bx-right-arrow-alt"></i>
                     <span class="menu-item">Add</span>
                  </a>
               </li>
               <li >
                  <a href="page-users-view.html" >
                     <i class="bx bx-right-arrow-alt"></i>
                     <span class="menu-item">View</span>
                  </a>
               </li>
               <li >
                  <a href="page-users-edit.html" >
                    <i class="bx bx-right-arrow-alt"></i>
                     <span class="menu-item">Edit</span>
                  </a>
               </li>
            </ul>
         </li> -->
  


      </ul>
   </div>
</div>