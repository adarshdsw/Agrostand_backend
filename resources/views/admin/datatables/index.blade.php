@extends('admin/default')

@section('button')
   <!-- <a type="button" href="{{ route('admin.banner.create') }}" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-programme">Add Banner</a> -->
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
			   <div class="card card-primary card-outline card-outline-tabs">
				  <div class="card-body">
					<table class="table table-hover text-nowrap my-datatable" id="users-table">
						<thead>
							<th>Id</th>
			                <th>Name</th>
			                <th>Email</th>
			                <th>Created At</th>
			                <th>Updated At</th>
						</thead>
						<tbody id="banner_panel">
							
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
$(function() {
	alert('DataTable getIndex');
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.datatables.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
</script>
@endsection