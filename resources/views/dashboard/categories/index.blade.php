@extends("dashboard.layout")
@section("content")



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                لیست دسته بندی ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">لیست دسته بندی ها</li>
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
                            <th>عنوان</th>
                            <th>دسته بندی مادر</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>


                            @foreach($categories as $category)

                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->parent ? $category->parent->title : "-"}}</td>
                                    <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($category->created_at))}}</td>
                                    <td>{{$category->updated_at ? \Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($category->updated_at)) : "-"}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("categories.edit",$category->id)}}">
                                            ویرایش
                                        </a>

                                        <form method="POST" action="{{route("categories.destroy",$category->id)}}">
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
