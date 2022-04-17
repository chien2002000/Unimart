<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status_page;
use App\Page;
use App\CategaryProduct;
use App\Product;
use Illuminate\Support\Facades\Auth;
class PagesController extends Controller

{
    public function __construct(){
        $this->middleware(function($request , $next){
             session(['Model_active' =>'pages']);
            return $next($request);
        });
}

        public function add(){
                $status= Status_page::all();
                return \view('admin.pages.add' , compact('status'));
        }

        public function store(Request $request){
                $request->validate([
                    'name' =>'required',
                    'slug' =>'required',
                    'status' =>'required',
                    'content'=>'required'
                ],
                [
                    'required' =>'Trường :attribute không được để trống',
                ],
                [
                    'name' =>'Tiêu đề trang',
                    'status' =>'Trạng thái',
                    'content' => 'Nội dung '
                ]
            );
                Page::create([
                    'page_title' => $request->input('name'),
                    'slug' => $request->input('slug'),
                    'status_id' => $request->input('status'),
                    'content' =>$request->input('content'),
                    'user_id' =>Auth::id()
                ]);
                return \redirect('admin/page/list')->with('status' ,'Bạn đã thêm trang thành công');
        }

        public function list(Request $request){
                $status = $request->input('status');
                if($status){
                    if($status =='active'){
                        $list_page = Page::where('status_id' , 1)->paginate(10);
                    }
                    if($status == 'trard'){
                        $list_page = Page::where('status_id' , 2)->paginate(10);
                    }
                    if($status =='delete'){
                        $list_page =  Page::onlyTrashed()->paginate(10);
                    }
                }else{
                    $keyword = "";
                    if($request->input('keyword')){
                        $keyword = $request->input('keyword');
                    }
                    $list_page =Page::where('page_title' , "LIKE" ,"%{$keyword}%")->paginate(10);
                }
            $active_count = Page::where('status_id' , 1)->count();
            $trard_count =Page::where('status_id' , 2)->count();
            $delete_count =  Page::onlyTrashed()->count();
            $count = [$active_count , $trard_count , $delete_count];
            return \view('admin.pages.list' ,compact('list_page' , 'count'));
        }
    public function action(Request $request){
        $check_list = $request->input('list');
            $request->validate([
                    'select' =>'required',
                    'list'=>'required',
            ],
            [
                'required' =>'Trường :attribute không được để trống',
            ],
            [
                'select' =>'Trạng thái',
                'list' =>'checklist',
            ]
        );
            if($check_list){
                $select = $request->input('select');
                if($select == 1){
                    Page::whereIn('id' , $check_list)->update([
                        'status_id' =>$select,
                    ]);
                    return \redirect('admin/page/list')->with('status','Bạn đã chọn chế độ công khai thành công ');
                }
                if($select == 2){
                    Page::whereIn('id' , $check_list)->update([
                        'status_id' =>$select,
                    ]);
                    return \redirect('admin/page/list')->with('status','Bạn đã chọn chế độ chờ duyệt thành công ');
                }
                if($select == 'store'){
                    Page::withTrashed()
                    ->whereIn('id' , $check_list)
                    ->restore();
                    return \redirect('admin/page/list')->with('status','Bạn đã khôi phục thành công ');
                }
                if($select == 'delete'){
                    Page::whereIn('id' , $check_list)->delete();
                    return \redirect('admin/page/list')->with('status','Bạn đã   xoá tạm thời thành công');
                }
                if($select == 'delete_all'){
                    Page::withTrashed()->whereIn('id' , $check_list)->forceDelete();
                    return \redirect('admin/page/list')->with('status','Bạn đã  xoá vĩnh viễn thành công');
                }
            }
    }
        public function detail($id){
            $data = [];
                $page_detail = Page::find($id);
                $data=[
                     'user' => $page_detail->user->name,
                     'title'=>$page_detail->page_title,
                     'slug'=>$page_detail->slug,
                     'status'=>$page_detail->status->name,
                     'create'=>$page_detail->updated_at,
                     'id'=>$page_detail->id
                ];
                echo  json_encode($data);
        }
            public function edit($id){
                $status= Status_page::all();
                $page_id = Page::find($id);
                    return \view('admin.pages.edit' , compact('status' , 'page_id'));
            }

            public function update(Request $request , $id){
                    $request->validate([
                        'name'=>'required',
                        'slug'=>'required',
                        'status' =>'required',
                        'content'=>'required'
                    ],
                    [
                        'required' =>'Trường :attribute không được để trống',
                    ],
                    [
                        'name' =>'Tiêu đề trang',
                        'status' =>'Trạng thái',
                        'content' =>'nội dung'
                    ]
                );
                Page::where('id' , $id)->update([
                    'page_title' => $request->input('name'),
                    'slug' => $request->input('slug'),
                    'user_id'=>Auth::id(),
                    'status_id' => $request->input('status'),
                    'content' => $request->input('content'),

                ]);
                return \redirect('admin/page/list')->with('status','Bạn sửa Trang thành công');
            }


            public function delete($id){
                    Page::where('id' , $id)->delete();
                    return \redirect('admin/page/list')->with('status','Bạn xoá thành công ');
            }

//  END ADMIN PAGES
        #Client
    //

        public function introduce($id){
            $categary = CategaryProduct::where('status_id' ,1)->get();
            $page_by_id = Page::where([
                ['status_id' , 1],
                ['id' , $id]
                ])->first();
            $Pro_hightlight = Product::where([
                ['product_hightlight' ,1],
                ['status_id' , 1]
            ])->get();
            return \view('client.pages.introduce'  ,compact('categary' , 'Pro_hightlight' , 'page_by_id'));
        }
}
