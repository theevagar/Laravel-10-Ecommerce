<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // hardevine shoppingcart
    public function addToCart(Request $request)
    {
        $product = Product::with('product_image')->find($request->id);

        // Cart::add('293ad', 'Product 1', 1, 9.99);

        if($product == NULL)
        {
            return response()->json([

                'status'  => false,
                'message'  => 'Product Not Found'

            ]);
        }

        if(Cart::count() > 0)
        {
            //echo "Product aldready in  cart";
            //Product found in cart
            //check if this product aldready in the cart
            //Return as message that product aldready added in you cart
            //if product not found in the cart, than add product in cart

            $cartContent = Cart::content();
            $productAldreadyExist = false;

            foreach($cartContent as $item)
            {
                if($item->id == $product->id)
                {
                    $productAldreadyExist = true;
                }

            }

            if($productAldreadyExist == false)
            {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty
                ($product->product_image)) ? $product->product_image->first() : '']);

                $status = true;
                $message = '<strong>'.$product->title.'</strong> added your in cart successfully';
                Session::flash('success',$message);
            }
            else
            {
                $status = false;
                $message = $product->title. 'Aldready added in cart';
            }

        }
        else
        {
            // echo "Cart is empty now adding a product in cart";
            // cart is empty
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_image)) ? $product->product_image->first() : '']);

            $status = true;
            $message = '<strong>'.$product->title.'</strong> added your in cart successfully';
            Session::flash('success',$message);
        }

        return response()->json([

            'status'  => $status,
            'message'  => $message

        ]);


    }

    public function cart()
    {

        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;
        // dd(Cart::content($cartContent));
         return view('front.cart',$data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;


        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);
        //check qty available in stock

        if($product->track_qty == 'Yes')
        {


            if($qty <= $product->qty)
            {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $status = true;
                Session::flash('success', $message);
            }
            else
            {
                $message = 'Requested qty('.$qty.') not available in stock.';
                $status = false;
                Session::flash('error', $message);
            }
        }
        else
        {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $status = true;
                Session::flash('success', $message);
        }


        return response()->json([


            'status' => $status,
            'message' => $message


        ]);
    }

    public function deleteItem(Request $request)
    {
        $itemInfo = Cart::get($request->rowId);

        if($itemInfo == NULL)
        {
            $errorMessage = 'Item not found in cart';
            Session::flash('error',$errorMessage);

            return response()->json([


                'status' => false,
                'message' => $errorMessage

            ]);
        }


        Cart::remove($request->rowId);

        $message = 'Item removed from cart successfully';
        Session::flash('success',$message);

        return response()->json([


            'status' => true,
            'message' => $message

        ]);
    }


    public function checkout()
    {




        $discount = 0;

        // -- if cart empty redirect to cart page
        if(Cart::count() == 0)
        {
            return redirect()->route('front.cart');
        }

        // -- if user is not logged in then redirect to login page
        if(Auth::check() == false){


                if (!session()->has('url.intended')){
                    session(['url.intended' => url()->current()]);
                }


            return redirect()->route('account.login');
        }


        $customerAddress = CustomerAddress::where('user_id',Auth::user()->id)->first();

        session()->forget('url.intended');
        $countries = Country::orderBy('name','ASC')->get();

        $subTotal = Cart::subtotal(2,'.','');

         // Apply discount here
         if(Session::has('code'))
         {
             $code = Session::get('code');

             if($code->type == 'percent')
             {
                 $discount = ($code->discount_amount/100)*$subTotal;
             }
             else
             {
                 $discount = $code->discount_amount;
             }
         }


        //calculating shipping here

        if($customerAddress != '')
        {
            $userCountry = $customerAddress->country_id;
            $shippingInfo = ShippingCharge::where('country_id',$userCountry)->first();

            // echo $shippingInfo->amount;

            $totalQty = 0;
            $totalShippingCharge = 0;
            $grandTotal = 0;
            foreach (Cart::content() as $item)
            {
                $totalQty = $item->qty;
            }
            $totalShippingCharge = $totalQty*$shippingInfo->amount;
            $grandTotal = ($subTotal-$discount)+$totalShippingCharge;
        }
        else
        {
            $grandTotal = ($subTotal-$discount);
            $totalShippingCharge = 0;


        }



        return view('front.checkout',[

            'countries'             => $countries,
            'customerAddress'       => $customerAddress,
            'totalShippingCharge'   => $totalShippingCharge,
            'discount'              =>  $discount,
            'grandTotal'            => $grandTotal

        ]);
    }

    public function processCheckout(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'first_name'  =>  'required|min:5',
            'last_name'  =>  'required',
            'email'  =>  'required',
            'country'  =>  'required',
            'address'  =>  'required|min:30',
            'city'  =>  'required',
            'state'  =>  'required',
            'zip'  =>  'required',
            'mobile'  =>  'required',




        ]);



        if($validator->fails())
        {
            return response()->json([

                'message' => 'please fix the error',
                'status'  => false,
                'errors'  => $validator->errors()


            ]);
        }


        $user = Auth::user();

        // $customerAddress = User::find($user);

        CustomerAddress::updateOrCreate(


            ['user_id' => $user->id],

            [

                'user_id'            => $user->id,
                'first_name'         => $request->first_name,
                'last_name'          => $request->last_name,
                'email'              => $request->email,
                'mobile'             => $request->mobile,
                'country_id'        => $request->country,
                'address'            => $request->address,
                'apartment'          => $request->apartment,
                'city'               => $request->city,
                'state'              => $request->state,
                'zip'                => $request->zip


            ]


        );


        if($request->payment_method == 'cod')
        {

            $discountCodeId = NULL;
            $promoCode = '';

            //Calculate shipping
            $shipping = 0;
            $discount = 0;
            $subTotal = Cart::subtotal(2,'.','');


            // Apply discount here
            if(Session::has('code'))
            {
                $code = Session::get('code');

                if($code->type == 'percent')
                {
                    $discount = ($code->discount_amount/100)*$subTotal;
                }
                else
                {
                    $discount = $code->discount_amount;
                }


                $discountCodeId = $code->id;
                $promoCode   = $code->code;

            }





            $shippingInfo = ShippingCharge::where('country_id',$request->country)->first();

            $totalQty = 0;


            foreach (Cart::content() as $item)
            {
                $totalQty += $item->qty;
            }

            if($shippingInfo != NULL)
            {
                $shipping = $totalQty*$shippingInfo->amount;

                $grandTotal = ($subTotal-$discount)+$shipping;


            }
            else
            {
                $shippingInfo = ShippingCharge::where('country_id','rest_of_word')->first();

                $shipping = $totalQty*$shippingInfo->amount;

                $grandTotal = ($subTotal-$discount)+$shipping;



            }




            $order = new Order();
            $order->subtotal          = $subTotal;
            $order->shipping          = $shipping;
            $order->grand_total       = $grandTotal;
            $order->discount          = $discount;
            $order->coupon_code_id    = $discountCodeId;
            $order->coupon_code       = $promoCode;
            $order->payment_status    = 'not paid';
            $order->status            = 'pending';
            $order->user_id           = $user->id;
            $order->first_name        = $request->first_name;
            $order->last_name         = $request->last_name;
            $order->email             = $request->email;
            $order->mobile            = $request->mobile;
            $order->address           = $request->address;
            $order->apartment         = $request->apartment;
            $order->city              = $request->city;
            $order->state             = $request->state;
            $order->zip               = $request->zip;
            $order->notes             = $request->order_notes;
            $order->country_id        = $request->country;
            $order->save();



            foreach(Cart::content() as $item)
            {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price*$item->qty;
                $orderItem->save();


                // update product stock
                $productData = Product::find($item->id);


                if($productData->track_qty == 'Yes')
                {
                    $currentQty = $productData->qty;
                    $updateQty  = $currentQty-$item->qty;
                    $productData->qty  = $updateQty;
                    $productData->save();
                }




            }





            // Send Order Email
           OrderEmail($order->id, 'customer');

            Session::flash('success','You Have successfully placed your order');

            Cart::destroy();

            Session::forget('code');

            return response()->json([


                'message'  => 'order saved successfully',
                'orderId' => $order->id,
                'status'   => true

            ]);



        }
        else
        {

        }


    }

    public function thankyou($id)
    {


        return view('front.thanks',['id' => $id]);
    }



    public function getOrderSummery(Request $request)
    {
        $subTotal = Cart::subtotal(2,'.','');
        $discount = 0;
        $discountString = '';

        // Apply discount here
        if(Session::has('code'))
        {
            $code = Session::get('code');

            if($code->type == 'percent')
            {
                $discount = ($code->discount_amount/100)*$subTotal;
            }
            else
            {
                $discount = $code->discount_amount;
            }


            $discountString = '<div class=" mt-4" id="discount-response">
                <strong>'.Session::get('code')->code.'</strong>
                <a class="btn btn-danger btn-sm" id="remove-discount"><i class="fa fa-times"></i></a>
            </div>';
        }







        if($request->country_id > 0)
        {


            $shippingInfo = ShippingCharge::where('country_id',$request->country_id)->first();


            $totalQty = 0;


            foreach (Cart::content() as $item)
            {
                $totalQty += $item->qty;
            }

            if($shippingInfo != NULL)
            {
                $shippingCharge = $totalQty*$shippingInfo->amount;

                $grandTotal = ($subTotal-$discount)+$shippingCharge;

                return response()->json([


                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount'   => number_format($discount,2),
                    'discountString'  => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2),

                ]);
            }
            else
            {
                $shippingInfo = ShippingCharge::where('country_id','rest_of_word')->first();

                $shippingCharge = $totalQty*$shippingInfo->amount;

                $grandTotal = ($subTotal-$discount)+$shippingCharge;

                return response()->json([


                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount'   => number_format($discount,2),
                    'discountString'  => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2),

                ]);

            }
        }
        else
        {

            return response()->json([

                'status' => true,
                'grandTotal' => number_format(($subTotal-$discount),2),
                'discount'   => number_format($discount,2),
                'discountString'  => $discountString,
                'shippingCharge' => number_format(0,2),

            ]);
        }
    }


    public function applyDiscount(Request $request)
    {
        // dd($request->code);
        $code = DiscountCoupon::where('code',$request->code)->first();

        if($code == null)
        {
            return response()->json([

                'status' => false,
                'message' => 'Invalid discount coupon'

            ]);
        }

        // check if coupon start date is valid or not

        $now = Carbon::now();

        // echo $now->format('Y-m-d H:i:s');

        if($code->starts_at != "")
        {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->starts_at);

            if($now->lt($startDate))
            {
                return response()->json([


                    'status'  => false,
                    'message'  => 'Invalid discount coupon'

                ]);
            }
        }

        if($code->expires_at != "")
        {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->expires_at);

            if($now->gt($endDate))
            {
                return response()->json([


                    'status'  => false,
                    'message'  => 'Invalid discount coupon'

                ]);
            }
        }



        // max_uses not mandatory
        if($code->max_uses > 0)
        {

            // how mani max_uses check coupon code
            $couponUsed = Order::where('coupon_code_id',$code->id)->count();

            if($couponUsed >= $code->max_uses)
            {
                return response()->json([


                    'status'  => false,
                    'message'  => 'Invalid discount coupon'

                ]);
            }

        }



        if($code->max_uses_user > 0)
        {
             // Max uses user check
            $couponUsedBYUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id])->count();

            if($couponUsedBYUser >= $code->max_uses_user)
            {
                return response()->json([


                    'status'  => false,
                    'message'  => 'You already use this coupon code'

                ]);
            }

        }

        $subTotal = Cart::subtotal(2,'.','');

        //min amount check
        if($code->min_amount > 0)
        {
            if($subTotal < $code->min_amount)
            {
                return response()->json([


                    'status'  => false,
                    'message'  => 'Your min amount must be $'.$code->min_amount.'.',

                ]);
            }
        }



        Session::put('code',$code);

        return $this->getOrderSummery($request);

    }

    public function removeCoupon(Request $request)
    {
        Session::forget('code');
        return $this->getOrderSummery($request);
    }

}
