
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

                            <h6 class="card-title">Add Roles</h6>

                            <form id="myForm" class="forms-sample" method="post" action="{{route('store.roles')}}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Roles Name</label>
                                    <input type="text" class="form-control"  name="name" >
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







