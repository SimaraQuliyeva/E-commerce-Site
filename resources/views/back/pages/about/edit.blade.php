@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
    <div class="row">
<div class="col-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic form elements</h4>
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

            <form  action="{{route('admin.about.update')}}" class="forms-sample" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$about->name ?? ''}}" placeholder="Slider Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="editor">About Content</label>
                    <textarea class="form-control" id="editor" name="content" placeholder="About Content" rows="3">{!! $about->content ?? '' !!}</textarea>
                    @error('content')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="text1_icon">Text 1 icon</label>
                    <input type="text" class="form-control" id="text1_icon" name="text1_icon" value="{{$about->text1_icon ?? ''}}" placeholder="Text 1 Icon">
                </div>
                <div class="form-group">
                    <label for="text1_header">Text 1 header</label>
                    <input type="text" class="form-control" id="text1_header" name="text1_header" value="{{$about->text1_header ?? ''}}" placeholder="Text 1 Header">
                </div>
                <div class="form-group">
                    <label for="text1_content">Text 1 content</label>
                    <textarea type="text" class="form-control" id="text1_content" name="text1_content"  placeholder="Text 1 Content">{!!$about->text1_content ?? '' !!}</textarea>
                </div>


                <div class="form-group">
                    <label for="text2_icon">Text 2 icon</label>
                    <input type="text" class="form-control" id="text2_icon" name="text2_icon" value="{{$about->text2_icon ?? ''}}" placeholder="Text 2 Icon">
                </div>
                <div class="form-group">
                    <label for="text2_header">Text 2 header</label>
                    <input type="text" class="form-control" id="text2_header" name="text2_header" value="{{$about->text2_header ?? ''}}" placeholder="Text 2 Header">
                </div>
                <div class="form-group">
                    <label for="text2_content">Text 2 content</label>
                    <textarea type="text" class="form-control" id="text2_content" name="text2_content"  placeholder="Text 2 Content">{!!$about->text2_content ?? '' !!}</textarea>
                </div>


                <div class="form-group">
                    <label for="text3_icon">Text 3 icon</label>
                    <input type="text" class="form-control" id="text3_icon" name="text3_icon" value="{{$about->text3_icon ?? ''}}" placeholder="Text 3 Icon">
                </div>
                <div class="form-group">
                    <label for="text3_header">Text 3 header</label>
                    <input type="text" class="form-control" id="text3_header" name="text3_header" value="{{$about->text3_header ?? ''}}" placeholder="Text 3 Header">
                </div>
                <div class="form-group">
                    <label for="text3_content">Text 3 content</label>
                    <textarea type="text" class="form-control" id="text3_content" name="text3_content"  placeholder="Text 3 Content">{!!$about->text3_content ?? '' !!}</textarea>
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
                      <img src="{{ Storage::url($about->image ?? 'img/empty.webp') }}" class="w-50" alt="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    @php
                      $status= $about->status ?? '1';
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
@section('customJs')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                language: 'az'
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

    </script>

@endsection
