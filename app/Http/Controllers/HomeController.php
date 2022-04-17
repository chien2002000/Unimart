<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategaryProduct;
use App\Page;
use App\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categary = CategaryProduct::where('status_id' ,1)->get();
      $pagePro = Page::OrderBy('id' , 'desc')->where('status_id' ,1)->get();
      $list_hight = Product::where([
        ['status_id' ,1],
        ['product_hightlight' , 1]
      ])->get();
        $CateParent_phone =  CategaryProduct::find(1);
         $CatePhone = CategaryProduct::find(1)->categaryChild;
         $listPhoneAr = array();
        foreach($CatePhone as $cate){
          $listPhoneAr[] = "$cate->id";
        }
        $listPhone = Product::whereIn('categary_id' ,$listPhoneAr)->where([
                ['status_id' ,1]
        ])->paginate(8);
        $CateLaptop = CategaryProduct::find(2)->categaryChild;
        $listLaptopAr = array();
       foreach($CateLaptop as $cate){
         $listLaptopAr[] = "$cate->id";
       }
       $listLaptop = Product::whereIn('categary_id' ,$listLaptopAr)->where([
               ['status_id' ,1]
       ])->paginate(8);
       $CateParent_laptop =  CategaryProduct::find(2);
        return view('client.home' , compact('categary' , 'pagePro' , 'list_hight' , 'listPhone' ,'listLaptop' ,'CateParent_phone','CateParent_laptop'));
    }

}
