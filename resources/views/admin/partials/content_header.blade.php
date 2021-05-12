<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 d-flex align-items-center">
            <h1 class="m-0 text-dark">{{ $title }}</h1>
            @yield('button')
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               @foreach ($breadcrumbs as $item)
               <li @if ($loop->last && $item['url'] === '#') class="active" @endif>
                  @if ($item['url'] !== '#')
                  @endif
                     @isset($item['icon'])
                     <span class="fa fa-{{ $item['icon'] }}"></span>
                     @endisset
                     {{ $item['name'] }}
                     @if ($item['url'] !== '#')
                  / <!-- seperator of breadcrumb-item -->
                  @endif
               </li>&nbsp;
               @endforeach
               <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>