
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

                            <h6 class="card-title">Add Agent</h6>

                            <form id="myForm" class="forms-sample" method="post" action="{{route('store.agent')}}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Agent Name</label>
                                    <input type="text" class="form-control"  name="name" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Agent Email</label>
                                    <input type="text" class="form-control"  name="email" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Agent Phone</label>
                                    <input type="text" class="form-control"  name="phone" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Agent Address</label>
                                    <input type="text" class="form-control"  name="address" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Agent Password</label>
                                    <input type="password" class="form-control"  name="password" >
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
                    name: {
                        required : true,
                    },
                    email: {
                        required : true,
                    },
                    phone: {
                        required : true,
                    },
                    password: {
                        required : true,
                    },
                },
                messages :{
                    name: {
                        required : 'Please Enter Agent Name',
                    },
                    email: {
                        required : 'Please Enter Agent Email',
                    },
                    phone: {
                        required : 'Please Enter Agent Phone',
                    },
                    password: {
                        required : 'Please Enter Agent Password',
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






