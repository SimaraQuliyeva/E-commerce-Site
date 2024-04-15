@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Products Table</h4>
                        <p class="card-description">
                            <a href="{{route('admin.products.create')}}" class="btn btn-primary">+Add</a>
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
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($products) && $products->count() > 0)
                                    @foreach($products as $item)
                                        <tr class="item" item-id="{{$item->id}}">
                                            <td class="py-1">
                                                <img src="{{ Storage::url($item->image) }}" alt="image"
                                                     style="width: 50px; height: 50px"/>
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{!! $item->content ?? '' !!}</td>
                                            <td>${{$item->price}}</td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="status"  data-on="active" data-off="passive" data-onstyle="success"
                                                               data-offstyle="danger" {{$item->status == '1' ? 'checked': ''}} data-toggle="toggle">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.products.edit', $item->id)}}" class="btn btn-primary mr-2 btn-sm">Edit</a>
                                                <button type="button" class="del btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                        {{$products->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).on('change', '.status', function(e) {

            id=$(this).closest('.item').attr('item-id');
            statu=$(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('admin.products.status') }}",
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
                        url:"{{route('admin.products.destroy') }}",
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
