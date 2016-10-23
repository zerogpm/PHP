@if( count($errors) > 0)
@foreach($errors->all() as $error)
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
		    {{ $error }}
		</div>
	</div>
</div>
@endforeach
@endif