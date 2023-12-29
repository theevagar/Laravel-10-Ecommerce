<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::latest();

        if($request->keyword != '')
        {
            $pages = $pages->where('name','like','%'.$request->keyword.'%');
        }

        $pages = $pages->paginate(10);

        return view('admin.pages.list', ['pages' => $pages]);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[


            'name'    => 'required',
            'slug'    => 'required',

        ]);


        if($validator->fails())
        {
            return response()->json([

                'status'    => false,
                'errors'    => $validator->errors()


            ]);
        }


        $page = new Page();
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();


        $message = Session::flash('success','Pages added successfully');

        return response()->json([

            'status'    => true,
            'errors'    => $message


        ]);



    }

    public function edit(Request $request, $id)
    {
        $page = Page::find($id);

        if($page == null)
        {
            Session::flash('error','Page Not Found');
            return redirect()->route('pages.index');
        }

        return view('admin.pages.edit',['page' => $page]);
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        if($page == null)
        {
            Session::flash('error','Page Not Found');
            if($page == null)
            {
                Session::flash('error','Page Not Found');

                return response()->json([

                    'status'    => true,



                ]);

            }
        }

        $validator = Validator::make($request->all(),[


            'name'    => 'required',
            'slug'    => 'required',

        ]);


        if($validator->fails())
        {
            return response()->json([

                'status'    => false,
                'errors'    => $validator->errors()


            ]);
        }



        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();


        $message = Session::flash('success','Pages Updated successfully');

        return response()->json([

            'status'    => true,
            'errors'    => $message


        ]);

    }


    public function destroy(Request $request, $id)
    {
        $page = Page::find($id);

        if($page == null)
        {
            Session::flash('error','Page Not Found');

            return response()->json([

                'status'    => true,



            ]);

        }

        $page->delete();

        $message = Session::flash('success','Pages deleted successfully');

        return response()->json([

            'status'    => true,
            'errors'    => $message


        ]);



    }

}
