@extends('layouts.master')

@section('title')
    terms of usage | Portugal Foods
@endsection

@section('content')
        <div class="col-md-12">
            <div class="card">
							<form action="/saveTermsOfUsage" method="post">
								{{ csrf_field() }}
                <div class="card-header">
										<h4 class="card-title">
											Terms Of Usage
											<button id="saveBtn" name="saveBtn" type="submit" class="btn btn-primary float-right">Save</button>
										</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
										</div>
								</div>
							</form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
	CKEDITOR.replace( 'summary-ckeditor' );
</script>
@endsection