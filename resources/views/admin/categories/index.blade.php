@extends('admin/default')

@section('button')
   <button type="button" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-category">Add Category</button>
   <button type="button" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-subcategory">Add Subcategory</button>
@endsection

@section('content')
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                     <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="custom-tabs-four-category-tab" data-toggle="pill" href="#custom-tabs-four-category" role="tab" aria-controls="custom-tabs-four-category" aria-selected="true">Category</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="custom-tabs-four-subcategory-tab" data-toggle="pill" href="#custom-tabs-four-subcategory" role="tab" aria-controls="custom-tabs-four-subcategory" aria-selected="false">Sub Category</a>
                        </li>
                     </ul>
                  </div>
                  <div class="card-body">
                     <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-category" role="tabpanel" aria-labelledby="custom-tabs-four-category-tab">
                           <!-- Main Menu Table list -->
                           <div class="card-body p-0">
                              <table class="table table-striped my-datatable">
                                 <thead>
                                    <tr>
                                       <th style="width: 10px">#</th>
                                       <th>Icon</th>
                                       <th>Title</th>
                                       <th>Title Hindi</th>
                                       <th>Slug</th>
                                       <th>Status</th>
                                       <th>Created At</th>
                                       <th style="width: 60px">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="menu_panel">
                                       @php
                                          $counter = 1;
                                       @endphp
                                       @foreach($categories as $category)
                                          @if($category->parent == 0 )
                                          <tr>
                                             <td>{{ $counter }}</td>
                                             <td>
                                                <a href="{{ ($category->icon) ? $category->icon : '' }}" data-toggle="lightbox" data-(width|height)="[0-9]+">
                                                   <img src="{{ $category->icon }}" alt="{{ $category->title }}" width="75" height="75">
                                                </a>
                                             </td>
                                             <td>{{ $category->title }}</td>
                                             <td>{{ $category->title_hindi }}</td>
                                             <td>{{ $category->slug }}</td>
                                             <td><?= ($category->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>"; ?></td>
                                             <td>{{ $category->created_at }}</td>
                                             <td>
                                                <a class="btn btn-xs btn-success ajax-edit" href="{{ route('admin.category.edit', [$category->id]) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                             </td>
                                          </tr>
                                             @php
                                                $counter++;
                                             @endphp
                                          @endif
                                       @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-subcategory" role="tabpanel" aria-labelledby="custom-tabs-four-subcategory-tab">
                           <!-- Main Menu Table list -->
                           <div class="card-body p-0">
                              <table class="table table-striped my-datatable">
                                 <thead>
                                    <tr>
                                       <th style="width: 10px">#</th>
                                       <th>Image</th>
                                       <th>Parent Category</th>
                                       <th>Title</th>
                                       <th>Title Hindi</th>
                                       <th>Slug</th>
                                       <th>Status</th>
                                       <th>Created At</th>
                                       <th style="width: 40px">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="submenu_panel">
                                       @php
                                          $counter = 1;
                                       @endphp
                                       @foreach($categories as $subcategory)
                                          @if($subcategory->parent != 0 )
                                          <?php
                                             $parent =  \App\Models\Category::find($subcategory->parent);
                                          ?>
                                          <tr>
                                             <td>{{ $counter }}</td>
                                             <td>
                                                <a href="{{ ($subcategory->icon) ? $subcategory->icon : '' }}" data-toggle="lightbox" data-(width|height)="[0-9]+">
                                                   <img src="{{ $subcategory->icon }}" alt="{{ $subcategory->title }}" width="75" height="75">
                                                </a>
                                             </td>
                                             <td>{{ $parent->title }}</td>
                                             <td>{{ $subcategory->title }}</td>
                                             <td>{{ $subcategory->title_hindi }}</td>
                                             <td>{{ $subcategory->slug }}</td>
                                             <td><?= ($subcategory->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>"; ?></td>
                                             <td>{{ $subcategory->created_at }}</td>
                                             <td>
                                                <a class="btn btn-xs btn-success ajax-edit" href="{{ route('admin.subcategory.edit', [$subcategory->id]) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                             </td>
                                          </tr>
                                             @php
                                                $counter++;
                                             @endphp
                                          @endif
                                       @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card -->
               </div>
            </div>            
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">
   
</script>
<script>
   $(function () {
      $('.my-datatable').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false,
         "responsive": true,
      });
      // preview lightbox image
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
         event.preventDefault();
         $(this).ekkoLightbox();
      });
   });

   var menu = (function () {

      var url = ''
      var swalTitle = 'Really destroy this ?';
      var confirmButtonText = 'Yes';
      var cancelButtonText = 'No';
      var errorAjax = "Something went wrong";
      var title = "Add New";

      var onReady = function () {
         $('#menu_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) { // when edit buttton click
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Category Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Menu View";
            sbm.loadView(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // submenu
         $('#submenu_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Menu Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "SubMenu View";
            sbm.loadView(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // add new Menu
         $(document).on('click', '.add-category', function () {
            var url = '{{ route("admin.category.create") }}';
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         });
         // add new sub Menu
         $(document).on('click', '.add-subcategory', function () {
            var url = '{{ route("admin.subcategory.create") }}';
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         });
      }

      return {
         onReady: onReady
      }

  })()

  $(document).ready(menu.onReady)

</script>
@endsection