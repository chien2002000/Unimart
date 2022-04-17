
                    @foreach ($thumb_detail as $item)
                    {{-- <input type="file" id="files" class="hidden"/> --}}

                    <img width="150px" src="{{url($item->name_detail)}}" alt="">
                    <a href="" data-id="{{$item->id}}" id="delete_edit" class="delete">Xoá</a>
                    @endforeach
