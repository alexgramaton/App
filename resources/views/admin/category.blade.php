@extends('layouts.master')

@section('title')
    Category-edit | Portugal Foods
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3>Editing categoty</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6"> 
								<form action="{{url('updateCategory/'.$category->id)}}" method="POST">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<div class="form-group">
										<label for="categoryName" class="col-form-label">Name:</label>
										<input name="categoryName" type="text" class="form-control" value="{{$category->name}}">
									</div>
									<button type="submit" class="btn btn-info">Update</button>
									<a href="/categories" class="btn btn-danger">Cancel</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')

@endsection