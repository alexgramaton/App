@extends('layouts.master')

@section('title')
    category list | Portugal Foods
@endsection

@section('content')
{{--Start new add category modal--}}
<div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newCategoryLabel">New category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/addCategory" method="post">
				{{ csrf_field() }}
				<div class="modal-body">
          <div class="form-group">
            <label for="categoryName" class="col-form-label">Name:</label>
            <input type="text" name="categoryName" class="form-control" id="categoryName" placeholder="Name of category" required>
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Add</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End new add category modal--}}

{{--Start edit category modal--}}
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryLabel">Edit category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/updateCategory" method="post" id="editForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-body">
          <div class="form-group">
            <label for="categoryName" class="col-form-label">Name:</label>
            <input type="text" name="updateCategoryName" class="form-control" id="updateCategoryName" placeholder="Name of category">
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Update</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End edit category modal--}}

 <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
										<h4 class="card-title"> Category List
											<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newCategoryModal" >ADD</button>
										</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="categories">
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
															@foreach ($categories as $row)
																<tr>
																	<td>{{$row->id}}</td>
																	<td>{{$row->name}}</td>
                                	<td>
																	<a href="#" class="btn btn-info editbtn">EDIT</a>
                                	</td>
                                	<td >
																		<form action="{{url('deleteCategory/'.$row->id)}}" method="POST">
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
    	let table = $('#categories').DataTable();
			table.on('click', '.editbtn', function(){
				$tr = $(this).closest('tr');
				if ($($tr).hasClass('child')) {
					$tr = $tr.prev('.parent');
				}
				let data = table.row($tr).data();
				$('#updateCategoryName').val(data[1]);
				$('#editForm').attr('action', '/updateCategory/'+data[0]);
				$('#editCategoryModal').modal('show');
			})
	} );
</script>
@endsection
