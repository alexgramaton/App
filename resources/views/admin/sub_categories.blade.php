@extends('layouts.master')

@section('title')
    list of subcategories | Portugal Foods
@endsection

@section('content')
{{--Start new add subcategory modal--}}
<div class="modal fade" id="newSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubCategoryLabel">New subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/addSubCategory" method="post">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="selCategory">Categories</label>
						<select name="selCategory" id="selCategory" class="form-control">
							<option value="0">Select category</option>
							@foreach ($categories as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
          <div class="form-group">
            <label for="subCategoryName" class="col-form-label">Name:</label>
            <input type="text" name="subCategoryName" class="form-control" id="subCategoryName" placeholder="Name of subcategory" required>
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Add</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End new add subcategory modal--}}

{{--Start edit subcategory modal--}}
<div class="modal fade" id="editSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSubCategoryModal">Edit subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/updateSubCategory" method="post" id="editForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-body">
          <div class="form-group">
						<label for="updateSelCategory">Categories</label>
						<select name="updateSelCategory" id="updateSelCategory" class="form-control">
							<option value="0" id="updateSelectedCategory">Select category</option>
							@foreach ($categories as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
          <div class="form-group">
            <label for="updateSubCategoryName" class="col-form-label">Name:</label>
            <input type="text" name="updateSubCategoryName" class="form-control" id="updateSubCategoryName" placeholder="Name of subcategory" required>
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Update</button>
      	</div>
			</form>
    </div>
  </div>
</div>
{{--End edit subcategory modal--}}

 <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
										<h4 class="card-title"> List of subcategories
											<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newSubCategoryModal" >ADD</button>
										</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="subCategories">
                            <thead class=" text-primary">
															<th>
                                ID
                            	</th>
                            	<th>
                                Name
															</th>
															<th hidden></th>
															<th>
                                Category
                            	</th>
															<th>
                                Edit
															</th>
															<th>
                                Delete
                            	</th>
                            </thead>
                            <tbody>
																@foreach ($subcategories as $row)
																<tr>
																	<td>{{$row->id}}</td>
																	<td>{{$row->name}}</td>
																	<td hidden>{{$row->category_id}}</td>
																	@if ($row->category == null)
    																<td></td>
																	@else
    																<td>{{$row->category->name}}</td>
																	@endif
                                	<td>
																	<a href="#" class="btn btn-info editbtn">EDIT</a>
                                	</td>
                                	<td >
																		<form action="{{url('deleteSubCategory/'.$row->id)}}" method="POST">
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
    	let table = $('#subCategories').DataTable();
			table.on('click', '.editbtn', function(){
				$tr = $(this).closest('tr');
				if ($($tr).hasClass('child')) {
					$tr = $tr.prev('.parent');
				}
				let data = table.row($tr).data();
				$('#updateSubCategoryName').val(data[1]);
				//if (data[2].value != '') {
				//	let id_val = data[2];
				//	$("#updateSelCategory [value=" + id_val + "]").attr("selected", true);
				//} else {
				$("#updateSelCategory [value=0]").attr("selected", true);
				//}
				$('#editForm').attr('action', '/updateSubCategory/'+data[0]);
				$('#editSubCategoryModal').modal('show');
			})
	} );
</script>
@endsection
