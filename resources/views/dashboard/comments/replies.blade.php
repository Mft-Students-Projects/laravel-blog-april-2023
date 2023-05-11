@extends("dashboard.layout")
@section("content")


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            دیدگاه شماره {{$comment->id}} کاربر {{$comment->name}}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content" style="min-height: auto">

        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

                @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{session()->get("success")}}
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>نام</th>
                        <th>متن</th>
                        <th>خبر</th>
                        <th>تایید</th>
                        <th>ساخت</th>
                        <th>ویرایش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>

                    <tbody>




                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->content}}</td>
                            <td>
                                <a target="_blank" href="{{route("client.news",$comment->news->id)}}">
                                    {{$comment->news->title}}
                                </a>
                            </td>
                            <td>

                                @if($comment->confirmed == 1)

                                    <a onclick="return confirm('از رد دیدگاه {{$comment->name}} در خبر {{$comment->news->title}} مطمین هستید ؟ ')" href="{{route("comments.confirm",$comment->id)}}?rejected=1" class="btn btn-danger">رد</a>

                                @else

                                    <a onclick="return confirm('از تایید دیدگاه {{$comment->name}} در خبر {{$comment->news->title}} مطمین هستید ؟ ')" href="{{route("comments.confirm",$comment->id)}}" class="btn btn-success">تایید</a>

                                @endif

                            </td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($comment->created_at))}}</td>
                            <td>{{$comment->updated_at ? \Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($comment->updated_at)) : "-"}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route("comments.edit",$comment->id)}}">
                                    ویرایش
                                </a>

                                <form method="POST" action="{{route("comments.destroy",$comment->id)}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button onclick="return confirm('از حذف دیدگاه {{$comment->name}} در خبر {{$comment->news->title}} مطمین هستید ؟ عملیات حذف غیرقابل بازگشت است')" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>


                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            لیست پاسخ ها
        </h4>
    </section>

    <!-- Main content -->
    <section class="content" style="min-height: auto">

        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>نام</th>
                        <th>متن</th>
                        <th>تایید</th>
                        <th>ساخت</th>
                        <th>ویرایش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>

                    <tbody>


                    @foreach($replies as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->content}}</td>
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
