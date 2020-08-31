@extends('layouts.master')

@section('title')
    claims | Portugal Foods
@endsection

@section('content')
{{--Start new add claim modal--}}
<div class="modal fade" id="newClaimModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClaimLabel">New claim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/addClaim" method="POST">
				{{ csrf_field() }}
				<div class="modal-body">
          <div class="form-group">
            <label for="claimName" class="col-form-label">Name:</label>
            <input type="text" name="claimName" class="form-control" id="claimName" required>
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Add</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End new add claim modal--}}

{{--Start edit claim modal--}}
<div class="modal fade" id="editClaimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClaimLabel">Edit claim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/updateClaim" method="post" id="editForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-body">
          <div class="form-group">
            <label for="updateClaimName" class="col-form-label">Name:</label>
            <input type="text" name="updateClaimName" class="form-control" id="updateClaimName">
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Update</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End edit claim modal--}}

 <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
										<h4 class="card-title"> List of claims
											<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newClaimModal" >ADD</button>
										</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="claims">
                            <thead class=" text-primary">
															<th>
                                ID
                            	</th>
                            	<th>
                                Name
															</th>
															<th>
                                Edit
															</th>
															<th>
                                Delete
                            	</th>
                            </thead>
                            <tbody>
																@foreach ($claims as $row)
																<tr>
																	<td>{{$row->id}}</td>
																	<td>{{$row->name}}</td>
                                	<td>
																	<a href="#" class="btn btn-info editbtn">EDIT</a>
                                	</td>
                                	<td >
																		<form action="{{url('deleteClaim/'.$row->id)}}" method="POST">
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
    	let table = $('#claims').DataTable();
			table.on('click', '.editbtn', function(){
				$tr = $(this).closest('tr');
				if ($($tr).hasClass('child')) {
					$tr = $tr.prev('.parent');
				}
				let data = table.row($tr).data();
				$('#updateClaimName').val(data[1]);
				$('#editForm').attr('action', '/updateClaim/'+data[0]);
				$('#editClaimModal').modal('show');
			})
	} );
</script>
@endsection
