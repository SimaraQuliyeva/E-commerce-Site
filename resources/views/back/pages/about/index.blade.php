@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sliders Table</h4>
                        <p class="card-description">
                            <a href="{{route('admin.slider.create')}}" class="btn btn-primary">+Add</a>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($sliders) && $sliders->count() > 0)
                                    @foreach($sliders as $slider)
                                        <tr class="item" item-id="{{$slider->id}}">
                                            <td class="py-1">
                                                <img src="{{ Storage::url($slider->image) }}" alt="image"
                                                     style="width: 50px; height: 50px"/>
                                            </td>
                                            <td>{{$slider->name}}</td>
                                            <td>{{$slider->content ?? ''}}</td>
                                            <td>{{$slider->link}}</td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="status"  data-on="active" data-off="passive" data-onstyle="success"
                                                               data-offstyle="danger" {{$slider->status == '1' ? 'checked': ''}} data-toggle="toggle">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.slider.edit', $slider->id)}}" class="btn btn-primary mr-2 btn-sm">Edit</a>

{{--                                                <form action="{{route('admin.slider.destroy', $slider->id)}}" method="post">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}

                                                <button type="button" class="del btn btn-danger btn-sm">Delete</button>
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
{{--<script>--}}
{{--    alertify--}}
{{--        .alert("This is an alert dialog.", function(){--}}
{{--            alertify.message('OK');--}}
{{--        });--}}
{{--</script>--}}
    <script>
        $(document).on('change', '.status', function(e) {

            id=$(this).closest('.item').attr('item-id');
            statu=$(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('admin.slider.status') }}",
                data:{
                    id:id,
                    statu:statu
                },
                success: function (response) {
                    if (response.status == true)
                    {
                        alertify.success("Status is active");
                    } else{
                        alertify.error("Status is passive");
                    }
                }
            });
        });

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
                        url:"{{route('admin.slider.destroy') }}",
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
