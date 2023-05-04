@extends('layout')

@section("content")

    <!-- ======= Business Category Section ======= -->


        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>{{$category->title}}</h2>
                    <div><a href="category.html" class="more">See All Business</a></div>
                </div>

                <div class="row">
                    <div class="col-md-12 order-md-2">


                        <div class="row">
                            @foreach($category->news as $news)

                                <div class="col-lg-4">
                                    <div class="post-entry-1 border-bottom">
                                        <a href="{{route("client.news",$news->id)}}"><img src="/media/{{$news->image}}" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">{{$category->title}}</span> <span class="mx-1">&bullet;</span> <span>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($news->created_at))}}</span></div>
                                        <h2 class="mb-2"><a href="{{route("client.news",$news->id)}}">{{$news->title}}</a></h2>
                                        <span class="author mb-3 d-block">Jenny Wilson</span>
                                        <p class="mb-4 d-block">{{$news->description}}</p>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Business Category Section -->


@endsection
