@extends('admin/default')

@section('css')
	<style type="text/css">
		.error{
			color: red;
		}
		.label-container label.label {
		    width: 97%;
		    margin-bottom: 0;
		}
		.label-container button.btn.btn-sm.btn-outline-danger.delete_row {
		    width: 3%;
		    padding: 3px;
		}
		.label-container {
		    margin: 10px 0;
		}		
	</style>
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
							<!-- /.card-header -->
							<!-- form start -->
							<form role="form" method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" id="update_intro">
								{{ method_field('PUT') }}
								@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="title">Title</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ isset($news) ? $news->title : old('title') }}">
												@if ($errors->has('title'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('title') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
							                  	<label>News Date:</label>
							                    <div class="input-group date" id="news_date" data-target-input="nearest">
							                        <input type="text" class="form-control datetimepicker-input" data-target="#news_date" name="news_date" value="{{ $news->news_date }}">
							                        <div class="input-group-append" data-target="#news_date" data-toggle="datetimepicker">
							                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
							                        </div>
							                    </div>
						                        @if ($errors->has('news_date'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('news_date') }}</strong>
													</p>
												@endif
							               	</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="title_hindi">Title Hindi</label>
												<input type="text" class="form-control" id="title_hindi" name="title_hindi" placeholder="Enter title_hindi" value="{{ isset($news) ? $news->title_hindi : old('title_hindi') }}">
												@if ($errors->has('title_hindi'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('title_hindi') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="description">Description</label><span class="text-danger">&#42;</span>
												<textarea class="form-control" id="description" name="description" rows="5">{{ isset($news) ? $news->description : old('description') }}</textarea>
												@if ($errors->has('description'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('description') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="description_hindi">Description Hindi</label>
												<textarea class="form-control" id="description_hindi" name="description_hindi" rows="5">{{ isset($news) ? $news->description_hindi : old('description_hindi') }}</textarea>
												@if ($errors->has('description_hindi'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('description_hindi') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<img src="{{ $news->feature_img }}" alt="{{ $news->title }}" width="150" height="150">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="feature_img">Feature Image</label>
												<div class="input-group">
													<div class="custom-file">
													<input type="file" class="custom-file-input" id="feature_img" name="feature_img">
														<label class="custom-file-label" for="feature_img">Choose file</label>
													</div>
												</div>
												<p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 800kB</small></p>
											</div>
											@if ($errors->has('feature_img'))
												<p class="text-danger" role="alert">
													<strong>{{ $errors->first('feature_img') }}</strong>
												</p>
											@endif
										</div>
										<div class="col-md-6">
											<div class="form-group">
					   							<label for="status">Status</label>
					   							<select class="form-control" id="status" name="status">
					   								<option {{ ($news->status == 1) ? "selected" : "" }} value="1"> Active </option>
					   								<option {{ ($news->status == 0) ? "selected" : "" }} value="0"> Inactive </option>
					   							</select>
											</div>
				   						</div>
									</div>
									<!-- Links -->
									<div class="col-2">
										<button type="submit" class="btn btn-primary btn-block">Submit</button>
									</div>
								</div>
								<!-- /.card-body -->
							</form>
						</div>
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
	$('#news_date').datetimepicker({
        format: 'Y-M-D'
    });

	CKEDITOR.replace( 'description' );
	CKEDITOR.replace( 'description_hindi' );
	// toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection