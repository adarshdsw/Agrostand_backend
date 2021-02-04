
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
})

var sbm = (function () {

	var order = 'created_at'
	var direction = 'desc'

	var loadHtml = function (url, that, errorAjax, title) {
		$.confirm({
			title: title,
			closeIcon: true,
			// content: 'url:'+url,
			content: function () {
				var self = this;
				return $.ajax({
					url: url,
					dataType: 'text',
					method: 'get'
				}).done(function (response) {
					self.setContent(response);
				}).fail(function(){
					self.setContent('Something went wrong.');
				});
			},
			buttons: {
				formSubmit: {
					text: 'Submit',
					btnClass: 'btn-blue',
					action: function () {
						var myform = this.$content.find('form');
						url = myform.attr('action');
						var formData = $(myform).serialize();
						var name = this.$content.find('.name').val();
						$.ajax({
							url : url,
							method : 'POST',
							dataType : 'JSON',
							data : formData,
						})
						// Code to run if the request succeeds (is done);
						// The response is passed to the function
						.done(function( res ) {
							toastr.success("Success", res.success);
							setTimeout(function(){
							  location.reload();
							},3000);
							return true;
						})
						// Code to run if the request fails; the raw request and
						// status codes are passed to the function
						.fail(function( xhr, status, errorThrown ) {
							console.log( "Error: " + errorThrown );
							console.log( "Status: " + status );
							console.dir( xhr );
							var errObj = $.parseJSON(xhr.responseText);
							$.each(errObj.errors, function (key, value){
								toastr.error(value[0]);
							});
						});
						return false;
					},
				},
				close: function () {}
			},
			columnClass: 'medium',
		});
	}

	var loadMultiPartForm = function (url, that, errorAjax, title) {
		$.confirm({
			title: title,
			closeIcon: true,
			// content: 'url:'+url,
			content: function () {
				var self = this;
				return $.ajax({
					url: url,
					dataType: 'text',
					method: 'get'
				}).done(function (response) {
					self.setContent(response);
				}).fail(function(){
					self.setContent('Something went wrong.');
				});
			},
			buttons: {
				formSubmit: {
					text: 'Submit',
					btnClass: 'btn-blue',
					action: function () {
						var myform = this.$content.find('form');
						var formObj = myform[0];
						url = myform.attr('action');
						var formData = new FormData(formObj);
						// console.log(formData);return false;
						$.ajax({
							url: url,
						  	type: 'POST',
						  	enctype: 'multipart/form-data',
						  	dataType: 'JSON',
						  	cache: false,
						  	processData: false,
						  	contentType: false,
						  	data: formData,
						})
						// Code to run if the request succeeds (is done);
						// The response is passed to the function
						.done(function( res ) {
							toastr.success("Success", res.success);
							setTimeout(function(){
							  location.reload();
							},3000);
							return true;
						})
						// Code to run if the request fails; the raw request and
						// status codes are passed to the function
						.fail(function( xhr, status, errorThrown ) {
							console.log( "Error: " + errorThrown );
							console.log( "Status: " + status );
							console.dir( xhr );
							var errObj = $.parseJSON(xhr.responseText);
							$.each(errObj.errors, function (key, value){
								toastr.error(value[0]);
							});
						});
						return false;
					},
				},
				close: function () {}
			},
			columnClass: 'medium',
		});
	}
	
	var loadView = function(title, event, that, url){
		$.confirm({
			title: title,
			// content: 'url:'+url,
			content: function () {
				var self = this;
				return $.ajax({
					url: url,
					dataType: 'text',
					method: 'get'
				}).done(function (response) {
					self.setContent(response);
				}).fail(function(){
					self.setContent('Something went wrong.');
				});
			},
			columnClass: 'medium',
		});
	}

	var ajax = function (target, verb, errorAjax) {
		spin()
		$.ajax({
			url: target,
			type: verb,
			dataType : 'json'
		})
			.done(function (response) {
				console.log(response);
				// load(url, errorAjax)
			})
			.fail(function () {
				fail(errorAjax)
			}
		)
	}

	var ajaxNoLoad = function (target, verb, errorAjax, that) {
		spin()
		$.ajax({
			url: target,
			type: verb
		})
			.done(function () {
				unSpin()
				that.prop('disabled', true)
			})
			.fail(function () {
				fail(errorAjax)
			})
	}

	var load = function (url, errorAjax) {
		$.get(url, buildParameters())
			.done(function (data) {
				done(data)
			})
			.fail(function () {
				fail(errorAjax)
			}
		)
	}

	var spin = function () {
		$('#spinner').html('<span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>')
	}

	var unSpin = function () {
		$('#spinner').empty()
	}

	var done = function (data) {
		$('#pannel').html(data.table)
		$('#pagination').html(data.pagination)
		unSpin()
	}

	var fail = function (errorAjax) {
		unSpin()
		swal({
			title: errorAjax,
			type: 'warning'
		})
	}

	var destroy = function (event, that, url, swalTitle, confirmButtonText, cancelButtonText, errorAjax) {
		event.preventDefault()
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			type: "warning",
			showCancelButton: !0,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
			confirmButtonClass: "btn btn-primary",
			cancelButtonClass: "btn btn-danger ml-1",
			buttonsStyling: !1,
		}).then(function (t) {
		  if(t.value){
			var id = that.data('menu_id');
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax({
				url: that.attr('href'),
				type: 'DELETE',
				dataType: 'JSON',
				data:{
					'id': id,
					'_token': token,
				},
				success : function(res){
					if(res != 'false'){
						Swal.fire({ type: "success", title: "Deleted!", text: "Your file has been deleted.", confirmButtonClass: "btn btn-success" });
						that.parents('tr').remove();
					}else{
						Swal.fire({ title: "Error", text: "Something went wrong :)", type: "error", confirmButtonClass: "btn btn-danger" });
					}
				},
				fail : function(error){
					console.log(error)
				}
			})    
		  }else{
			Swal.fire({ title: "Cancelled", text: "Your imaginary file is safe :)", type: "error", confirmButtonClass: "btn btn-success" });
		  }
		});
		
		/*Swal({
			title: swalTitle,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: confirmButtonText,
			cancelButtonText: cancelButtonText
		}).then(function () {
			console.log(that); return false;
			ajax(that.attr('href'), 'DELETE', url, errorAjax)
		})*/
	}

	return {
		ajax     : ajax,
		spin     : spin,
		unSpin   : unSpin,
		loadHtml : loadHtml,
		loadView : loadView,
		destroy  : destroy,
		loadMultiPartForm  : loadMultiPartForm,
	}

})()