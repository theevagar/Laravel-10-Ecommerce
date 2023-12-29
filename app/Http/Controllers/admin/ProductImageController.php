<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductImageController extends Controller
{
    public function update(Request $request)
    {
        // $manager = new ImageManager(new Driver());
        $manager = new ImageManager(Driver::class);

        $image = $request->image;
       $ext = $image->getClientOriginalExtension();
       $sourcePath = $image->getPathName();


       $productImage = new ProductImage();
       $productImage->product_id = $request->product_id;
       $productImage->image = 'NULL';
       $productImage->save();


       $imageName = $request->product_id.'-'.$productImage->id.'-'.time().'.'.$ext;
       $productImage->image = $imageName;
       $productImage->save();

    //    $destPath   = public_path().'/uploads/products/'.$imageName;
    //    $image = File::copy($sourcePath,$destPath);


         //genating thumnail large

         $destPath = public_path().'/uploads/products/large/'.$imageName;
         $img = ImageManager::imagick()->read($sourcePath);
         $img->resizeDown(1400,200);
         $img->toJpeg()->save($destPath);


         //genating thumnail small

         $destPath = public_path().'/uploads/products/small/'.$imageName;
         $img = $manager->read($sourcePath);
         $img->cover(300, 300);
         $img->toJpeg()->save($destPath);


       return response()->json([

        'status'  => true,
        'image_id' => $productImage->id,
        'ImagePath' => asset('uploads/products/small/'.$productImage->image),
        'message'  => 'Image save successfully'


       ]);
    }


    public function destroy(Request $request)
    {
        $productImage = ProductImage::find($request->id);

        if(empty($productImage))
        {
            return response()->json([

                'status' => false,
                'message' => 'Image not Found',

            ]);
        }

        // Delete image from folder
        File::delete(public_path('uploads/products/large/'.$productImage->image));
        File::delete(public_path('uploads/products/small/'.$productImage->image));


        $productImage->delete();

        return response()->json([

            'status' => true,
            'message' => 'Image deleted successfully'


        ]);
    }
}
