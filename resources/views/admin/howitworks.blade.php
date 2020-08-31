@extends('layouts.master')

@section('title')
    how it works | Portugal Foods
@endsection

@section('content')
        <div class="col-md-12">
            <div class="card">
							<form action="/saveHowItWorks" method="post">
								{{ csrf_field() }}
                <div class="card-header">
										<h4 class="card-title">
											How it Works
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