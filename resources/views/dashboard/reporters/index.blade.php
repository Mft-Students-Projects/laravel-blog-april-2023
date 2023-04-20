@extends("dashboard.layout")
@section("content")



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                لیست خبرنگار ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">لیست خبرنگار ها</li>
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
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>ساخت</th>
                            <th>ویرایش</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>


                            @foreach($reporters as $reporter)

                                <tr>
                                    <td>{{$reporter->id}}</td>
                                    <td>{{$reporter->name}} {{$reporter->last_name}}</td>
                                    <td>{{$reporter->email}}</td>
                                    <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($reporter->created_at))}}</td>
                                    <td>{{$reporter->updated_at ? \Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($reporter->updated_at)) : "-"}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("reporters.edit",$reporter->id)}}">
                                            ویرایش
                                        </a>

                                        <form method="POST" action="{{route("reporters.destroy",$reporter->id)}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button onclick="return confirm('are you sure ?')" class="btn btn-danger">حذف</button>
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
