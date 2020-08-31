@extends('layouts.master')

@section('title')
    companies pending approval | Portugal Foods
@endsection

@section('content')
 <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
										<h4 class="card-title">
											Companies
										</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="companiesPendingApproval">
                            <thead class=" text-primary">
															<th>
																Company name
															</th>
															<th>
                                Website
															</th>
															<th>
                                Contact email
															</th>
															<th>
																Contact phone
															</th>
															<th>
																Status
															</th>
                            </thead>
                            <tbody>
															@foreach ($companies as $row)
																<tr>
																	<td>{{$row->business_name}}</td>
                                	<td>{{$row->website_url}}</td>
																	<td>{{$row->contact_email}}</td>
																	<td>{{$row->contact_phone}}</td>
																	<td>
																		@if ($row->status == 0)
    																	<form action="{{url('approveCompany/'.$row->id)}}" method="post">
																				{{ csrf_field() }}
																				{{ method_field('PUT') }}
																				<button type="submit" class="btn btn-warning">Approve</button>
																			</form>
																		@else
    																	<span class="badge badge-pill badge-success">Approved<span>
																		@endif
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
    	$('#companiesPendingApproval').DataTable();
	} );
</script>
@endsection
