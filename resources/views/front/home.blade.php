@extends('front.layouts.master')
@section('title','Front Home Page')
@section('content')


<main>
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>

                        <img src="{{ asset('front_assets/images/tamil_actor/tamil-group-actor.jpg') }}" alt="" />

                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Tamil Actor</h1>
                            <p class="mx-md-5 px-5">The scene changed in 1934 when Madras got its first sound studio. By this time, all the cinema houses in Madras had been wired for sound.

                            </p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>


                        <img src="{{ asset('front_assets/images/malaiyalam_actor/malaiyalam actor.jpeg') }}" alt="" />

                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Malaiyaalma Actor</h1>
                            <p class="mx-md-5 px-5">
                                In the 1970s, the Malayalam film industry saw the rise of film societies. It triggered a new genre of films known as "parallel cinema". The main driving forces of the movement, who gave priority to serious cinema
                            </p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>

                        <img src="{{ asset('front_assets/images/telugu_actor/telugu actor.jpg') }}" alt="" />

                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Telugu Actor</h1>
                            <p class="mx-md-5 px-5">
                                In 1934, the industry saw its first major commercial success with Lava Kusa. Directed by C. Pullayya and starring Parupalli Subbarao and Sriranjani, the film attracted unprecedented
                            </p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>

                        <img src="{{ asset('front_assets/images/hidni_Actor/hindi-actor.jpeg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Hindi Actor</h1>
                            <p class="mx-md-5 px-5">
                                "Bollywood" is a portmanteau derived from Bombay (the former name of Mumbai) and "Hollywood", a shorthand reference for the American film industry which is based in Hollywood, California.
                            </p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
            <div class="row pb-3">
                @if (getCategories()->isNotEmpty())
                    @foreach (getCategories() as $category)
                        <div class="col-lg-3">
                            <div class="cat-card ">
                                <div class="left">
                                    @if ($category->image != "")
                                        <img src="{{ asset('uploads/category/thump/'.$category->image) }}" alt="{{ $category->image }}" class="img-fluid" >
                                    @endif
                                    {{-- <img src="{{ asset('front_assets/images/cat-1.jpg') }}" alt="" class="img-fluid"> --}}
                                </div>
                                <div class="right">
                                    <div class="cat-data ">
                                        <h2>{{ $category->name }}</h2>
                                        {{-- <p>100 Products</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            <div class="row pb-3">
                @if ($Featuredproducts->isNotEmpty())
                    @foreach ($Featuredproducts as $product)
                    @php
                    $productImage = $product->product_image->first();
                    @endphp
                    <div class="col-md-3">
                        <div class="card product-card ">
                            <div class="product-image position-relative">
                                <a href="{{ route("front.product",$product->slug) }}" class="product-img">
                                    {{-- <img class="card-img-top" src="{{ asset('front_assets/images/product-1.jpg') }}" alt=""> --}}
                                    @if (!empty($productImage->image))
                                    <img class="card-img-top" src="{{ asset('uploads/products/small/'.$productImage->image) }}" class="img-thumbnail" />
                                    @else
                                    <img src="{{ asset('admin_assets/img/default-150x150.png') }}"  />
                                    @endif
                                </a>
                                <a onclick="addToWishlist({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>

                                <div class="product-action">
                                    @if ($product->track_qty == 'Yes')
                                        @if ($product->qty > 0)
                                            <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $product->id }});">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>
                                            @else
                                            <a class="btn btn-dark" href="javascript:void(0)" >
                                                Out Of Stock
                                            </a>
                                        @endif
                                    @else
                                    <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>${{ $product->price }}</strong></span>
                                    @if ($product->compare_price > 0)
                                    <span class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Latest Produsts</h2>
            </div>
            <div class="row pb-3">
                @if ($LatestProducts->isNotEmpty())
                    @foreach ($LatestProducts as $product)
                    @php
                    $productImage = $product->product_image->first();
                    @endphp
                    <div class="col-md-3">
                        <div class="card product-card ">
                            <div class="product-image position-relative">
                                <a href="{{ route("front.product",$product->slug) }}" class="product-img">
                                    {{-- <img class="card-img-top" src="{{ asset('front_assets/images/product-1.jpg') }}" alt=""> --}}
                                    @if (!empty($productImage->image))
                                    <img class="card-img-top" src="{{ asset('uploads/products/small/'.$productImage->image) }}" />
                                    @else
                                    <img src="{{ asset('admin_assets/img/default-150x150.png') }}"  />
                                    @endif
                                </a>

                                <a onclick="addToWishlist({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>

                                <div class="product-action">
                                    @if ($product->track_qty == 'Yes')
                                        @if ($product->qty > 0)
                                            <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $product->id }});">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>
                                            @else
                                            <a class="btn btn-dark" href="javascript:void(0)" >
                                                Out Of Stock
                                            </a>
                                        @endif
                                    @else
                                    <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>${{ $product->price }}</strong></span>
                                    @if ($product->compare_price > 0)
                                    <span class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                {{-- <div class="col-md-12 pt-5">
                    {{ $LatestProducts->links()  }}
                </div> --}}

            </div>
        </div>
    </section>
</main>


@endsection
