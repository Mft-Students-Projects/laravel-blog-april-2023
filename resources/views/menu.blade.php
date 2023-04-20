<ul>
    @foreach($menu_categories as $category)

        <li class="dropdown">
            <a href="index.html">
                {{$category->title}}
            </a>
            @if($category->children->count() > 0)

                @include("menu",["menu_categories"=>$category->children])

            @endif
        </li>

    @endforeach
</ul>
