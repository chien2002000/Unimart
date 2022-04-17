<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\CategaryPost;
use App\Status_page;
use App\Post;
use App\CategaryProduct;
use App\Page;
use App\Product;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware(function($request , $next){
             session(['Model_active' =>'post']);
            return $next($request);
        });
}
       public function listCat(){
            $cat_post1 = CategaryPost::all();
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
          $result =  data_tree($cat_post1  , 0);
            $status = Status_page::all();
            return \view('admin.posts.addCat' , compact(  'status' ,'result' ));
        }
        public function addCat(Request $request){
            $request->validate([
                'name'=>'required',
                'slug' =>'required',
                'cat' =>'required',
                'status' =>'required'
            ],
            [
                'required'=> ' :attribute không được để trống'
            ],
            [
                'name' =>'Tên danh mục',
                'cat' =>'Danh mục cha',
                'status' =>'Trạng thái'
            ]
        );
          CategaryPost::create([
            'name'=> $request->input('name'),
            'slug'=>$request->input('slug'),
            'parent_id'=>$request->input('cat'),
            'status_id' =>$request->input('status'),
            'user_id' => Auth::id(),
        ]);
        return \redirect('admin/post/cat/list')->with('status' ,'Bạn đã thêm trang thành công');
        }

        public function editCat($id){
            $cat_post_1 = CategaryPost::find($id);
            $cat_post = CategaryPost::where('parent_id' , 0)->get();
            $status = Status_page::all();
            return \view('admin.posts.editCat' ,compact('cat_post' , 'status' , 'cat_post_1'));
        }

        public function updateCat(Request $request ,$id){
            $cat_post_1 = CategaryPost::find($id);
            if($cat_post_1->parent_id != 0){
                $request->validate([
                    'name'=>'required',
                    'slug' =>'required',
                    'status' =>'required'
                ],
                [
                    'required'=> ' :attribute không được để trống'
                ],
                [
                    'name' =>'Tên danh mục',
                    'cat' =>'Danh mục cha',
                    'status' =>'Trạng thái'
                ],

            );
                    CategaryPost::where('id' , $id)->update([
                        'name' => $request->input('name'),
                        'slug' => $request->input('slug'),
                        'status_id' =>$request->input('status'),
                    ]);
            }else{
                $request->validate([
                    'name'=>'required',
                    'slug' =>'required',
                    'status' =>'required'
                ],
                [
                    'required'=> ' :attribute không được để trống'
                ],
                [
                    'name' =>'Tên danh mục',
                    'cat' =>'Danh mục cha',
                    'status' =>'Trạng thái'
                ]
            );
            CategaryPost::where('id' , $id)->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'status_id' =>$request->input('status'),
            ]);
            }
            return \redirect('admin/post/cat/list')->with('status' ,'Bạn sửa thành công');
        }
    //

    public function deleteCat($id){
        CategaryPost::where('id' , $id)->delete();
        return \redirect('admin/post/cat/list')->with('status' ,'Bạn đã xoá danh mục thành công');
    }

    public function add(){
        $cat_post1 = CategaryPost::all();
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
            $cat_post =  CategaryPost::where('parent_id' , 0)->get();
            $result =  data_tree($cat_post1  , 0);
            $status = Status_page::all();
            return \view('admin.posts.add' , compact('result' , 'status'));
    }

        public function store(Request $request){
            $request->validate([
                'name'=>'required',
                'cat'=>'required',
                'extep' =>'required',
                'content' =>'required',
                'status' =>'required',
                'file' =>'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' =>'Tiêu đề',
                'cat' =>'Danh mục',
                'extep' =>'Mô tả ngắn',
                'content' =>'Nội dung',
                'status' =>'Trạng thái',
                'file' =>'Hình ảnh',
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
        Post::create([
            'post_title' => $request->input('name'),
            'categary_id' =>$request->input('cat'),
            'thumbnail'=>$thumbnail,
            'content' =>$request->input('content'),
            'excerpts'=>$request->input('extep'),
            'user_id'=>Auth::id(),
            'status_id'=>$request->input('status'),
        ]);
        return \redirect('admin/post/list')->with('status' ,'Bạn đã thêm bài viết mới thành công');
    }

    public function list(Request $request){
        $stc = $request->input('status');
        echo $request->input('data-id');
        $list = array();
            if($stc){
                if($stc == 'public'){
                    $list_post =Post::where('status_id' , 1)->paginate(10);
                    $list=[1=>'Chờ duyệt' ,3=> 'Xoá tạm thời'];
                }
                if($stc =='pending'){

                    $list_post =Post::where('status_id' , 2)->paginate(10);
                    $list=[0=>'Công khai' ,3=> 'Xoá tạm thời'];
                }
                if($stc == 'delete'){

                    $list_post=Post::onlyTrashed()->paginate(10);
                    $list=[4=>'Khôi phục' , 5=>'Xoá vĩnh viên'];
                }
            }else{
                $list=[0=>'Công khai',1=>'Chờ duyệt' ,3=> 'Xoá tạm thời'];
                $seach = "";
                if($request->input('search')){
                    $seach =$request->input('search');
                }
                $list_post = Post::where('post_title' , 'LIKE' ,"%{$seach}%")->paginate(10);
            }
            $count_public =Post::where('status_id' , 1)->count();
            $count_delete =Post::onlyTrashed()->count();
            $count_pending =Post::where('status_id' , 2)->count();
            $count= [$count_public, $count_pending , $count_delete];

        return \view('admin.posts.list' , compact('list_post' ,'list' , 'count'));
    }

    public function action(Request $request){
          $listCheck= $request->input('listCheck');
            $request->validate([
                'action'=>'required',
                'listCheck'=>'required',
            ],
            [
                'required' =>':attribute Không được để trống'
            ],
            [
                'action'=>'Trạng thái'
            ]
        );
           if($listCheck){
                $action = $request->input('action');
                if($action == 0){
                    Post::whereIn('id' , $listCheck)->update([
                        'status_id' => 1,
                    ]);
                    return \redirect('admin/post/list')->with('status' ,'Bạn đã thanh đổi thành công khai thành công');
                }
                if($action == 1){
                    Post::whereIn('id' , $listCheck)->update([
                        'status_id' => 2,
                    ]);
                    return \redirect('admin/post/list')->with('status' ,'Bạn đã thanh đổi thành chờ duyệt  thành công');
                }
                if($action == 3){
                    Post::whereIn('id' , $listCheck)->delete();
                    return \redirect('admin/post/list')->with('status' ,'Bạn đã xoá tạm thời thành công');
                }
                if($action == 4){
                    Post::withTrashed()->whereIn('id' , $listCheck)->restore();
                    return \redirect('admin/post/list')->with('status' ,'Bạn đã khôi phục thành thành công');
                }
                if($action == 5){
                    Post::withTrashed()->whereIn('id' , $listCheck)->forceDelete();
                    return \redirect('admin/post/list')->with('status' ,'Bạn đã xoá vĩnh viễn thành thành công');
                }
           }
    }

        public function detail($id){
                $data = array();
            $detail_post = Post::find($id);
                $data =[
                    'id' => $detail_post->id,
                    'title'=>$detail_post->post_title,
                    'user' =>$detail_post->user->name,
                    'categary'=>$detail_post->categary->name,
                    'status'=>$detail_post->status->name,
                    'create'=>$detail_post->created_at,
                    'img'=>url($detail_post->thumbnail)
                ];
                echo \json_encode($data);
        }

    public function edit($id){
        $cat_post1 = CategaryPost::all();
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
            $result =  data_tree($cat_post1  , 0);
            $status = Status_page::all();
            $post_id = Post::find($id);
            return \view('admin.posts.edit' , compact('result' , 'status' , 'post_id'));
    }

    public function update( Request $request, $id){
        $post_id = Post::find($id);
        $request->validate([
            'name'=>'required',
            'cat'=>'required',
            'extep' =>'required',
            'content' =>'required',
            'status' =>'required',
        ],
        [
            'required' => ':attribute không được để trống',
        ],
        [
            'name' =>'Tiêu đề',
            'cat' =>'Danh mục',
            'extep' =>'Mô tả ngắn',
            'content' =>'Nội dung',
            'status' =>'Trạng thái',
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
        Post::where('id' , $id)->update([
            'post_title' => $request->input('name'),
            'categary_id' =>$request->input('cat'),
            'thumbnail'=>$thumbnail,
            'content' =>$request->input('content'),
            'excerpts'=>$request->input('extep'),
            'user_id'=>Auth::id(),
            'status_id'=>$request->input('status'),
        ]);
    }else{
        Post::where('id' , $id)->update([
            'post_title' => $request->input('name'),
            'categary_id' =>$request->input('cat'),
            'thumbnail'=>$post_id->thumbnail,
            'content' =>$request->input('content'),
            'excerpts'=>$request->input('extep'),
            'user_id'=>Auth::id(),
            'status_id'=>$request->input('status'),
        ]);
    }
    return \redirect('admin/post/list')->with('status' ,'Bạn đã sửa viết mới thành công');
    }
    public function delete($id){
        Post::where('id' , $id)->delete();
        return \redirect('admin/post/list')->with('status' ,'Bạn đã xoá thành công');
    }


    #END ADMIN POST

    public function listPost(){
        $categary = CategaryProduct::where('status_id' ,1)->get();
        $pagePro = Page::OrderBy('id' , 'desc')->where('status_id' ,1)->get();
        $Pro_hightlight = Product::where([
            ['product_hightlight' ,1],
            ['status_id' , 1]
        ])->get();
        $post_list = Post::where('status_id' , 1)->paginate(8);
        return \view('client.pages.listPage' , compact('pagePro' , 'categary' , 'Pro_hightlight' ,'post_list'));
    }
    public function detailPost($id){
        $pagePro = Page::OrderBy('id' , 'desc')->where('status_id' ,1)->get();
        $Pro_hightlight = Product::where([
            ['product_hightlight' ,1],
            ['status_id' , 1]
        ])->get();
        $post_list = Post::find($id);
        return view('client.pages.detail' , compact('pagePro' , 'Pro_hightlight' , 'post_list'));
    }
}
