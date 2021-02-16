@extends('admin/default')

@section('button')
   <button type="button" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-suggestion">Add Suggestion</button>
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
                              <th>Title</th>
                              <th>Title Hindi</th>
                              <th>Type</th>
                              <th>Created At</th>
                              <th style="width: 40px">Action</th>
                           </tr>
                        </thead>
                        <tbody id="suggestion_panel">
                              @php
                                 $counter = 1;
                              @endphp
                              @foreach($suggestions as $suggestion)
                                 <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $suggestion->title }}</td>
                                    <td>{{ $suggestion->title_hindi }}</td>
                                    <td><?= ($suggestion->type == '1') ? "<span class='badge bg-info'>Sell</span>" : "<span class='badge bg-success'>Buy</span>"; ?></td>
                                    <td>{{ $suggestion->created_at }}</td>
                                    <td>
                                       <a class="btn btn-xs btn-success ajax-edit" href="{{ route('admin.suggestions.edit', $suggestion) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                       <a class="btn btn-xs btn-danger ajax-delete" href="{{ route('admin.suggestions.destroy', $suggestion) }}" role="button" title="Delete" data-menu_id="{{$suggestion->id}}"><i class="fas fa-trash-alt"></i></a>
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
         $('#suggestion_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) { // when edit buttton click
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Suggestion Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Suggestion View";
            sbm.loadMultiPartForm(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // add new commodity
         $(document).on('click', '.add-suggestion', function () {
            var url = '{{ route("admin.suggestions.create") }}';
            sbm.loadHtml(url, $(this), errorAjax, title);
         });
      }

      return {
         onReady: onReady
      }

  })()

  $(document).ready(menu.onReady)

</script>
@endsection