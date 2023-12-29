<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {

        //feature product
        $products = Product::where('is_featured', 'Yes')
                           ->orderBy('id', 'DESC')
                           ->take(8)
                           ->where('status','1')
                           ->get();
        $data['Featuredproducts'] = $products;

        //latest product
        $LatestProducts = Product::orderBy('id', 'DESC')
                                   ->where('status','1')
                                   ->take(8)
                                   ->get();


        $data['LatestProducts'] = $LatestProducts;

        return view('front.home', $data);
    }


    public function addToWishlist(Request $request)
    {
        if(Auth::check() == false)
        {

            session(['url.intended' => url()->previous()]);

            return response()->json([

                'status'  => false


            ]);
        }

        $product = Product::where('id',$request->id)->first();

        if ($product == null)
        {
            return response()->json([


                'status' => true,
                'message' => '<div class="alert alert-danger">Product Not Found</div>'

            ]);
        }


        Wishlist::updateOrCreate(

            [

                'user_id'     => Auth::user()->id,
                'product_id'  => $request->id,


            ],
            [
                'user_id'     => Auth::user()->id,
                'product_id'  => $request->id,

            ]

        );

        // $wishlist = new Wishlist();
        // $wishlist->user_id = Auth::user()->id;
        // $wishlist->product_id = $request->id;
        // $wishlist->save();



        return response()->json([


            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"'.$product->title.'"</strong> added in your wishlist</div>'

        ]);
    }

    public function page($slug)
    {
        $page = Page::where('slug',$slug)->first();

        if($page == null)
        {
            abort(404);
        }


        return view('front.page',['page' => $page]);
    }

    public function sendContactEmail(Request $request)
    {
        $validator = Validator::make($request->all(),[


            'name'      =>  'required',
            'email'     =>  'required|email',
            'subject'   =>  'required|min:10'


        ]);

        if($validator->passes())
        {
            // send email hear

            $mailData = [

                'name'          => $request->name,
                'email'         => $request->email,
                'subject'       => $request->subject,
                'message'       => $request->message,
                'mail_subject'  => 'You have received a contact Email'


            ];

            $admin = User::where('id',1)->first();

            Mail::to($admin->email)->send(new ContactEmail($mailData));

            Session::flash('success','Thanks for contacting us, we will get back to you soon.');

            return response()->json([

                'status'  => true



            ]);

        }
        else
        {
            return response()->json([

                'status'  => false,
                'errors'  => $validator->errors()


            ]);
        }
    }
}
