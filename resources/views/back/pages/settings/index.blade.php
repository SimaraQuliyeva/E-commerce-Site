@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Settings Table</h4>
                        <p class="card-description">
                            <a href="{{route('admin.setting.create')}}" class="btn btn-primary">+Add</a>
                        </p>
                        <div class="table-responsive">
                            @if(session('success'))
                                <div class="alert alert-success mt-3" id="success-div">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger mt-3" id="error-div">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
{{--                                    <th>Image</th>--}}
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
{{--                                    <th>Set Type</th>--}}
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($settings) && $settings->count() > 0)
                                    @foreach($settings as $setting)
                                        <tr class="item" item-id="{{$setting->id}}">
{{--                                            <td class="py-1">--}}
{{--                                                @if($setting->set_type=='image')--}}
{{--                                                    <img src="{{asset($setting->image)}}" alt="image"/>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td>{{$setting->id}}</td>
                                            <td>{{$setting->address}}</td>
                                            <td>{{$setting->phone}}</td>
                                            <td>{{$setting->email ?? ''}}</td>
{{--                                            <td>{{$setting->set_type}}</td>--}}

                                            <td class="d-flex">
                                                <a href="{{route('admin.setting.edit', $setting->id)}}" class="btn btn-primary mr-2 btn-sm">Edit</a>
                                                <button type="button" class="del btn btn-danger btn-sm del">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('customJs')
    <script>

        $(document).on('click', '.del', function(e) {
            e.preventDefault();
            var item=$(this).closest('.item');
            id=item.attr('item-id');
            alertify.confirm("Are you sure?","Are you sure you want to delete?",
                function(){

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:"DELETE",
                        url:"{{route('admin.setting.destroy') }}",
                        data:{
                            id:id,
                        },
                        success: function (response) {
                            if (response.error == false)
                            {
                                item.remove();
                                alertify.success(response.message);
                            } else{
                                alertify.error("Operation failured");
                            }
                        }
                    });
                    },
                function(){
                    alertify.error('Canceled');
                });
        });

    </script>
@endsection
