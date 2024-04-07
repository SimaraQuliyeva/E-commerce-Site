@if(!empty($products) && $products->count() > 0)
    @foreach($products as $product)
        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
            <div class="block-4 text-center border">
                <form action="{{route('front.cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="productId" value="{{$product->id}}">
                    <figure class="block-4-image">
                        <a href="{{route('front.product.details', $product->slug)}}"><img src='{{asset($product->image) }}' alt="Image placeholder" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                        <h3><a href="{{route('front.product.details',$product->slug)}}">{{$product->name}}</a></h3>
                        <p class="mb-0">{{$product->details}}</p>
                        <p class="text-primary font-weight-bold">${{$product->price}}</p>
                        <p><button type="submit"  class="buy-now btn btn-sm btn-primary">Add To Cart</button></p>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endif
