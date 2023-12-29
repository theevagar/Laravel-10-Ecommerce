<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TempImage;
use FFI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest();


        if(!empty($request->get('keyword')))
        {
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');
        }


        $categories = $categories->paginate(10);
        // dd($categories);
        return view('admin.category.list',compact('categories'));
    }

    public function create(Request $request)
    {

        return view('admin.category.create');
    }


    public function store(Request $request)
    {



        $validator = Validator::make($request->all(),[

            'name'  =>  'required',
            'slug'  =>  'required|unique:categories',


        ]);



        if($validator->passes())
        {


            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();



            // Save Image Here
            if(!empty($request->image_id))
            {
                // $manager = new ImageManager(new Driver());
                $manager = new ImageManager(Driver::class);

                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'.'.$ext;

                // $category = $manager->read($tempImage);
                // $category = $category->resize(370,246);

                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
                File::copy($sPath,$dPath);



                $dPath = public_path().'/uploads/category/thump/'.$newImageName;
                $img = $manager->read($sPath);
                $img->cover(300, 300);
                $img->toPng()->save($dPath);
                // genarating image thumnail


                // image generate thumbail and resize



                $category->image = $newImageName;

                $category->save();



            }




            Session::flash('success','Category added successfully');


            return response()->json([

                'status'  => true,
                'message'   => 'Category added successfully'


            ]);
        }
        else
        {
            return response()->json([

                'status'  => false,
                'errors'   => $validator->errors()


            ]);
        }






    }

    public function edit(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if(empty($category))
        {
            return redirect()->route('categories.index');
        }
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $categoryId)
    {

        $category = Category::find($categoryId);



        if(empty($category))
        {
            Session::flash('error','Category Not Found');
            return response()->json([

                'status' => false,
                'notFound' => true,
                'message' => 'Category not Found'


            ]);
        }

        $validator = Validator::make($request->all(),[

            'name'  =>  'required',
            'slug'  =>  'required|unique:categories,slug,'.$category->id.',id',



        ]);



        if($validator->passes())
        {



            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();



            // old image delete
            $oldImage = $category->image;


            // Save Image Here
            if(!empty($request->image_id))
            {
                // $manager = new ImageManager(new Driver());
                $manager = new ImageManager(Driver::class);

                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
                File::copy($sPath,$dPath);


                // // image generate thumbail and resize
                $dPath = public_path().'/uploads/category/thump/'.$newImageName;
                $img = $manager->read($sPath);
                $img->cover(300, 300);
                $img->toPng()->save($dPath);



                $category->image = $newImageName;
                $category->save();



                // Delete old image
                File::delete(public_path().'/uploads/category/'.$oldImage);


            }


            Session::flash('success','Category updated successfully');


            return response()->json([

                'status'  => true,
                'message'   => 'Category updated successfully'


            ]);
        }
        else
        {
            return response()->json([

                'status'  => false,
                'errors'   => $validator->errors()


            ]);
        }

    }

    public function destroy(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);

        if(empty($category))
        {
            Session::flash('error','Category NOt Found');

            return response()->json([


                'status' => true,
                'message' => 'Category NOt Found'



             ]);


            // return redirect()->route('categories.index');
        }

         // Delete old image
         File::delete(public_path().'/uploads/category/'.$category->image);

         $category->delete();

         Session::flash('success','Category deleted Successfully');

         return response()->json([


            'status' => true,
            'message' => 'Category deleted successfullly'



         ]);
    }
}
