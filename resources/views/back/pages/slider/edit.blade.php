@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
    <div class="row">
<div class="col-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic form elements</h4>
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

            @if(!empty($slider->id))
                @php
                    $routeLink=route('admin.slider.update', $slider->id);
                @endphp
            @else
                @php
                    $routeLink=route('admin.slider.store', $slider->id);
                @endphp
            @endif
            <form  action="{{$routeLink}}" class="forms-sample" method="post" enctype="multipart/form-data">
                @csrf
                @if(!empty($slider->id))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$slider->name ?? ''}}" placeholder="Slider Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" placeholder="Slider Content" rows="3">{!! $slider->content ?? '' !!}</textarea>
                    @error('content')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{$slider->link ?? ''}}" placeholder="Slider Link">
                </div>

                <div class="form-group">
                    <label>File upload</label>
                    <input type="file" name="image" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group col-xs-12">
                      <img src="{{asset($slider->image ?? 'img/empty.webp') }}" alt="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    @php
                      $status= $slider->status ?? '1';
                    @endphp
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$status=='0' ? 'selected' : ''}}>Passive</option>
                        <option value="1" {{$status=='1' ? 'selected' : ''}}>Active</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
    </div>
    </div>
@endsection
