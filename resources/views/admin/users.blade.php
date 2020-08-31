@extends('layouts.master')

@section('title')
    customers | Portugal Foods
@endsection

@section('content')
{{--Start new add customer modal--}}
<div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newCustomerLabel">New customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/register" method="post">
				{{ csrf_field() }}
				<div class="modal-body">
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="email" required>
					</div>
					<div class="form-group">
            <label for="password" class="col-form-label">Password:</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter the password" >

            @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
					</div>
					<div class="form-group">
						<label for="c_password" class="col-form-label">Confirm password:</label>
            <input type="password" name="c_password" id="c_password" class="form-control @error('password') is-invalid @enderror" placeholder="confirm password" required autocomplete="new-password">
					</div>

      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Register</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End new add customer modal--}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
										<h4 class="card-title">Customers
											<a href="/user-register" class="btn btn-primary float-right">REGISTER</a>
										</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="customers">
                            <thead class=" text-primary">
															<th>
                                ID
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Status
														</th>
														<th>
                                Delete
                            </th>
                            </thead>
                            <tbody>
															@foreach ($users as $row)
																<tr>
																	<td>{{$row->id}}</td>
																	<td>{{$row->email}}</td>
                                	<td>
																		@if ($row->email_verified == 1)
    																	<span class="badge badge-pill badge-success">Verified<span>
																		@else
    																	<span class="badge badge-pill badge-danger">Not verified<span>
																		@endif
																	</td>
                                	<td >
																		<form action="{{url('deleteUser/'.$row->id)}}" method="POST">
																			{{ csrf_field() }}
																			{{ method_field('DELETE') }}
																			<button type="submit" class="btn btn-primary">DELETE</button>
																		</form>
                                	</td>
                            		</tr>
															@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script>
	$(document).ready( function () {
    	$('#customers').DataTable();
	} );
</script>
@endsection
