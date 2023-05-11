@extends("dashboard.layout")
@section("content")


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                لیست دیدگاه ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">لیست دیدگاه ها</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">

{{--                    @php--}}
{{--                        $is_confirmed = request()->get("is_confirmed");--}}
{{--                        dd((int)$is_confirmed);--}}
{{--                    @endphp--}}

                    <ul class="nav nav-pills">
                        <li @if(!request()->has("is_confirmed") || request()->get("is_confirmed") !== "1") class="active" @endif><a href="{{route("comments.index")}}">تایید نشده</a></li>
                        <li @if(request()->has("is_confirmed") && request()->get("is_confirmed") === "1") class="active" @endif><a href="{{route("comments.index")}}?is_confirmed=1">تایید شده</a></li>
                    </ul>

                    @if(session()->has("success"))
                        <div class="alert alert-success">
                            {{session()->get("success")}}
                        </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام</th>
                            <th>متن</th>
                            <th>خبر مرتبط</th>
                            <th>پاسخ ها</th>
                            <th>تایید</th>
                            <th>ساخت</th>
                            <th>ویرایش</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>


                            @foreach($comments as $item)

                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->content}}</td>
                                    <td>
                                        <a target="_blank" href="{{route("client.news",$item->news->id)}}">
                                            {{$item->news->title}}
                                        </a>
                                    </td>
                                    <td>

                                        <a href="{{route("comments.replies",$item->id)}}" class="btn btn-primary">پاسخ ها</a>

                                    </td>
                                    <td>

                                        @if($item->confirmed == 1)

                                            <a onclick="return confirm('از رد دیدگاه {{$item->name}} در خبر {{$item->news->title}} مطمین هستید ؟ ')" href="{{route("comments.confirm",$item->id)}}?rejected=1" class="btn btn-danger">رد</a>

                                        @else

                                            <a onclick="return confirm('از تایید دیدگاه {{$item->name}} در خبر {{$item->news->title}} مطمین هستید ؟ ')" href="{{route("comments.confirm",$item->id)}}" class="btn btn-success">تایید</a>

                                        @endif

                                    </td>
                                    <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($item->created_at))}}</td>
                                    <td>{{$item->updated_at ? \Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($item->updated_at)) : "-"}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("comments.edit",$item->id)}}">
                                            ویرایش
                                        </a>

                                        <form method="POST" action="{{route("comments.destroy",$item->id)}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button onclick="return confirm('از حذف دیدگاه {{$item->name}} در خبر {{$item->news->title}} مطمین هستید ؟ عملیات حذف غیرقابل بازگشت است')" class="btn btn-danger">حذف</button>
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
