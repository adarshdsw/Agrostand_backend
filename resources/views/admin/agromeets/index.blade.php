@extends('admin/default')

@section('button')
   <a type="button" href="{{ route('admin.agromeets.create') }}" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3">Add New</a>
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
                              <th>Descriptions</th>
                              <th>Type</th>
                              <th>Link</th>
                              <th>Date/Time</th>
                              <th>Status</th>
                              <th>Created At</th>
                              <th style="width: 40px">Action</th>
                           </tr>
                        </thead>
                        <tbody id="agromeet_panel">
                              @php
                                 $counter = 1;
                              @endphp
                              @foreach($agromeets as $agromeet)
                                 <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $agromeet->meeting_title }}</td>
                                    <td>{!! Str::limit($agromeet->meeting_description, 120) !!}</td>
                                    <td>{{ $agromeet->meeting_type }}</td>
                                    <td>{{ $agromeet->meeting_link }}</td>
                                    <td>{{ $agromeet->meeting_date_time }}</td>
                                    <td>{{ ($agromeet->status == '2') ? "Draft" : (($agromeet->status == '1') ? "Active" : "Expired" ) }}</td>
                                    <td>{{ $agromeet->created_at }}</td>
                                    <td>
                                       <a class="btn btn-xs btn-success" href="{{ route('admin.agromeets.edit', $agromeet) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                       <a class="btn btn-xs btn-danger ajax-delete" href="{{ route('admin.agromeets.destroy', $agromeet) }}" role="button" title="Delete" data-menu_id="{{$agromeet->id}}"><i class="fas fa-trash-alt"></i></a>
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
         $('#agromeet_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) { // when edit buttton click
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Village Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Village View";
            sbm.loadMultiPartForm(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // add new commodity
         $(document).on('click', '.add-new', function () {
            var url = '{{ route("admin.agromeets.create") }}';
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