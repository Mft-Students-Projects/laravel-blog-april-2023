@extends("dashboard.layout")
@section("content")



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           افزودن دسته بندی جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li class="active">افزودن دسته بندی جدید</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ساخت دسته بندی جدید</h3>
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

                <form role="form" action="{{route("categories.store")}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="عنوان">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">دسته بندی مادر</label>

                                <select name="parent_id" class="form-control" id="parent_id">
                                    <option value="">بدون دسته بندی مادر</option>
                                    @foreach($root_categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>

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
