<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Color;
class CatController extends Controller
{
        public function catAdd(Request $request ,$id){
                $num_oder = $request->input('num_oder');
                $color  = $request->input('value');
                $name_color= Color::find($color);
                $color_child = $name_color->name_color;
                $parent_id = $request->input('parent');
                $child_id = $request->input('child');
                $product_id = Product::find($id);
                Cart::add([
                'id' => $product_id->id,
                'name' => $product_id->product_title,
                'qty' => $num_oder,
                'price' => $product_id->price,
                'options' => [  'color' => $color_child ,
                                'thumb' => $product_id->product_thumb,
                                'code' => $product_id->code,
                                'parent_id'=>$parent_id,
                                'child_id'=>$child_id
                 ]
                ]);


        }
        public function catShow(){
            // foreach(Cart::content() as $value){
            //    return  $ParentId[] = $value->options->parent_id;
            // }
                return \view('client.cat.show');
        }

        public function delete($id){
            Cart::remove($id);
            return \redirect('gio-hang');
        }

        public function update(Request $request){
                $updateCat = $request->input('Cat');
                foreach($updateCat as $k => $value){
                   Cart::update($k, $value);
                }
                return \redirect('gio-hang');
        }

        public function deleteAll(){
            Cart::destroy();
            return \redirect('gio-hang');
        }
        public function updateAjax(Request $request){
            $RowId = $request->input('RowId');
            $qty = $request->input('qty');
            $cartUpdate = Cart::update($RowId, $qty);
            $total_cat = array(
                'total' => number_format($cartUpdate->total , 0 ,'' , '.')."đ",
                'sub_total' => Cart::total().'đ',
                'count' => Cart::count(),
                'qty'=>$cartUpdate->qty,
            );
            echo \json_encode($total_cat);
        }
    //
}
