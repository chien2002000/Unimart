@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách Quyền thành viên</h5>
            <div class="form-search form-inline">
            </div>
        </div>
        <div class="card-body">


            <table class="table table-striped table-checkall">
                <thead>
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Tên quyền</th>
                        <th scope="col">Chức năng</th>

                    </tr>
                </thead>
                <tbody>
                        @php
                            $t=0;
                        @endphp
                        @foreach($list_role as $value)
                          @php
                                 $t++;
                         @endphp
                    <tr>

                        <td scope="row">{{$t}}</td>

                        <td><p>{{$value->name}}</p></td>
                        <td>{{$value->name_role}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
            </nav>
        </div>
    </div>
</div>
@endsection
