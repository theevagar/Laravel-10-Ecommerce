<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductRating;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest('id')->with('product_image');
        // dd($products);
        if($request->get('keyword') != "")
        {
            $products = $products->where('title','like','%'.$request->keyword.'%');
        }

        $products = $products->paginate();
        $data['products'] = $products;
        return view('admin.product.list',$data);
    }

    public function create()
    {
        $data = [];

        $categories = Category::orderBy('name', 'ASC')->get();
        $brands   =   Brand::orderBy('name', 'ASC')->get();


        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.product.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->image_array);
        // exit();

        $rules = [


                    'title'       =>        'required',
                    'slug'        =>        'required|unique:products',
                    'price'       =>        'required|numeric',
                    'sku'         =>        'required|unique:products',
                    'track_qty'   =>        'required|in:Yes,No',
                    'category'    =>        'required|numeric',
                    'is_featured' =>        'required|in:Yes,No',



                ];


                if (!empty($request->track_qty) && $request->track_qty == 'Yes')
                {
                    $rules['qty'] = 'required|numeric';
                }


        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes())
        {
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price     = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->shipping_returns = $request->shipping_returns;
            $product->short_description = $request->short_description;
            $product->related_products = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->save();


            // Save Gallery Pic
            if(!empty($request->image_array))
            {
                // $manager = new ImageManager(new Driver());
                $manager = new ImageManager(Driver::class);

                foreach($request->image_array as $temp_image_id)
                {
                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray     = explode('.',$tempImageInfo->name);
                    $ext    = last($extArray); //like jpg,png,gif, ext

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                    // $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    // $destPath   = public_path().'/uploads/products/thump/'.$imageName;
                    // File::copy($sourcePath,$destPath);
                    $productImage->image = $imageName;
                    $productImage->save();


                    //genating thumnail large
                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/products/large/'.$imageName;
                    $img = ImageManager::imagick()->read($sourcePath);
                    $img->resizeDown(1400,200);
                    $img->toJpeg()->save($destPath);


                    //genating thumnail small
                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/products/small/'.$imageName;
                    $img = $manager->read($sourcePath);
                    $img->cover(300, 300);
                    $img->toJpeg()->save($destPath);




                    //product_id => 4 ; product_image => 1
                    // 4-1-123422345.jpg

                    // genarate product thumnail

                }
            }


            Session::flash('success','Product added successfully');

            return response()->json([

                'status'  =>   true,
                'message'  =>   'Product added successfully'


            ]);
        }
        else
        {
            return response()->json([

                'status'   => false,
                'errors'   => $validator->errors()


            ]);
        }

    }

    public function edit(Request $request, $id)
    {
        $product = Product::find($id);

        if(empty($product))
        {
            // Session::flash('error','Product Not Found');
            return redirect()->route('products.index')->with('error','Product Not Found');
        }

        $relatedProducts = [];
        // fetch related product
        if($product->related_products != '')
        {
            $productArray = explode(',',$product->related_products);
            $relatedProducts = Product::whereIn('id',$productArray)->with('product_image')->get();
        }

        // fetch product Image
        $productImage = ProductImage::where('product_id',$product->id)->get();

        $subCategories = SubCategory::where('category_id',$product->category_id)->get();
        // dd($subCategories);

        $data = [];
        $data['product'] = $product;
        $data['subCategories'] = $subCategories;
        $data['productImage'] = $productImage;
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands   =   Brand::orderBy('name', 'ASC')->get();


        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['relatedProducts'] = $relatedProducts;
        return view('admin.product.edit',$data);
    }

    public function update(Request $request, $id)
    {


        $product = Product::find($id);

        $rules = [


            'title'       =>        'required',
            'slug'        =>        'required|unique:products,slug,'.$product->id.',id',
            'price'       =>        'required|numeric',
            'sku'         =>        'required|unique:products,sku,'.$product->id.',id',
            'track_qty'   =>        'required|in:Yes,No',
            'category'    =>        'required|numeric',
            'is_featured' =>        'required|in:Yes,No',



        ];


        if (!empty($request->track_qty) && $request->track_qty == 'Yes')
        {
            $rules['qty'] = 'required|numeric';
        }


        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes())
        {

            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price     = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->shipping_returns = $request->shipping_returns;
            $product->short_description = $request->short_description;
            $product->related_products = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->save();





            Session::flash('success','Product Updated successfully');

            return response()->json([

                'status'  =>   true,
                'message'  =>   'Product Updated successfully'


            ]);
        }
        else
        {
            return response()->json([

                'status'   => false,
                'errors'   => $validator->errors()


            ]);
        }

    }


    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);

        if (empty($product))
        {
            Session::flash('error','Product Not Found');

            return response()->json([

                'status' => false,
                'errors' => true

            ]);
        }

        $productImages = ProductImage::where('product_id',$id)->get();

        if (!empty($productImages))
        {
            foreach ($productImages as $productImage)
            {
                File::delete(public_path('uploads/products/large/'.$productImage->image));
                File::delete(public_path('uploads/products/small/'.$productImage->image));
            }

            ProductImage::where('product_id',$id)->delete();
        }

        $product->delete();

        Session::flash('success','Product deleted successfully');

            return response()->json([

                'status' => true,
                'message' => 'Product deleted successfully'

            ]);


    }



    public function getProducts(Request $request)
    {
        $tempProduct = [];
        if($request->term != "")
        {
            $products = Product::where('title','like','%'.$request->term.'%')->get();

            if($products != null)
            {
                foreach($products as $product)
                {
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
                }
            }
        }

        // print_r($tempProduct);
        return response()->json([

            'tags' => $tempProduct,
            'status' =>  true

        ]);
    }

    public function productRatings(Request $request)
    {



        $ratings = ProductRating::select('product_ratings.*','products.title as ProductTitle')->orderBy('product_ratings.created_at','DESC');
        $ratings = $ratings->leftJoin('products','products.id','product_ratings.product_id');

        if($request->get('keyword') != "")
        {
            $ratings = $ratings->orWhere('products.title','like','%'.$request->keyword.'%');
            $ratings = $ratings->orWhere('product_ratings.username','like','%'.$request->keyword.'%');
        }

        $ratings = $ratings->paginate(10);
        return view('admin.product.ratings',['ratings' => $ratings]);
    }

    public function changeRatingStatus(Request $request)
    {
        $productRating = ProductRating::find($request->id);
        $productRating->status = $request->status;
        $productRating->save();


        Session::flash('success','Status changed successfully');

        return response()->json([

            'status' =>  true

        ]);

    }
}
