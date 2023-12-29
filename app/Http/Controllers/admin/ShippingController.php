<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function create()
    {
        $countries = Country::get();
        $data['countries']  = $countries;

        $shippingCharge = ShippingCharge::select('shipping_charges.*','countries.name')
        ->leftJoin('countries','countries.id','shipping_charges.country_id')->get();
        // dd($shippingCharges);

        $data['shippingCharge']  = $shippingCharge;
        return view('admin.shipping.create',$data);
    }

    public function store(Request $request)
    {




        $validator = Validator::make($request->all(),[


            'country'  => 'required',
            'amount'  => 'required|numeric'



        ]);


        if($validator->passes())
        {

            $count = ShippingCharge::where('country_id', $request->country)->count();
            if($count > 0)
            {
                Session::flash('error','Shipping already added');
                return response()->json([

                    'status'  => true,


                ]);
            }

            $shipping = new ShippingCharge();
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            Session::flash('success','Shipping added successfully');

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

    public function edit($id)
    {
        $shippingCharge = ShippingCharge::find($id);

        $countries = Country::get();
        $data['countries'] = $countries;
        $data['shippingCharge'] = $shippingCharge;
        return view('admin.shipping.edit',$data);
    }


    public function update(Request $request,$id)
    {
        $shipping =  ShippingCharge::find($id);

        $validator = Validator::make($request->all(),[


            'country'  => 'required',
            'amount'  => 'required|numeric'



        ]);


        if($validator->passes())
        {

            if($shipping == NULL)
            {
                Session::flash('error','shipping NOt Found');

                return response()->json([



                    'status' => true

                ]);
            }

            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            Session::flash('success','Shipping update successfully');

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


    public function destroy($id)
    {
        $shippingCharge = ShippingCharge::find($id);


        if($shippingCharge == NULL)
        {
            Session::flash('error','shipping NOt Found');

            return response()->json([



                'status' => true

            ]);
        }

        $shippingCharge->delete();

        Session::flash('success','shipping deleted successfully');

        return response()->json([



            'status' => true

        ]);
    }

}
