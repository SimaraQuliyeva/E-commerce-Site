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
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger mt-3">
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
                                            <td><label
                                                    class="badge badge-{{$slider->status == '1' ? 'success': 'danger'}}">{{$slider->status == '1' ? 'active': 'passive'}}</label>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.slider.edit', $slider->id)}}" class="btn btn-success mr-2">Edit</a>
                                                <form action="{{route('admin.slider.delete', $slider->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
