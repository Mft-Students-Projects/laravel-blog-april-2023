@extends("dashboard.layout")
@section("content")



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           افزودن خبر جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li class="active">افزودن خبر جدید</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ساخت خبر جدید</h3>
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

                <form enctype="multipart/form-data" role="form" action="{{route("news.store")}}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input value="{{old("title")}}" name="title" type="text" class="form-control" id="title" placeholder="عنوان">
                        </div>

                        <div class="form-group">
                            <label for="en_title">عنوان انگلیسی</label>
                            <input value="{{old("en_title")}}" name="en_title" type="text" class="form-control" id="en_title" placeholder="عنوان انگلیسی">
                        </div>

                        <div class="form-group">
                            <label for="description">توضیحات کوتاه</label>
                            <input value="{{old("description")}}" name="description" type="text" class="form-control" id="description" placeholder="توضیجات کوتاه">
                        </div>

                        <div class="form-group">
                            <label for="image">تصویر</label>
                            <input name="image" type="file" class="form-control" id="title" placeholder="تصویر">
                        </div>

                        <div class="form-group">
                            <label for="long_description">توضیحات کامل</label>
                            <textarea height="500px" name="long_description" type="text" class="form-control" id="long_description" placeholder="توضیحات کامل">
                                {{old("long_description")}}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="category_id">دسته بندی خبر</label>

                                <select name="category_id" class="form-control" id="category_id">

                                    @foreach($categories as $category)
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
