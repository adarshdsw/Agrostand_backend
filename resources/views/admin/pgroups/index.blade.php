@extends('admin/default')

@section('button')
   <button type="button" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-pgroups">Add Product Group</button>
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
                              <th>Category</th>
                              <th>Title</th>
                              <th>Title Hindi</th>
                              <th>Status</th>
                              <th>Created At</th>
                              <th style="width: 40px">Action</th>
                           </tr>
                        </thead>
                        <tbody id="unit_panel">
                              @php
                                 $counter = 1;
                              @endphp
                              @foreach($pgroups as $pgroup)
                                 <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ ($pgroup->category) ? $pgroup->category->title : '' }}</td>
                                    <td>{{ $pgroup->title }}</td>
                                    <td>{{ $pgroup->title_hindi }}</td>
                                    <td><?= ($pgroup->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>"; ?></td>
                                    <td>{{ $pgroup->created_at }}</td>
                                    <td>
                                       <a class="btn btn-xs btn-success ajax-edit" href="{{ route('admin.pgroups.edit', $pgroup) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                       <a class="btn btn-xs btn-danger ajax-delete" href="{{ route('admin.pgroups.destroy', $pgroup) }}" role="button" title="Delete" data-menu_id="{{$pgroup->id}}"><i class="fas fa-trash-alt"></i></a>
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
         $('#unit_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) { // when edit buttton click
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Product Group Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Product Group View";
            sbm.loadMultiPartForm(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // add new commodity
         $(document).on('click', '.add-pgroups', function () {
            var url = '{{ route("admin.pgroups.create") }}';
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