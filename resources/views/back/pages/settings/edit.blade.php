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

            @if(!empty($setting->id))
                @php
                    $routeLink=route('admin.setting.update', $setting->id);
                @endphp
            @else
                @php
                    $routeLink=route('admin.setting.store');
                @endphp
            @endif
            <form  action="{{$routeLink}}" class="forms-sample" method="post" enctype="multipart/form-data">
                @csrf
                @if(!empty($setting->id))
                    @method('PUT')
                @endif
{{--                <select name="set_type" class="form-control">--}}
{{--                    <option value="">Choose the type</option>--}}
{{--                    <option value="ckeditor" {{!empty($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : ''}}>CkEditor</option>--}}
{{--                    <option value="file" {{!empty($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''}}>File</option>--}}
{{--                    <option value="image" {{!empty($setting->set_type) && $setting->set_type == 'image' ? 'selected' : ''}}>Image</option>--}}
{{--                    <option value="text" {{!empty($setting->set_type) && $setting->set_type == 'text' ? 'selected' : ''}}>Text</option>--}}
{{--                </select>--}}
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$setting->address ?? ''}}" placeholder="Slider Name">
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="phone"  value="{!! $setting->phone ?? '' !!}" name="phone" placeholder="">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$setting->email ?? ''}}" placeholder="Slider Link">
                </div>

{{--                <div class="form-group">--}}
{{--                    <label>File upload</label>--}}
{{--                    <input type="file" name="image" class="file-upload-default">--}}
{{--                    <div class="input-group col-xs-12">--}}
{{--                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">--}}
{{--                        <span class="input-group-append">--}}
{{--                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <div class="input-group col-xs-12">--}}
{{--                      <img src="{{ Storage::url($setting->image ?? 'img/empty.webp') }}" class="w-50" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
    </div>
    </div>
@endsection
