<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Colors\Rgb\Channels\Red;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest();

        if(!empty($request->get('keyword')))
        {
            $users = $users->where('name','like','%'.$request->get('keyword').'%');
            $users = $users->orWhere('email','like','%'.$request->get('keyword').'%');
        }

        $users = $users->paginate(10);

        return view('admin.users.list',['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[


            'name' => 'required',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'phone' => 'required'


        ]);

        if($validator->passes())
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();

            $message = Session::flash('success','User added successfully');

            return response()->json([

                'status'  => true,
                'message' => $message


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

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if($user == null)
        {
            $message = Session::flash('error','User Not Found');

            return redirect()->route('users.index');
        }

        return view('admin.users.edit',['user' => $user]);
    }


    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if($user == null)
        {
            $message = Session::flash('error','User Not Found');

            return response()->json([

                'status' => true,
                'message' => $message

            ]);

        }



        $validator = Validator::make($request->all(),[


            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            // 'email' => 'required|email|unique:users',
            'phone' => 'required'


        ]);

        if($validator->passes())
        {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;

            if($request->password != '')
            {
                $user->password = Hash::make($request->password);
            }


            $user->save();

            $message = Session::flash('success','User Update successfully');

            return response()->json([

                'status'  => true,
                'message' => $message


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

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if($user == null)
        {
            $message = Session::flash('error','User Not Found');

            return response()->json([

                'status' => true,
                'message' => $message

            ]);

        }

        $user->delete();

        $message = Session::flash('success','User delete successfully');

        return response()->json([

            'status' => true,
            'message' => $message

        ]);
    }
}
