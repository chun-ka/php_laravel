
@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Amenities</h6>

                            <form id="myForm" class="forms-sample" method="post" action="{{route('store.amenitie')}}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amenities Name</label>
                                    <input type="text" class="form-control"  name="amenitis_name" >


                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <!-- right wrapper end -->
        </div>

    </div>

    {{--            Validate dùng ajax           --}}
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({    //id của form
                rules: {
                    amenitis_name: {
                        required : true,
                    },
                 },
                messages :{
                    amenitis_name: {
                        required : 'Please Enter Amenitis Name',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);  //form-group phải trùng với  class="form-group mb-3" trong trường chứa thuộc tính
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>



@endsection






