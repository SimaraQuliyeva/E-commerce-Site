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

                        @if(!empty($product->id))
                            @php
                                $routeLink=route('admin.products.update', $product->id);
                            @endphp
                        @else
                            @php
                                $routeLink=route('admin.products.store');
                            @endphp
                        @endif
                        <form  action="{{$routeLink}}" class="forms-sample" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(!empty($product->id))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="name"> Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$product->name ?? ''}}" placeholder="Product Name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Choose the Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    @if($categories)
                                            <option value="">Choose the Category</option>
                                        @foreach($categories as $sub)
                                            <option value="{{$sub->id}}" {{ isset($category) && $category->category_id ==$sub->id ? 'selected' : ''}}>{{$sub->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="editor">Content</label>
                                <textarea type="text" class="form-control" id="editor" name="content" placeholder="Product Content">{{$product->content ?? ''}}</textarea>
                                @error('content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="details">Details</label>
                                <input type="text" class="form-control" id="details" name="details" value="{{$product->details ?? ''}}" placeholder="Product Details">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{$product->price ?? ''}}" placeholder="Product Price">
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="size">Size</label>
                                <select name="size" id="" class="form-control">
                                    <option value="">Choose the size</option>
                                    <option value="XS" {{ isset($product->size) && $product->size == 'XS' ? 'selected' : ''}}>XS</option>
                                    <option value="S"  {{ isset($product->size) && $product->size == 'S' ? 'selected' : ''}}>S</option>
                                    <option value="M"  {{ isset($product->size) && $product->size == 'M' ? 'selected' : ''}}>M</option>
                                    <option value="L"  {{ isset($product->size) && $product->size == 'L' ? 'selected' : ''}}>L</option>
                                    <option value="XL"  {{ isset($product->size) && $product->size == 'XL' ? 'selected' : ''}}>XL</option>

                                </select>
                                @error('size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{$product->color ?? ''}}" placeholder="Product Color">
                                @error('color')
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
                                    <img src="{{ Storage::url($product->image ?? 'img/empty.webp') }}" class="w-50" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                @php
                                    $status= $product->status ?? '1';
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

