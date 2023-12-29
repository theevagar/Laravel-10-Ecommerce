<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = Null, $subCategorySlug = Null)
    {
        //category select id
        $CategorySelected = '';
        $subCategorySelected = '';

        // checkbox selected id
        $brandsArray = [];





        $categories = Category::orderBy('name','ASC')
                            ->with('sub_category')
                            ->where('status',1)
                            ->get();
       $brands      = Brand::orderBy('name','ASC')
                            ->where('status',1)
                            ->get();
        // $products   = Product::orderBy('title','DESC')
        //                     ->where('status',1)
        //                     ->get();

        $products = Product::where('status',1);
        // Apply filter
        if (!empty($categorySlug))
        {
            $category = Category::where('slug',$categorySlug)->first();
            $products = $products->where('category_id',$category->id);

            // catogory selected id
            $CategorySelected = $category->id;


        }

        if (!empty($subCategorySlug))
        {
            $subcategory = SubCategory::where('slug',$subCategorySlug)->first();
            $products = $products->where('sub_category_id',$subcategory->id);

            // catogory selected id
            $subCategorySelected = $subcategory->id;
        }


        if(!empty($request->get('brand')))
        {
            $brandsArray = explode(',',$request->get('brand'));
            $products = $products->whereIn('brand_id',$brandsArray);
        }


        // price range


        if($request->get('price_max') != '' && $request->get('price_min') != '')
        {
            if($request->get('price_max') == 1000)
            {
                $products = $products->whereBetween('price',[intval($request->get('price_min')),1000000]);
            }
            else
            {
                $products = $products->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);
            }
        }


        // home and shop search
        if(!empty($request->get('search')))
        {
            $products = $products->where('title','like','%'.$request->get('search').'%');
        }



        //sort order
        if($request->get('sort') != '')
        {
            if($request->get('sort') == 'latest')
            {
                $products = $products->orderBy('id','DESC');
            }
            else if($request->get('sort') == 'price_asc')
            {
                $products = $products->orderBy('price','ASC');
            }
            else
            {
                $products = $products->orderBy('price','DESC');
            }
        }
        else
        {
            $products = $products->orderBy('id','DESC');
        }

        $products = $products->paginate(6);


        $data['categories'] = $categories;
        $data['brands']     = $brands;
        $data['products']   = $products;
        $data['CategorySelected']   = $CategorySelected;//// catogory selected id
        $data['subCategorySelected']   = $subCategorySelected;
        $data['brandsArray']   = $brandsArray;
        $data['priceMax']   = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin']   = intval($request->get('price_min'));
        $data['sort']   = ($request->get('sort'));

        return view('front.shop',$data);
    }


    public function product(Request $request,$slug)
    {
        // echo $slug;
        $product = Product::where('slug',$slug)
                    ->withCount('product_ratings')
                    ->withSum('product_ratings','rating')
                    ->with(['product_image','product_ratings'])
                    ->first();
        // dd($product);
        if($product == NULL)
        {
            abort('404');
        }


        $relatedProducts = [];
        // fetch related product
        if($product->related_products != '')
        {
            $productArray = explode(',',$product->related_products);
            $relatedProducts = Product::whereIn('id',$productArray)->where('status',1)->get();
        }


        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;


        //rating calculate
        // "product_ratings_count" => 1
        // "product_ratings_sum_rating" => 3.0

        $avgRating = '0.00';
        $avgRatingPer = 0;
        if($product->product_ratings_count > 0)
        {
            $avgRating = number_format(($product->product_ratings_sum_rating/$product->product_ratings_count),2);
            $avgRatingPer = ($avgRating*100)/5;
        }

        $data['avgRating'] = $avgRating;
        $data['avgRatingPer'] = $avgRatingPer;

        return view('front.product_details',$data);
    }

    public function saveRating(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[


            'name'          =>   'required|min:5',
            'email'          =>   'required|email',
            'rating'          =>   'required',
            'comment'          =>   'required|min:10'


        ]);


        if($validator->fails())
        {
            return response()->json([


                'status'   => false,
                'errors'   => $validator->errors()

            ]);
        }

        $count = ProductRating::where('email',$request->email)->count();

        if($count > 0)
        {
            Session::flash('error', 'You already rated this product');
            return response()->json([

                'status' => true

            ]);
        }


        $productRating = new ProductRating();
        $productRating->product_id = $id;
        $productRating->username = $request->name;
        $productRating->email = $request->email;
        $productRating->comment = $request->comment;
        $productRating->rating = $request->rating;
        $productRating->save();

        Session::flash('success','Thanks for your ratings');

        return response()->json([


            'status'   => true,
            'message'   => 'Thanks for your ratings.'

        ]);

    }
}
