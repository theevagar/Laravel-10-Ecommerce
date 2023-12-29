<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        $brands = Brand::latest('id');

        if($request->get('keyword'))
        {
            $brands = $brands->where('name','like','%'.$request->keyword.'%');
        }

        $brands = $brands->paginate(10);
        return view('admin.brands.list',compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name'     => 'required',
            'slug'     => 'required|unique:brands'


        ]);

        if($validator->passes())
        {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();


            Session::flash('message','Brand added successfully');

            return response()->json([

                'status'   => true,
                'message'   => 'Brand added successfully'


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
        $brand = Brand::find($id);

        if(empty($brand))
        {
            Session::flash('error','Record Not Found');

            return redirect()->route('brands.index');
        }

        $data['brand'] = $brand;
        return view('admin.brands.edit',$data);
    }

    public function update(Request $request,$id)
    {

        $brand = Brand::find($id);

        if(empty($brand))
        {
            Session::flash('error','Record Not Found');

            // return redirect()->route('brands.index');

            return response()->json([

                'status'  => false,
                'notFound'  => true,

            ]);
        }


        $validator = Validator::make($request->all(),[

            'name'     => 'required',
            // 'slug'     => 'required|unique:brands'
            'slug'  =>  'required|unique:categories,slug,'.$brand->id.',id',


        ]);

        if($validator->passes())
        {

            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();


            Session::flash('success','Brand update successfully');

            return response()->json([

                'status'   => true,
                'message'   => 'Brand update successfully'


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
        $brand = Brand::find($id);

        if(empty($brand))
        {
            Session::flash('error','Record Not Found');

            return response([

                'status'   => false,
                'notFound'   => true


            ]);
        }

        $brand->delete();
        Session::flash('success','Brand deleted successfully');

        return response([

            'status'   => true,
            'message'   => 'Brand deleted successfully'


        ]);

    }
}
