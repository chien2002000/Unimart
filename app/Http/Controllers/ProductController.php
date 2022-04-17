<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Color;
use App\Status_page;
use App\CategaryProduct;
use App\Product;
use App\AddColor;
use App\Page;
use App\DetailImage;
class ProductController extends Controller
{
    public function __construct(){
        $this->middleware(function($request , $next){
            session(['Model_active' =>'product']);
           return $next($request);
        });
    }
        public function listCat(){
            $status_pro = Status_page::all();
            $catProduct = CategaryProduct::all();
            function data_tree($data , $parent_id = 0 , $level = 0){
                $result = array();
                foreach($data as $item){
                   if($item->parent_id == $parent_id){
                       $item['level'] = $level;
                       $result[] = $item;
                       $child = data_tree($data , $item->id , $level +1);
                       $result = array_merge($result , $child );
                   }
                   unset($item);
                }
                return $result;
            }
            // $cat_post =  CategaryPost::where('parent_id' , 0)->get();
          $result =  data_tree($catProduct  , 0);
            return \view('admin.product.addCat' , compact('result' , 'status_pro'));
        }
        public function addCategoryProduct(Request $request){
            $request->validate([
                'name'=>'required',
                'slug'=>'required',
                'select'=>'required',
                'status'=>'required',
            ],
            [
                'required'=>':attribute không được để trống',
            ],
            [
                'name'=>'Tên danh mục',
                'select'=>'Danh mục cha'
            ]
        );
        CategaryProduct::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'status_id' => $request->input('status'),
            'parent_id' => $request->input('select'),
            'user_id'=> Auth::id(),
        ]);
        return \redirect('admin/product/cat/list')->with('status' ,'Bạn đã thêm danh mục thành công');
        }



        public function editCat(Request $request, $id){
            $status_pro = Status_page::all();
            $catProduct1 = CategaryProduct::find($id);
            return \view('admin.product.editCat' , compact( 'status_pro'  , 'catProduct1'));
        }
        public function updateCat(Request $request, $id){
                $request->validate([
                    'name'=>'required',
                    'slug'=>'required',
                ],
                [
                    'required'=>':attribute không được để trống',
                ],
                [
                    'name'=>'Tên danh mục',
                ]
            );
            CategaryProduct::where('id' , $id)->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'status_id' => $request->input('status'),
                'user_id'=> Auth::id(),
            ]);
            return \redirect('admin/product/cat/list')->with('status' ,'Bạn đã sửa danh mục thành công');
        }

        public function deleteCat($id){
            CategaryProduct::where('id' , $id)->delete();
            return \redirect('admin/product/cat/list')->with('status' ,'Bạn đã xoá danh mục thành công');
        }

        public function listColor(Request $request){
            $colorList = Color::all();
            return \view('admin.product.listColor' , compact('colorList'));
        }

        public function code(Request $request){
            $code = $request->input('color');
            echo $code;
        }
        public function addColor(Request $request){
            $request->validate([
                'name' =>'required',
            ],
            [
                'required'=>':attribute không được để trống',
            ],
            [
                'name'=>'Tên màu'
            ]
        );
            $code_color = $request->input('color');
            Color::create([
                'code_color' =>  $code_color,
                'name_color'=>$request->input('name'),
            ]);
            return \redirect('admin/product/list/color')->with('status' ,'Bạn đã thêm màu thành công');
        }
        public function deleteColor($id){
            Color::where('id' , $id)->delete();
            return \redirect('admin/product/list/color')->with('status' ,'Bạn đã xoá thành công');
        }
        public function add(){
            $colorList = Color::all();
            $catProduct = CategaryProduct::all();
            function data_tree($data , $parent_id = 0 , $level = 0){
                $result = array();
                foreach($data as $item){
                   if($item->parent_id == $parent_id){
                       $item['level'] = $level;
                       $result[] = $item;
                       $child = data_tree($data , $item->id , $level +1);
                       $result = array_merge($result , $child );
                   }
                   unset($item);
                }
                return $result;
            }
            // $cat_post =  CategaryPost::where('parent_id' , 0)->get();
          $result =  data_tree($catProduct  , 0);
                return \view('admin.product.add' , compact('colorList' , 'result'));
        }

        public function store(Request $request){
            $request->validate([
                'name'=>'required',
                'price'=>'required',
                'code'=>'required',
                'extps'=>'required',
                'content'=>'required',
                'cat'=>'required',
                'file'=>'required',
                'status'=>'required',
                'listColor'=>'required',
                'images'=>'required'
            ],
            [
                'required'=>':attribute không được để trống',
            ],
            [
                'name'=>'Tên sản phẩm',
                'price'=>'Giá sản phẩm',
                'code'=>'Mã sản phẩm',
                'extps'=>'Mô tả',
                'content'=>'Nội dung',
                'cat'=>'Danh mục',
                'file'=>'Hình ảnh sản phẩm',
                'status'=>'Trạng thái',
                'listColor'=>'Danh sách màu',
                'images'=>'Ảnh chi tiết',
            ]
        );
                if($request->hasFile('file')){
                    $file = $request->file;
                    // Lấy tên file
                    $file->getClientOriginalName();
                    // Lấy đuôi file
                    $file->getClientOriginalExtension();
                    // Lấy kích thước file
                    $file->getSize();
                $path= $file->move('public/uploads',$file->getClientOriginalName());
                    $thumbnail ="public/uploads/".$file->getClientOriginalName();
                }
           $add=  Product::create([
                'product_title' => $request->input('name'),
                'product_thumb' => $thumbnail,
                'code' => $request->input('code'),
                'excerpts' => $request->input('extps'),
                'content' => $request->input('content'),
                'categary_id' => $request->input('cat'),
                'status_id' => $request->input('status'),
                'categary_id' => $request->input('cat'),
                'price'=>$request->input('price'),
                'product_hightlight' => $request->input('fea'),
                'user_id'=>Auth::id(),
            ]);
           $id= $add->id;
           foreach($request->input('listColor') as $value){
                AddColor::create([
                    'color_id'=>$value,
                    'product_id'=>$id
                ]);
           }
           if($request->hasFile('images')){
            $img = $request->file('images');
            foreach($img as $file){
                 // Lấy tên file
            $file->getClientOriginalName();
            // Lấy đuôi file
            $file->getClientOriginalExtension();
            // Lấy kích thước file
            $file->getSize();
            $path= $file->move('public/uploads',$file->getClientOriginalName());
            $thumbnail_detail ="public/uploads/".$file->getClientOriginalName();
                DetailImage::create([
                    'name_detail'=>$thumbnail_detail,
                    'product_id'=>$id,
                ]);
            }

        }
        return \redirect('admin/product/list')->with('status' ,'Bạn đã thêm sản phẩm thành công');
        }
        public function list(Request $request){
                $stc =$request->input('status');
                $list = array();
                if($stc){
                    if($request->input('status') == 'public'){
                        $listPro = Product::where('status_id' , 1)->paginate(10);
                        $list =[1=>'Chờ duyệt' , 2=>'Xoá tạm thời'];

                    }
                    if($request->input('status') == 'pending'){
                        $listPro = Product::where('status_id' , 2)->paginate(10);
                        $list =[0=>'Công khai' , 2=>'Xoá tạm thời'];
                    }
                    if($request->input('status') == 'delete'){
                        $listPro = Product::onlyTrashed()->paginate(10);
                        $list =[3=>'Khôi phục' , 4=>'Xoá vĩnh viễn'];
                    }
                }else{
                    $list =[0=>'Công khai' , 1=>'Chờ duyệt', 2=>'Xoá tạm thời'];
                    $search = "";
                    if( $request->input('search')){
                        $search =$request->input('search');
                    }
                        $listPro = Product::where('product_title' , 'LIKE' ,"%{$search}%")->paginate(10);
                }
                $count_public =Product::where('status_id' , 1)->count();
                $count_pending =Product::where('status_id' , 2)->count();
                $count_delete =Product::onlyTrashed()->count();
                $count= [$count_public ,$count_pending,$count_delete ];

            return \view('admin.product.list' , compact('listPro' , 'list' , 'count'));
        }
        public function action(Request $request){
            $checkList = $request->input('checkList');
            if(!empty($checkList)){
                 $action = $request->input('action');
                if($action == 0){
                    Product::whereIn('id' , $checkList)->update([
                        'status_id'=>1,
                    ]);
                    return \redirect('admin/product/list')->with('status' ,'Bạn đã thay đổi trạng thái công khai thành công');
                }
                if($action == 1){
                    Product::whereIn('id' , $checkList)->update([
                        'status_id'=>2,
                    ]);
                    return \redirect('admin/product/list')->with('status' ,'Bạn đã thay đổi trạng thái chờ duyêt thành công');
                }
                if($action == 2){
                    Product::whereIn('id' , $checkList)->delete();
                    return \redirect('admin/product/list')->with('status' ,'Bạn đã xoá tạm thời thành công');
                }
                if($action == 3){
                    Product::withTrashed()->whereIn('id' , $checkList)->restore();
                    return \redirect('admin/product/list')->with('status' ,'Bạn đã khôi phục thành công');
                }
                if($action == 4){
                    Product::withTrashed()->whereIn('id' , $checkList)->forceDelete();
                    return \redirect('admin/product/list')->with('status' ,'Bạn đã xoá vĩnh viễn thành công');
                }
            }

        }
        public function edit($id){

           $checkColor=  Product::find($id)->color;
           $product_id = Product::find($id);
           $thumb_detail = Product::find($id)->detailImg;
            $catProduct = CategaryProduct::all();
            function data_tree($data , $parent_id = 0 , $level = 0){
                $result = array();
                foreach($data as $item){
                   if($item->parent_id == $parent_id){
                       $item['level'] = $level;
                       $result[] = $item;
                       $child = data_tree($data , $item->id , $level +1);
                       $result = array_merge($result , $child );
                   }
                   unset($item);
                }
                return $result;
            }
            // $cat_post =  CategaryPost::where('parent_id' , 0)->get();
          $result =  data_tree($catProduct  , 0);
            return \view('admin.product.edit' ,compact('result' , 'checkColor' , 'id' , 'product_id' , 'thumb_detail'));
        }
        public function delete_edit(Request $request){
               $id= $request->input('id');
               $id2= $request->input('id2');
               $thumb_detail = Product::find($id2)->detailImg;
               DetailImage::where('id' , $id)->delete($id);
               return \view('admin.product.loadAjax' , compact('thumb_detail'));
        }
        public function update(Request $request, $id){
               $product_id = Product::find($id);
            $request->validate([
                'name'=>'required',
                'price'=>'required',
                'code'=>'required',
                'extps'=>'required',
                'content'=>'required',
                'cat'=>'required',
                'status'=>'required',
            ],
            [
                'required'=>':attribute không được để trống',
            ],
            [
                'name'=>'Tên sản phẩm',
                'price'=>'Giá sản phẩm',
                'code'=>'Mã sản phẩm',
                'extps'=>'Mô tả',
                'content'=>'Nội dung',
                'cat'=>'Danh mục',
                'status'=>'Trạng thái',

            ]
        );
        if($request->hasFile('file')){
            $file = $request->file;
            // Lấy tên file
            $file->getClientOriginalName();
            // Lấy đuôi file
            $file->getClientOriginalExtension();
            // Lấy kích thước file
            $file->getSize();
        $path= $file->move('public/uploads',$file->getClientOriginalName());
            $thumbnail ="public/uploads/".$file->getClientOriginalName();
        }
        if(!empty($thumbnail)){
            $updatePro = Product::where('id' ,$id)->update([
                'product_title' => $request->input('name'),
                'product_thumb' => $thumbnail ,
                'code' => $request->input('code'),
                'excerpts' => $request->input('extps'),
                'content' => $request->input('content'),
                'categary_id' => $request->input('cat'),
                'status_id' => $request->input('status'),
                'categary_id' => $request->input('cat'),
                'price'=>$request->input('price'),
                'product_hightlight' => $request->input('fea'),
                'user_id'=>Auth::id(),
            ]);
        }else{
            $updatePro = Product::where('id' ,$id)->update([
                'product_title' => $request->input('name'),
                'product_thumb' =>  $product_id->product_thumb,
                'code' => $request->input('code'),
                'excerpts' => $request->input('extps'),
                'content' => $request->input('content'),
                'categary_id' => $request->input('cat'),
                'status_id' => $request->input('status'),
                'categary_id' => $request->input('cat'),
                'price'=>$request->input('price'),
                'product_hightlight' => $request->input('fea'),
                'user_id'=>Auth::id(),
            ]);

        }
             if($request->hasFile('images')){
                $img = $request->file('images');
                foreach($img as $file){
                    // Lấy tên file
                $file->getClientOriginalName();
                // Lấy đuôi file
                $file->getClientOriginalExtension();
                // Lấy kích thước file
                $file->getSize();
                $path= $file->move('public/uploads',$file->getClientOriginalName());
                $thumbnail_detail ="public/uploads/".$file->getClientOriginalName();
                DetailImage::create([
                    'name_detail'=>$thumbnail_detail,
                    'product_id'=>$id,
                ]);
                }
            }
            return \redirect('admin/product/list')->with('status' ,'Bạn đã cập nhật dữ liệu thành công');
        }
        public function delete($id){
            Product::find($id)->delete();
            return \redirect('admin/product/list')->with('status' ,'Bạn đã sản phẩm thành công');
        }
        public function detail_ajax(Request $request){
            $id = $request->input('id');
            $pro_ajax = Product::find($id);
                    $hight = array();
            if($pro_ajax->product_hightlight == '1'){
                  $hight = [0=>'Có'];
            }else{
                $hight = [0=>'Không'];
            }
            foreach($pro_ajax->color as $value){
                $result[] = $value->name_color;
         } ;
            $list_pro = [];
            $list_pro =[
                'id' => $pro_ajax->id,
                'name'=>$pro_ajax->user->name,
                'title'=>$pro_ajax->product_title,
                'status'=>$pro_ajax->status->name,
                'hightlight'=> $hight[0],
                'color' => implode(',' , $result),
                'price'=>number_format($pro_ajax->price , 0 ,'' , '.')."đ",
                'code'=>$pro_ajax->code,
                'create'=>$pro_ajax->created_at,
                'img'=>url($pro_ajax->product_thumb)
            ];

             echo \json_encode($list_pro);




        }

         #End ADmin
            #Client

            public function listProCate(Request $request , $categary,$id){
                // Xử lý lấy tất cả danh mục điện thoại
               $cate_child= CategaryProduct::find($id)->categaryChild;
               $cate_Parent = CategaryProduct::find($id);
               $id1 = array();
               foreach($cate_child as $value){
                 $id1[]= "$value->id";
               }
               #Xử Lý LỌc sản phẩm nhỏ
               $action = $request->input('select');
               if(!empty($action)){
                   if($action == 1){
                    $list_Pro = Product::whereIn('categary_id' , $id1)->where('product_hightlight' ,1)->where('status_id' ,1)->paginate(12);
                   }
                    if($action == 3){
                        $list_Pro = Product::orderBy('price' ,'desc')->whereIn('categary_id' , $id1)->where('status_id' ,1)->paginate(12);
                    }
                    if($action == 4){
                        $list_Pro = Product::orderBy('price')->whereIn('categary_id' ,$id1)->where('status_id' ,1)->paginate(12);
                    }
               }else{
                $list_Pro = Product::whereIn('categary_id' , $id1)->where('status_id' ,1)->paginate(12);
               }


               $count = $list_Pro->count();
               $categary = CategaryProduct::where('status_id' ,1)->get();
               return \view('client.product.parentPro' , compact('categary' , 'cate_Parent' , 'list_Pro' , 'count' ,'cate_child' , 'id'));
            }

            public function filterAjax(Request $request){
                $id = $request->input('id');
                $cate_Parent = CategaryProduct::find($id);
                $price_filter = $request->input('price_filter');
                $name = $request->input('name');
                $count = array();
                $cate_child= CategaryProduct::find($id)->categaryChild;
                        $idChild = array();
                        foreach($cate_child as $value){
                         $idChild[]= "$value->id";
                        }

                    if(!empty($price_filter) AND !empty($name)){
                    if($name == 'all'){
                        if($price_filter == "< 1000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                                ['price' ,'<' ,'1000000'],
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "1000000 5000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [1000000, 5000000])->where([
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "5000000-10000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [5000000, 10000000])->where([
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "10000000-15000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [10000000, 15000000])->where([
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "> 15000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                                ['price' ,'>' ,'15000000'],
                                ['status_id' ,1]])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                    }elseif($name == $name){
                         if($name == 'all'){
                            $list_filter = Product::whereIn('categary_id' , $id1)->where('status_id' ,1)->paginate(12);
                        }
                        if($price_filter == "< 1000000"){
                            $list_filter = Product::where([
                                ['price' ,'<' ,'1000000'],
                                ['product_title' ,'LIKE' , "%{$name}%"],
                                ['status_id' ,1]
                                ])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                        if($price_filter == "1000000 5000000"){
                            $list_filter = Product::whereBetween('price', [1000000, 5000000])->where([
                                ['product_title' ,'LIKE' , "%{$name}%"],
                                ['status_id' ,1]
                                ])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                        if($price_filter == "5000000-10000000"){
                            $list_filter = Product::whereBetween('price', [5000000, 10000000])->where([
                                ['product_title' ,'LIKE' , "%{$name}%"],
                                ['status_id' ,1]
                                ])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                        if($price_filter == "10000000-15000000"){
                            $list_filter = Product::whereBetween('price', [10000000,15000000])->where([
                                ['product_title' ,'LIKE' , "%{$name}%"],
                                ['status_id' ,1]
                                ])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                        if($price_filter == "> 15000000"){
                            $list_filter = Product::where([
                                ['product_title' ,'LIKE' , "%{$name}%"],
                                ['price' ,'>' ,'15000000'],
                                ['status_id' ,1]
                                ])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                    }
                }elseif
                (!empty($price_filter)){
                    if($price_filter == "< 1000000"){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                            ['price' ,'<' ,'1000000'],
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                         $count= [$count_filter];
                    }
                    if($price_filter == "1000000 5000000"){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [1000000, 5000000])->where([
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                         $count= [$count_filter];
                    }
                    if($price_filter == "5000000-10000000"){
                        $list_filter = Product::whereIn('categary_id' ,$idChild)->whereBetween('price', [5000000, 10000000])->where([
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                         $count= [$count_filter];
                    }
                    if($price_filter == "10000000-15000000"){
                        $list_filter = Product::whereIn('categary_id' ,$idChild)->whereBetween('price', [10000000, 15000000])->where([
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                        $count= [$count_filter];
                    }
                    if($price_filter == "> 15000000"){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                            ['price' ,'>' ,'15000000'],
                            ['status_id' ,1]])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                    }
                }elseif(!empty($name)){
                    if($name == 'all'){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                            ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                    }else{
                        $list_filter = Product::where([
                            ['product_title' ,'LIKE' , "%{$name}%"],
                            ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                    }

                }
              return \view('client.product.filterAjax' , compact('list_filter' ,'count' ,'cate_Parent') );
            }
           public  function fetch_data(Request $request ,$id)
            {
                $cate_Parent = CategaryProduct::find($id);
                $id = $request->input('id');
                $price_filter = $request->input('price_filter');
                $name = $request->input('name');
                $count = array();
                $cate_child= CategaryProduct::find($id)->categaryChild;
                        $idChild = array();
                        foreach($cate_child as $value){
                         $idChild[]= "$value->id";
                        }
                    if(!empty($price_filter) AND !empty($name)){
                    if($name == 'all'){
                        if($price_filter == "< 1000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                                ['price' ,'<' ,'1000000'],
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "1000000 5000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [1000000, 5000000])->where([
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "5000000-10000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [5000000, 10000000])->where([
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "10000000-15000000"){
                            $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [10000000, 15000000])->where([
                                ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                        }
                        if($price_filter == "> 15000000"){
                            $list_filter = Product::whereIn('categary_id' ,$idChild)->where([
                                ['price' ,'>' ,'15000000'],
                                ['status_id' ,1]])->paginate(12);
                                $count_filter= $list_filter->count();
                                $count= [$count_filter];
                        }
                    }elseif($name == $name){
                        if($name == 'all'){
                            $list_filter = Product::whereIn('categary_id' , $id1)->where('status_id' ,1)->paginate(12);
                        }
                    }
                }elseif
                (!empty($price_filter)){
                    if($price_filter == "< 1000000"){
                        $list_filter = Product::whereIn('categary_id' ,$idChild)->where([
                            ['price' ,'<' ,'1000000'],
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                         $count= [$count_filter];
                    }
                    if($price_filter == "1000000 5000000"){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [1000000, 5000000])->where([
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                         $count= [$count_filter];
                    }
                    if($price_filter == "5000000-10000000"){
                        $list_filter = Product::whereIn('categary_id' ,$idChild)->whereBetween('price', [5000000, 10000000])->where([
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                         $count= [$count_filter];
                    }
                    if($price_filter == "10000000-15000000"){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->whereBetween('price', [10000000, 15000000])->where([
                            ['status_id' ,1]
                        ])->paginate(12);
                        $count_filter= $list_filter->count();
                        $count= [$count_filter];
                    }
                    if($price_filter == "> 15000000"){
                        $list_filter = Product::whereIn('categary_id' , $idChild)->where([
                            ['price' ,'>' ,'15000000'],
                            ['status_id' ,1]])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                    }
                }elseif(!empty($name)){
                    if($name == 'all'){
                        $list_filter = Product::whereIn('categary_id' ,$idChild)->where([
                            ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                    }else{
                        $list_filter = Product::where([
                            ['product_title' ,'LIKE' , "%{$name}%"],
                            ['status_id' ,1]
                            ])->paginate(12);
                            $count_filter= $list_filter->count();
                            $count= [$count_filter];
                    }

                }
              return \view('client.product.filterAjax' , compact('list_filter' ,'count' ,'cate_Parent') );
             }

             public function listProChild(Request $request , $categary,$idCate,$categarychild,$id){
                 $select = $request->input('select');
                if(!empty($select)){
                    if($select == 1){
                        $listProChild= Product::where([
                            ['categary_id' , $id],
                            ['status_id' , 1],
                            ['product_hightlight' , 1]
                            ])->paginate(12);
                            $count = $listProChild->count();
                    }
                    if($select == 3){
                        $listProChild= Product::orderBy('price','desc')->where([
                            ['categary_id' , $id],
                            ['status_id' , 1],
                            ])->paginate(12);
                            $count = $listProChild->count();
                    }
                    if($select == 4){
                        $listProChild= Product::orderBy('price')->where([
                            ['categary_id' , $id],
                            ['status_id' , 1],
                            ])->paginate(12);
                            $count = $listProChild->count();
                    }
                }else{
                    $listProChild= Product::where([
                        ['categary_id' , $id],
                        ['status_id' , 1]
                        ])->paginate(12);
                      $count= $listProChild->count();
                }
                 $CategaryChild = CategaryProduct::where([
                     ['id' , $id],
                     ['status_id' , 1]
                     ])->first();
                $CategaryParent = CategaryProduct::where([
                    ['id' , $idCate],
                    ['status_id' , 1]
                    ])->first();
                $categary = CategaryProduct::where('status_id' ,1)->get();
                    return \view('client.product.ChildPro' , compact('listProChild' , 'CategaryParent' , 'CategaryChild' ,'categary' ,'id' ,'count' ));
             }

             public function firtChildAjax(Request $request){
                    $id = $request->input('id');
                    $idParent = $request->input('idParent') ;
                    $categaryChild =  $CategaryParent = CategaryProduct::where([
                        ['id' , $id],
                        ['status_id' , 1]
                        ])->first();
                    $price_filter = $request->input('price_filter');
                    if(!empty($price_filter)){
                        if($price_filter == "< 1000000"){
                            $listPro_id= Product::where([
                                ['categary_id' , $id],
                                ['status_id' ,1],
                                ['price' ,'<' , '1000000'],
                            ])->paginate(12);
                            $count = $listPro_id->count();
                        }
                        if($price_filter == "1000000 5000000"){
                            $listPro_id = Product::whereBetween('price', [1000000, 5000000])->where([
                              ['categary_id' , $id],
                              ['status_id' , 1],
                            ])->paginate(12);
                            $count = $listPro_id->count();
                          }
                          if($price_filter == "5000000-10000000"){
                            $listPro_id = Product::whereBetween('price', [5000000, 10000000])->where([
                              ['categary_id' , $id],
                              ['status_id' , 1],
                            ])->paginate(12);
                            $count = $listPro_id->count();
                          }
                          if($price_filter == "5000000-10000000"){
                            $listPro_id = Product::whereBetween('price', [5000000, 10000000])->where([
                              ['categary_id' , $id],
                              ['status_id' , 1],
                            ])->paginate(12);
                            $count = $listPro_id->count();
                          }
                          if($price_filter == "10000000-15000000"){
                            $listPro_id = Product::whereBetween('price', [10000000, 15000000])->where([
                              ['categary_id' , $id],
                              ['status_id' , 1],
                            ])->paginate(12);
                            $count = $listPro_id->count();
                          }
                          if($price_filter == "> 15000000"){
                            $listPro_id= Product::where([
                                ['categary_id' , $id],
                                ['status_id' ,1],
                                ['price' ,'>' , '15000000'],
                            ])->paginate(12);
                            $count = $listPro_id->count();
                          }
                    }
                    $CategaryParent = CategaryProduct::where([
                        ['id' ,  $idParent],
                        ['status_id' , 1]
                        ])->first();
                    return \view('client.product.filterAjaxChild' , compact('listPro_id' ,'categaryChild' , 'count' ,'CategaryParent'));
            }

            public function fetch_data1(Request $request){
                $id = $request->input('id');
                $idParent = $request->input('idParent') ;
                $categaryChild =  $CategaryParent = CategaryProduct::where([
                    ['id' , $id],
                    ['status_id' , 1]
                    ])->first();
                $price_filter = $request->input('price_filter');
                if(!empty($price_filter)){
                    if($price_filter == "< 1000000"){
                        $listPro_id= Product::where([
                            ['categary_id' , $id],
                            ['status_id' ,1],
                            ['price' ,'<' , '1000000'],
                        ])->paginate(12);
                        $count = $listPro_id->count();
                    }
                    if($price_filter == "1000000 5000000"){
                        $listPro_id = Product::whereBetween('price', [1000000, 5000000])->where([
                          ['categary_id' , $id],
                          ['status_id' , 1],
                        ])->paginate(12);
                        $count = $listPro_id->count();
                      }
                      if($price_filter == "5000000-10000000"){
                        $listPro_id = Product::whereBetween('price', [5000000, 10000000])->where([
                          ['categary_id' , $id],
                          ['status_id' , 1],
                        ])->paginate(12);
                        $count = $listPro_id->count();
                      }
                      if($price_filter == "5000000-10000000"){
                        $listPro_id = Product::whereBetween('price', [5000000, 10000000])->where([
                          ['categary_id' , $id],
                          ['status_id' , 1],
                        ])->paginate(12);
                        $count = $listPro_id->count();
                      }
                      if($price_filter == "10000000-15000000"){
                        $listPro_id = Product::whereBetween('price', [10000000, 15000000])->where([
                          ['categary_id' , $id],
                          ['status_id' , 1],
                        ])->paginate(12);
                        $count = $listPro_id->count();
                      }
                      if($price_filter == "> 15000000"){
                        $listPro_id= Product::where([
                            ['categary_id' , $id],
                            ['status_id' ,1],
                            ['price' ,'>' , '15000000'],
                        ])->paginate(12);
                        $count = $listPro_id->count();
                      }
                }
                $CategaryParent = CategaryProduct::where([
                    ['id' ,  $idParent],
                    ['status_id' , 1]
                    ])->first();
                return \view('client.product.filterAjaxChild' , compact('listPro_id' ,'categaryChild' , 'count' ,'CategaryParent'));
            }

            public function detailProduct(Request $request , $categary,$idCate,$categarychild,$idPro){
                $categary = CategaryProduct::where('status_id' ,1)->get();
                $color_detail = Product::find($idPro)->color;
                $product_by_id = Product::find($idPro);
                $cate_Parent = CategaryProduct::find($idCate);
                $cate_Child =CategaryProduct::find($categarychild);
                $img_detail = Product::find($idPro)->detailImg;
                $Product_same_item = Product::where([
                    ['status_id' ,1],
                    ['categary_id' ,$categarychild]
                ])->get();
                return \view('client.product.detailProduct' , compact('categary' , 'color_detail' ,'product_by_id' ,'cate_Parent' ,'cate_Child' ,'img_detail' ,'Product_same_item'));
            }

}
