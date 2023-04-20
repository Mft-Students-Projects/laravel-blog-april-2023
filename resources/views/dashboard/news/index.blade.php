@extends("dashboard.layout")
@section("content")



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                لیست خبر ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">لیست خبر ها</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">جدول داده مثال ۲</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    @if(session()->has("success"))
                        <div class="alert alert-success">
                            {{session()->get("success")}}
{{--                            @php--}}
{{--                                session()->remove("success")--}}
{{--                            @endphp--}}
                        </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>


                            @foreach($news as $item)

                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        @if($item->image)
                                            <img height="50" src="/media/{{$item->image}}" alt="{{$item->title}}" title="{{$item->title}}">
                                        @endif
                                    </td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->parent ? $item->parent->title : "-"}}</td>
                                    <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($item->created_at))}}</td>
                                    <td>{{$item->updated_at ? \Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($item->updated_at)) : "-"}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("news.edit",$item->id)}}">
                                            ویرایش
                                        </a>

                                        <form method="POST" action="{{route("news.destroy",$item->id)}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->


@endsection
