@extends('layouts.admin')
@section('content')
<div class="content">
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success " data-target='#add_in_restaurant' data-toggle="modal" href="">
                   Add  New Restaurant
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            @include('partials.alerts')
            <div class="panel panel-default">
                <div class="panel-heading">
                    Restaurant List
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th>SR.NO</th>
                                    <th>
                                        Restaurant Name
                                    </th>
                                    <th>
                                        Restaurant Code
                                    </th>
                                    <th>
                                        Restaurant Description
                                    </th>
                                    <th>
                                        Phone Number
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Resaturant Image
                                    </th>
                                    <th>Edit/Delete<th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $i=1?>
                                @foreach($restaurants as $key => $restaurant)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>
                                            {{ $restaurant->restaurant_name}}
                                        </td>
                                        <td>
                                            {{ $restaurant->restaurant_code}}
                                        </td>
                                        <td>
                                            {{ $restaurant->restaurant_desc }}
                                        </td>
                                        <td>
                                            {{ $restaurant->phone_number}}
                                        </td>
                                        <td>
                                            {{ $restaurant->email}}
                                        </td>
                                        <td>

                                            <img width="100" src="{{asset('uploads/restaurant/images/'.($restaurant->restaurantImage->image ?? ''))}}">
                                        </td>
                                        <td>

                                    {{-- <a class="btn btn-xs btn-primary" href="{{ route('admin.restaurant.create', $restaurant->id) }}">
                                                   Add
                                    </a> --}}

                                    <a class="btn btn-xs btn-info restaurantEdit"  data-target='#edit_in_restaurant' data-toggle="modal" data-id="{{ $restaurant->id }}">
                                                    Edit
                                    </a>

                                    <a class="btn btn-xs btn-danger" href="{{route('admin.restaurant.delete',$restaurant->id)}}"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade" id="add_in_restaurant">
                            <div class="modal-dialog">
                               <form id="addForm" method="post" action="/">
                                    <div class="modal-content p-3">
                                        <div class="modal-body">
                                            <h5>Add Restaurant</h5>
                                            <span class="text-danger" id="inErr" role="alert">
                                            </span>
                                            <div class="form-group">
                                                <label>Restaurant Name <span class="text-danger">*</span></label>
                                                <input type="text" name="restaurant_name" id="restaurant_name" value="" class="form-control"   autofocus placeholder="Enter Restaurant name">
                                                <label class="text-danger d-none" id="restaurant_name_error"></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Restaurant Code <span class="text-danger">*</span></label>
                                                <input type="text" name="restaurant_code" id="restaurant_code" value="" class="form-control"    placeholder="Enter Restaurant Code">
                                                <label class="text-danger d-none" id="restaurant_code_error"></label>

                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number <span class="text-danger">*</span></label>
                                                <input type="number" name="phone_number" id="phone_number" value="" class="form-control"   placeholder="phone_number" >
                                                <label class="text-danger d-none" id="phone_number_error"></label>

                                            </div>
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" id="email" value="" class="form-control"   placeholder="email">
                                                <label class="text-danger d-none" id="email_error"></label>

                                            </div>

                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea name="restaurant_desc" id="restaurant_desc" class="form-control"  rows="2"></textarea>
                                                <label class="text-danger d-none" id="restaurant_desc_error"></label>

                                            </div>

                                            <div class="form-group">
                                                <label>Restaurant Image <span class="text-danger">*</span></label>
                                                <input type="file" name="image" id="image" value="" class="form-control"    placeholder="image">
                                                <label class="text-danger d-none" id="image_error"></label>

                                            </div>

                                        </div>
                                        <div class="text-right ml-auto">
                                            <button type="submit" id="submit" class="btn btn-success px-5 font-weight-bold">Submit</button>
                                        </div>

                                    </div>
                               </form>
                            </div>
                        </div>

                        <div class="modal fade" id="edit_in_restaurant">
                            <div class="modal-dialog">
                               <form id="editForm">

                                    <div class="modal-content p-3">


                                        <div class="modal-body">
                                            <h5>Edit Restaurant</h5>
                                            <input type="hidden" id="restaurant_id" name="restaurant_id" value="">
                                            <input type="hidden" name="_method" value="PATCH">

                                            <span class="text-danger" id="inErr" role="alert">

                                            </span>
                                            <div class="form-group">
                                                <label>Restaurant Name <span class="text-danger">*</span></label>
                                                <input type="text" name="restaurant_name_edit" id="restaurant_name_edit" value="" class="form-control"   autofocus placeholder="Enter Restaurant name">
                                                <label class="text-danger d-none" id="edit_restaurant_name_error"></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Restaurant Code <span class="text-danger">*</span></label>
                                                <input type="text" name="restaurant_code_edit" id="restaurant_code_edit" value="" class="form-control"    placeholder="Enter Restaurant Code">
                                                <label class="text-danger d-none" id="edit_restaurant_code_error"></label>

                                            </div>

                                            <div class="form-group">
                                                <label>Phone Number <span class="text-danger">*</span></label>
                                                <input type="number" name="phone_number_edit" id="phone_number_edit" value="" class="form-control"   placeholder="phone_number" >
                                                <label class="text-danger d-none" id="edit_phone_number_error"></label>

                                            </div>
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email_edit" id="email_edit" value="" class="form-control"   placeholder="email">
                                                <label class="text-danger d-none" id="edit_email_error"></label>

                                            </div>

                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea name="restaurant_desc_edit" id="restaurant_desc_edit" class="form-control"  rows="2"></textarea>
                                                <label class="text-danger d-none" id="edit_restaurant_desc_error"></label>

                                            </div>

                                            <div class="form-group">
                                                <label>Restaurant Image <span class="text-danger">*</span></label>
                                                <img width="100" id="image_edit_preview">
                                                <input type="file" name="image_edit" id="image_edit" value="" class="form-control"    placeholder="image">
                                                <label class="text-danger d-none" id="edit_image_error"></label>

                                            </div>


                                        </div>
                                        <div class="text-right ml-auto">
                                            <button type="submit" id="submit" class="btn btn-success px-5 font-weight-bold">Submit</button>
                                        </div>

                                    </div>
                               </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script><!-- Bootstrap 4 -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

    // Fetch data for restaurant
    $(".restaurantEdit").on('click',function(event){
        event.preventDefault();
        var id=$(this).data('id');

        let url="{{url('api/get/restuarant/')}}"+"/"+id;
        //alert(url);
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                console.log(data);
                $("#edit_in_restaurant").modal("show");
                $('#restaurant_name_edit').val(data.restuarant.restaurant_name);
                $('#restaurant_desc_edit').val(data.restuarant.restaurant_desc);
                $('#restaurant_code_edit').val(data.restuarant.restaurant_code);
                $('#phone_number_edit').val(data.restuarant.phone_number);
                $('#email_edit').val(data.restuarant.email);
                $('#restaurant_id').val(data.restuarant.id);


                image_url="{{asset('uploads/restaurant/images/')}}"+"/"+data.restuarant.restaurant_image.image;

                $("#image_edit_preview").attr("src",image_url)



            },
        error: function(jqXHR, exception) {
                console.log(jqXHR);
            },
            cache: false,
            contentType: false,
            processData: false
        });

    });



    //submit restaurant form
    $("#addForm").on("submit", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    var formData = new FormData(this);

    $.ajax({
        url: "{{route('restaurant.add')}}",
        type: "POST",
        data: formData,
        success: function (msg) {
            console.log(msg);
            window.location.reload(true);
        },
        error: function(jqXHR, exception) {
            console.log(jqXHR);
            if(jqXHR.status==402){
                    if (jqXHR.responseJSON.hasOwnProperty("restaurant_name")) {

                        $("#restaurant_name_error").text(jqXHR.responseJSON.restaurant_name[0]);
                        $('#restaurant_name_error').removeClass("d-none");

                    }

                    if (jqXHR.responseJSON.hasOwnProperty("restaurant_code")) {
                        $("#restaurant_code_error").text(jqXHR.responseJSON.restaurant_code[0]);
                        $('#restaurant_code_error').removeClass("d-none");
                    }

                    if (jqXHR.responseJSON.hasOwnProperty("phone_number")) {
                        $("#phone_number_error").text(jqXHR.responseJSON.phone_number[0]);
                        $('#phone_number_error').removeClass("d-none");
                    }

                    if (jqXHR.responseJSON.hasOwnProperty("email")) {
                        $("#email_error").text(jqXHR.responseJSON.email[0]);
                        $('#email_error').removeClass("d-none");
                    }

                    if (jqXHR.responseJSON.hasOwnProperty("image")) {
                        $("#image_error").text(jqXHR.responseJSON.image[0]);
                        $('#image_error').removeClass("d-none");
                    }

                    if (jqXHR.responseJSON.hasOwnProperty("restaurant_desc")) {
                        $("#restaurant_desc_error").text(jqXHR.responseJSON.restaurant_desc[0]);
                        $('#restaurant_desc_error').removeClass("d-none");
                    }

            }

        },
        cache: false,
        contentType: false,
        processData: false
    });

});


//edit restaurant form
$("#editForm").on("submit", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    let formData1 = new FormData(this);

    formData1.append('_method','PATCH');
    formData1.append('status','some status');
    let restaurant_id=$("#restaurant_id").val();

    $url="{{url('api/edit-restaurant')}}"+"/"+restaurant_id;

    $.ajax({
        url: $url,
        type: "post",
        data: formData1,
        success: function (msg) {

            console.log(msg);
            window.location.reload(true);
        },
        error: function(jqXHR, exception) {
            console.log(jqXHR);
            if(jqXHR.status==402){
                    if (jqXHR.responseJSON.hasOwnProperty("restaurant_name_edit")) {
                    console.log(jqXHR.responseJSON.restaurant_name_edit);
                        $("#edit_restaurant_name_error").text(jqXHR.responseJSON.restaurant_name_edit[0]);
                        $('#edit_restaurant_name_error').removeClass("d-none");

                    }

                    if (jqXHR.responseJSON.hasOwnProperty("restaurant_code_edit")) {
                        console.log();
                        $("#edit_restaurant_code_error").text(jqXHR.responseJSON.restaurant_code_edit[0]);
                        $('#edit_restaurant_code_error').removeClass("d-none");
                    }

                    if (jqXHR.responseJSON.hasOwnProperty("phone_number_edit")) {
                        $("#edit_phone_number_error").text(jqXHR.responseJSON.phone_number_edit[0]);
                        $('#edit_phone_number_error').removeClass("d-none");
                    }

                    if (jqXHR.responseJSON.hasOwnProperty("email_edit")) {
                        $("#edit_email_error").text(jqXHR.responseJSON.email_edit[0]);
                        $('#edit_email_error').removeClass("d-none");
                    }



                    if (jqXHR.responseJSON.hasOwnProperty("restaurant_desc_edit")) {
                        $("#edit_restaurant_desc_error").text(jqXHR.responseJSON.restaurant_desc_edit[0]);
                        $('#edit_restaurant_desc_error').removeClass("d-none");
                    }

            }

        },
        cache: false,
        contentType: false,
        processData: false
    });

});

});

</script>

@endsection

