
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

                            <h6 class="card-title">Add Admin</h6>

                            <form id="myForm" class="forms-sample" method="post" action="{{route('store.admin')}}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Admin User Name</label>
                                    <input type="text" class="form-control"  name="username" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Admin Name</label>
                                    <input type="text" class="form-control"  name="name" >
                                </div>


                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Admin Email</label>
                                    <input type="text" class="form-control"  name="email" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Admin Phone</label>
                                    <input type="text" class="form-control"  name="phone" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Admin Address</label>
                                    <input type="text" class="form-control"  name="address" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Admin Password</label>
                                    <input type="password" class="form-control"  name="password" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Role Name</label>

                                    <select name='roles' class="form-select" id="exampleFormControlSelect1">
                                        <option selected="" disabled="">Select Group</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>

                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection







