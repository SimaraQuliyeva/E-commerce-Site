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
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{asset($slider->image) }}" alt="image"
                                                     style="width: 50px; height: 50px"/>
                                            </td>
                                            <td>{{$slider->name}}</td>
                                            <td>{{$slider->content ?? ''}}</td>
                                            <td>{{$slider->link}}</td>
                                            <td>
                                                <div class="checkbox" item-id="{{$slider->id}}">
                                                    <label>
                                                        <input type="checkbox" class="status"  data-on="active" data-off="passive" data-onstyle="success"
                                                               data-offstyle="danger" {{$slider->status == '1' ? 'checked': ''}} data-toggle="toggle">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.slider.edit', $slider->id)}}" class="btn btn-primary mr-2 btn-sm">Edit</a>
                                                <form action="{{route('admin.slider.destroy', $slider->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
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

            id=$(this).closest('.checkbox').attr('item-id');
            statu=$(this).prop('checked').toString();
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
    </script>
@endsection
