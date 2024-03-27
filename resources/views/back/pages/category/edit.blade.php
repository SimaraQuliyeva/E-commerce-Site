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

                        @if(!empty($category->id))
                            @php
                                $routeLink=route('admin.category.update', $category->id);
                            @endphp
                        @else
                            @php
                                $routeLink=route('admin.category.store');
                            @endphp
                        @endif
                        <form  action="{{$routeLink}}" class="forms-sample" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(!empty($category->id))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$category->name ?? ''}}" placeholder="Category Name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Choose the Category</label>
                                <select class="form-control" id="cat_child" name="cat_child">
                                    @if($categories)
                                            <option value="">Choose the Category</option>
                                        @foreach($categories as $sub)
                                            <option value="{{$sub->id}}" {{ isset($category) && $category->cat_child ==$sub->id ? 'selected' : ''}}>{{$sub->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('cat_child')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea type="text" class="form-control" id="content" name="content" placeholder="Category Content">{{$category->content ?? ''}}</textarea>
                                @error('content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                    <img src="{{ Storage::url($category->image ?? 'img/empty.webp') }}" class="w-50" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                @php
                                    $status= $category->status ?? '1';
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
