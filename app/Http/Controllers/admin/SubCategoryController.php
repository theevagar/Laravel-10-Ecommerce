<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{

    public function index(Request $request)
    {
        $subcategories = SubCategory::select('sub_categories.*','categories.name as categoryName')
        ->latest('sub_categories.id')
        ->leftJoin('categories','categories.id',
        'sub_categories.category_id');


        if(!empty($request->get('keyword')))
        {
            $subcategories = $subcategories->where('sub_categories.name','like','%'.$request->get('keyword').'%');
            // $subcategories = $subcategories->where('categories.name','like','%'.$request->get('keyword').'%');
        }


        $subcategories = $subcategories->paginate(10);
        // dd($categories);
        return view('admin.subcategory.list',compact('subcategories'));
    }


    public function create()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        return view('admin.subcategory.create',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name'              => 'required',
            'slug'              => 'required|unique:sub_categories',
            'category'       => 'required',
            'status'            => 'required'


        ]);


        if($validator->passes())
        {
            $subcategory = new SubCategory();
            $subcategory->name = $request->name;
            $subcategory->slug = $request->slug;
            $subcategory->status = $request->status;
            $subcategory->category_id = $request->category;
            $subcategory->showHome = $request->showHome;
            $subcategory->save();

            Session::flash('success','Subcategory created successfully');

            return response()->json([

                'status'   => true,
                'message'   => 'Subcategory created successfully',

            ]);

        }
        else
        {
            return response()->json([


                'status'          =>    false,
                'errors'          =>    $validator->errors()

            ]);
        }
    }


    public function edit(Request $request,$id)
    {
        // echo "<h1>".$id."</h1>";
        $subcategory = SubCategory::find($id);
        if(empty($subcategory))
        {
            Session::flash('error','Record Not Found');
            return redirect()->route('sub-categories.index');
        }


        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        $data['subcategory'] = $subcategory;
        return view('admin.subcategory.edit',$data);
    }


    public function update(Request $request, $id)
    {

        $subcategory = SubCategory::find($id);
        if(empty($subcategory))
        {
            Session::flash('error','Record Not Found');
            return response([

                'status'   => false,
                'notFound'   => true

            ]);
            // return redirect()->route('sub-categories.index');
        }

        $validator = Validator::make($request->all(),[

            'name'              => 'required',
            'slug'  =>  'required|unique:sub_categories,slug,'.$subcategory->id.',id',
            'category'       => 'required',
            'status'            => 'required'


        ]);


        if($validator->passes())
        {

            $subcategory->name = $request->name;
            $subcategory->slug = $request->slug;
            $subcategory->status = $request->status;
            $subcategory->category_id = $request->category;
            $subcategory->showHome = $request->showHome;
            $subcategory->save();

            Session::flash('success','Subcategory updated successfully');

            return response()->json([

                'status'   => true,
                'message'   => 'Subcategory updated successfully',

            ]);

        }
        else
        {
            return response()->json([


                'status'          =>    false,
                'errors'          =>    $validator->errors()

            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);

        if(empty($subcategory))
        {
            Session::flash('error','Record Not Found');

            return response([

                'status'   => false,
                'notFound'   => true


            ]);
        }

        $subcategory->delete();
        Session::flash('success','Sub Category deleted successfully');

        return response([

            'status'   => true,
            'message'   => 'Sub Category deleted successfully'


        ]);

    }
}
