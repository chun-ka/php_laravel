
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

                            <h6 class="card-title">Add State</h6>

                            <form class="forms-sample" method="post" action="{{route('store.state')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">State Name</label>
                                    <input type="text" class="form-control"  name="state_name" >
                                </div>


                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">State Photo</label>
                                    <input type="file" class="form-control" id="image" autocomplete="off" name="state_image" >
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <img class="wd-80 rounded-circle" id="showImage" src="{{asset('upload/no_image.jpg')}}" alt="profile">
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


    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader=new FileReader();
                reader.onload=function (e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>




@endsection





