@extends('admin.layouts.master')
@section('title','Create Shipping')
@section('content')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Shipping Management</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('shipping.create') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                        @include('admin.message')
                        <form action="" method="POST" name="ShippingForm" id="ShippingForm">


                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">

                                                <select name="country" id="country" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @if ($countries->isNotEmpty())
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                        <option value="rest_of_word">Rest of the Word</option>
                                                    @endif
                                                </select>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">

                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            @if ($shippingCharge->isNotEmpty())

                                                @foreach ($shippingCharge as $shippingCharge)
                                                    <tr>
                                                        <td>{{ $shippingCharge->id }}</td>
                                                        <td>
                                                            {{ ($shippingCharge->country_id == 'rest_of_word') ? 'Rest of the Word' : $shippingCharge->name }}
                                                        </td>
                                                        <td>{{ $shippingCharge->amount }}</td>
                                                        <td>
                                                            <a href="{{ route('shipping.edit',$shippingCharge->id) }}" class="btn btn-primary">Edit</a>
                                                            <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteRecord({{ $shippingCharge->id }})">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            @endif
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

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
    $("#ShippingForm").submit(function(event){
        event.preventDefault();
        var element = $(this);

        $("button[type=submit]").prop('disabled',true);

        $.ajax({

            url: '{{ route("shipping.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){

                $("button[type=submit]").prop('disabled',false);

                if(response['status'] == true)
                {

                    window.location.href="{{ route('shipping.create') }}";



                }
                else
                {
                    var errors = response['errors'];
                if(errors['country'])
                {
                    $("#country").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['country']);
                }
                else
                {
                    $("#country").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                }


                if(errors['amount'])
                {
                    $("#amount").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['amount']);
                }
                else
                {
                    $("#amount").removeClass('is-invalid')
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

<script>

    function deleteRecord(id)
    {

    var url = '{{ route("shipping.delete","ID") }}';
    var newUrl = url.replace("ID",id)
    // alert(newUrl);
    // return false;


    if(confirm("Are you sure you want to delete"))
    {
        $.ajax({

            url: newUrl,
            type: 'delete',
            data: {},
            dataType: 'json',
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function(response)
                {


                    if(response['status'])
                    {

                        window.location.href="{{ route('shipping.create') }}";
                    }

                }

            });
    }


    }

</script>



@endsection
