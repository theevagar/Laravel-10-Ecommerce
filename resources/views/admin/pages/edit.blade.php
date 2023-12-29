@extends('admin.layouts.master')
@section('title','Create Edit Page')
@section('content')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Page</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('pages.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                        <form action="" method="POST" name="PageUpdateForm" id="PageUpdateForm">


                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name">Name</label>
                                                <input value="{{ $page->name }}" type="text" name="name" id="name" class="form-control" placeholder="Name">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input value="{{ $page->slug }}" type="text" readonly  name="slug" id="slug" class="form-control" placeholder="Slug">
                                                <p></p>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="content">Content</label>
                                                <textarea name="content" id="content" cols="30" rows="10" class="summernote" placeholder="">{{ $page->content }}</textarea>
                                            </div>
                                        </div>
{{--
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                                <label for="statuss">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">block</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                                <label for="statuss">Show On Home</label>
                                                <select name="showHome" id="showHome" class="form-control">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 pt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                            </div>
                        </form>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
@endsection

@section('customejs')


{{-- validation of category form --}}
<script>
    $("#PageUpdateForm").submit(function(event){
        event.preventDefault();
        var element = $(this);

        $("button[type=submit]").prop('disabled',true);

        $.ajax({

            url: '{{ route("pages.update",$page->id) }}',
            type: 'put',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){

                $("button[type=submit]").prop('disabled',false);

                if(response['status'] == true)
                {



                    $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $("#slug").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                    window.location.href="{{ route('pages.index') }}";

                }
                else
                {
                    var errors = response['errors'];
                if(errors['name'])
                {
                    $("#name").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['name']);
                }
                else
                {
                    $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                }


                if(errors['slug'])
                {
                    $("#slug").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['slug']);
                }
                else
                {
                    $("#slug").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                }

                }




            }, error: function(jqXHR, exception)

            {
                console.log("Something went wrong");
            }



        })




    });










</script>


<script>
    $("#name").change(function(){

element = $(this);

$("button[type=submit]").prop('disabled',true);
$.ajax({


        url: '{{ route("getSlug") }}',
        type: 'get',
        data: {title: element.val()},
        dataType: 'json',
        success: function(response)
        {
            $("button[type=submit]").prop('disabled',false);

            if(response['status'] == true)
            {
                $("#slug").val(response['slug']);
            }

        }


    });


});



</script>



@endsection
