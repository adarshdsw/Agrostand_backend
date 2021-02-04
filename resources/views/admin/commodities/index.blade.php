@extends('admin/default')

@section('button')
   <button type="button" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-commodity">Add Commodity</button>
@endsection

@section('content')
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-body">
                     <!-- Main Menu Table list -->
                     <table class="table table-striped my-datatable">
                        <thead>
                           <tr>
                              <th style="width: 10px">#</th>
                              <th>Image</th>
                              <th>Sub Category</th>
                              <th>Title</th>
                              <th>Title Hindi</th>
                              <th>Slug</th>
                              <th>Status</th>
                              <th>Created At</th>
                              <th style="width: 40px">Action</th>
                           </tr>
                        </thead>
                        <tbody id="commodity_panel">
                              @php
                                 $counter = 1;
                              @endphp
                              @foreach($commodities as $commodity)
                                 <?php
                                    $subcategory =  \App\Models\Category::find($commodity->subcategory_id);
                                 ?>
                                 <tr>
                                    <td>{{ $counter }}</td>
                                    <td><img src="{{ $commodity->icon }}" alt="{{ $commodity->title }}" width="75" height="75"></td>
                                    <td>{{ ($subcategory) ? $subcategory->title : '' }}</td>
                                    <td>{{ $commodity->title }}</td>
                                    <td>{{ $commodity->title_hindi }}</td>
                                    <td>{{ $commodity->slug }}</td>
                                    <td><?= ($commodity->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>"; ?></td>
                                    <td>{{ $commodity->created_at }}</td>
                                    <td>
                                       <a class="btn btn-xs btn-success ajax-edit" href="{{ route('admin.commodity.edit', $commodity) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                       <a class="btn btn-xs btn-danger ajax-delete" href="{{ route('admin.commodity.delete', $commodity) }}" role="button" title="Delete" data-menu_id="{{$commodity->id}}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                 </tr>
                                    @php
                                       $counter++;
                                    @endphp
                              @endforeach
                        </tbody>
                     </table>
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
   });

   var menu = (function () {

      var url = ''
      var swalTitle = 'Really destroy this ?';
      var confirmButtonText = 'Yes';
      var cancelButtonText = 'No';
      var errorAjax = "Something went wrong";
      var title = "Add New";

      var onReady = function () {
         $('#commodity_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) { // when edit buttton click
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Commodity Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Commodity View";
            sbm.loadMultiPartForm(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // add new commodity
         $(document).on('click', '.add-commodity', function () {
            var url = '{{ route("admin.commodity.create") }}';
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