<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\TempImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Intervention\Image\File;

class HomeController extends Controller
{
    public function index()
    {
        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role',1)->count();

        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');


        //this month revenue
        $startOfMonth    = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate     = Carbon::now()->format('Y-m-d');


        $RevenueThisMonth = Order::where('status', '!=', 'cancelled')
                      ->whereDate('created_at','>=', $startOfMonth)
                      ->whereDate('created_at','<=', $currentDate)
                      ->sum('grand_total');

        //Last month revenue
          $LastMonthStartDate  =   Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
          $LastMonthEndDate  =   Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
          $LastMonthName  =   Carbon::now()->subMonth()->endOfMonth()->format('M');

          $RevenueLastMonth = Order::where('status', '!=', 'cancelled')
                      ->whereDate('created_at','>=', $LastMonthStartDate)
                      ->whereDate('created_at','<=', $LastMonthEndDate)
                      ->sum('grand_total');

        //Last 30 Days sales
        $LastThirtyDaysStartDate = Carbon::now()->subDays(30)->format('Y-m-d');

        $RevenueLastThirtyDays = Order::where('status', '!=', 'cancelled')
                      ->whereDate('created_at','>=', $LastThirtyDaysStartDate)
                      ->whereDate('created_at','<=', $currentDate)
                      ->sum('grand_total');


        //delete temp images

        $dayBeforeToday = Carbon::now()->subDay(1)->format('Y-m-d H:i:s');
        // dd($dayBeforeToday);

        $tempImages = TempImage::where('created_at','<=', $dayBeforeToday)->get();

        foreach($tempImages as $tempImage)
        {
            // echo $tempImage->created_at. '===='.$tempImage->id;
            // echo "<br>";

            $path = public_path('/temp/'.$tempImage->name);
            // echo "<br>";
            $thumbPath = public_path('/temp/thump/'.$tempImage->name);
            // echo "<br><br>";

            // Delete main image
            if(FacadesFile::exists($path))
            {
                FacadesFile::delete($path);
            }

             // delete Thump image
             if(FacadesFile::exists($thumbPath))
             {
                FacadesFile::delete($thumbPath);
             }

             TempImage::where('id',$tempImage->id)->delete();



        }




        return view('admin.dashboard',[
            'totalOrders'       => $totalOrders,
            'totalProducts'     => $totalProducts,
            'totalCustomers'    => $totalCustomers,
            'totalRevenue'      => $totalRevenue,
            'RevenueThisMonth'  => $RevenueThisMonth,
            'RevenueLastMonth'  => $RevenueLastMonth,
            'RevenueLastThirtyDays'  => $RevenueLastThirtyDays,
            'LastMonthName'          => $LastMonthName,
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
