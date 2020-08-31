@extends('layouts.master')

@section('title')
    Customer-edit | Portugal Foods
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3>Editing customer</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6"> 
								<form action="{{url('updateUser/'.$user->id)}}" method="POST">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<div class="form-group">
										<label>Email</label>
										<p class="form-control">{{$user->email}}</p>
									</div>
									<div class="form-group">
										<label>Customer status</label>
										<select name="userStatus" class="form-control">
											@if ($user->status == 1)
												<option value="1"selected>Active</option>
												<option value="0">Inactive</option>
											@else
      									<option value="1">Active</option>
												<option value="0" selected>Inactive</option>
											@endif
										</select>
									</div>
									<button type="submit" class="btn btn-info">Update</button>
									<a href="/users" class="btn btn-danger">Cancel</a>
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