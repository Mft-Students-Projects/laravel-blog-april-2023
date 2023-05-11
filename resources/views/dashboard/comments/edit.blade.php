@extends("dashboard.layout")
@section("content")



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           ویرایش دسته بندی
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li class="active">ویرایش دسته بندی </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ویرایش دسته بندی </h3>
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

                <form role="form" action="{{route("categories.update",$category->id)}}" method="POST">

                    @csrf
                    @method("PUT")

                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input value="{{$category->title}}" name="title" type="text" class="form-control" id="title" placeholder="عنوان">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">دسته بندی مادر</label>

                                <select name="parent_id" class="form-control" id="parent_id">
                                    <option value="">بدون دسته بندی مادر</option>
                                    @foreach($root_categories as $root_cat)
                                        <option  {{ $root_cat->id == $category->parent_id ? "selected" : ""}} value="{{$root_cat->id}}">{{$root_cat->title}}</option>
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
