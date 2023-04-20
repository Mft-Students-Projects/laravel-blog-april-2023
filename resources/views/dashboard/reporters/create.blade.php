@extends("dashboard.layout")
@section("content")



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           افزودن خبرنگار جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li class="active">افزودن خبرنگار جدید</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ساخت خبرنگار جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if($errors->any())

                    @foreach($errors->all() as $error)

                        <div class="alert alert-danger">
                            {{$error}}
                        </div>

                    @endforeach

                @endif

                <form role="form" action="{{route("reporters.store")}}" method="POST">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label for="first_name">نام</label>
                            <input value="{{old("name")}}" name="name" type="text" class="form-control" id="first_name" placeholder="عنوان">
                        </div>

                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input value="{{old("last_name")}}" name="last_name" type="text" class="form-control" id="last_name" placeholder="عنوان">
                        </div>

                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input value="{{old("email")}}" name="email" type="text" class="form-control" id="email" placeholder="عنوان">
                        </div>

                        <div class="form-group">
                            <label for="password">رمز عبور</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="عنوان">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->


@endsection
