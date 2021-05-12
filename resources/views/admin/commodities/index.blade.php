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
							<table class="table table-striped my-datatable" id="commodity-table">
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
		/*$('.my-datatable').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});*/
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
        	event.preventDefault();
        	$(this).ekkoLightbox();
      	});
	});
	$(function() {
		var table = $('#commodity-table').DataTable({
			processing  : true,
			serverSide  : true,
			scrollX     : true,
			autoWidth   : false,
			ajax: {
				url: base_url+'/admin/commodity-data',
				method: 'POST',
				data: function (d) {
					d.title  = $('input[name=news_title]').val();
					d.status = $('#news_status :selected').val();
				}
			},
			columns: [
				{data: 'id',         name: 'id'},
				{data: 'icon',   		name: 'icon'},
				{data: 'subcategory_title', 	name: 'subcategory_title'},
				{data: 'title',      name: 'title', width : "2%"},
				{data: 'title_hindi',   name: 'title_hindi'},
				{data: 'slug',  name: 'slug'},
				{data: 'status',     name: 'status'},
				{data: 'created_at',    name: 'created_at'},
				{data: 'action',     name: 'action', orderable: false, searchable: false}
			]
		});

		$('#search-form').on('submit', function(e) {
			table.draw();
			e.preventDefault();
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