@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/articles') }}">Articles</a> :
@endsection
@section("contentheader_description", $article->$view_col)
@section("section", "Articles")
@section("section_url", url(config('laraadmin.adminRoute') . '/articles'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Article Edit : ".$article->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($article, ['route' => [config('laraadmin.adminRoute') . '.articles.update', $article->id ], 'method'=>'PUT', 'id' => 'article-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					@la_input($module, 'body')
					@la_input($module, 'article_type')
					@la_input($module, 'status')
					@la_input($module, 'file')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/articles') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#article-edit-form").validate({
		
	});
});
</script>
@endpush
