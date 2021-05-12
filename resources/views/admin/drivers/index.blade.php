@extends('admin/default')

@section('css')
<style type="text/css">
   .form-inline .form-control {
       width: 100%;
   }
</style>
@endsection

@section('button')
   <button type="button" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-driver">Add Driver</button>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h5><i class="icon fas fa-check"></i> Success!</h5>
               <p> {{ session('success') }} </p>
            </div>
            @endif
            @if (session('fail'))
            <div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h5><i class="icon fas fa-check"></i> Danger!</h5>
               <p> {{ session('fail') }} </p>
            </div>
            @endif
            <!-- filter form start -->
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Filter Form</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <div class="card-body">
                  <form method="POST" id="search-form" class="form-inline" role="form">
                     <!-- search by name -->
                     <div class="col-md-4">
                        <div class="form-group d-flex align-items-center">
                           <label for="name" class="col-form-label mr-3">Driver Name</label>
                           <input type="text" class="form-control" id="name" name="name" placeholder="Search Title">
                        </div>
                     </div>
                     <!-- search by mobile -->
                     <div class="col-md-4">
                        <div class="form-group d-flex align-items-center">
                           <label for="mobile" class="col-form-label mr-3">Driver Mobile</label>
                           <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Search Mobile">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="mr-3">Type</label>
                           <select class="form-control" id="type">
                              <option value="">Select Any</option>
                              <option value="1">Non-Agro</option>
                              <option value="2">Agro</option>
                           </select>
                        </div>
                     </div>

                     <!-- /.card-body -->
                     <div class="col-md-2">
                        <div class="card-footer p-0">
                           <button type="submit" class="btn btn-info w-100">Search</button>
                        </div>
                     </div>
                     <!-- /.card-footer -->
                  </form>
               </div>
            </div>
            <!-- filter form end -->
            <div class="card card-primary card-outline card-outline-tabs">
               <div class="card-body">
                  <table class="table table-hover text-nowrap my-datatable" id="drivers-table">
                        <thead>
                           <tr>
                              <th style="width: 10px">#</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Password</th>
                              <th>Type</th>
                              <th>Status</th>
                              <th>Created At</th>
                              <th style="width: 40px">Action</th>
                           </tr>
                        </thead>
                        <tbody id="driver_panel">

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
<script>

   $(function () {

      var table = $('#drivers-table').DataTable({
               processing  : true,
               serverSide  : true,
               scrollX     : true,
               ajax: {
                  url: base_url+'/admin/drivers-data',
                  method: 'POST',
                  data: function (d) {
                      d.name   = $('input[name=name]').val();
                      d.mobile = $('input[name=mobile]').val();
                      d.type   = $('#type :selected').val();
                  }
               },
               columns: [
                  {data: 'id',              name: 'id'},
                  {data: 'profile_image',   name: 'profile_image'},
                  {data: 'name',            name: 'name'},
                  {data: 'mobile',          name: 'mobile'},
                  {data: 'conf_password',   name: 'conf_password'},
                  {data: 'type',            name: 'type'},
                  {data: 'status',          name: 'status'},
                  {data: 'created_at',      name: 'created_at'},
                  {data: 'action',          name: 'action', orderable: false, searchable: false}
               ]
            });

      $('#search-form').on('submit', function(e) {
         table.draw();
         e.preventDefault();
      });
   });

   var slider = (function () {

       var url = "{{url('/')}}"+"/admin/drivers/";

       var swalTitle = 'Really destroy this ?';
       var confirmButtonText = 'Yes';
       var cancelButtonText = 'No';
       var errorAjax = "Something went wrong";
       var title = "Add New";
       var onReady = function () {
               $('#driver_panel').on('click', 'td a.ajax-edit', function (event) {
                       event.preventDefault();
                       var that  = $(this);
                       var url   = that.attr('href');
                       var title = "Driver Edit";
                       sbm.loadMultiPartForm(url, $(this), errorAjax, title);
               })
               .on('click', 'td a.ajax-view', function (event) {
                       event.preventDefault();
                       var that  = $(this);
                       // console.log(that); return false;

                       var url   = that.attr('href');
                       var title = "Driver View";
                       sbm.loadView(title, event, $(this), url)
               })
               .on('click', 'td a.ajax-delete', function (event) {
                       event.preventDefault();
                       var url   = $(this).attr('href');
                       // console.log(url); return false;
                       sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
               });
       

               // add new Slider
               $(document).on('click', '.add-driver', function () {
                       var my_url = url + 'create';
                       sbm.loadMultiPartForm(my_url, $(this), errorAjax, title);
               });
       }

      return {
          onReady: onReady
      }

   })()

   $(document).ready(slider.onReady)

</script>
   @endsection