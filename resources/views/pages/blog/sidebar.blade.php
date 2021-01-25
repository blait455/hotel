<aside id="secondary" class="widget-area col-sm-12 col-md-3 sticky-sidebar">
    <div class="wd wd-search">
        <form role="search" method="get" action="#">
            <input type="search" placeholder="Search …" value="" name="s">
            <button type="submit"><i class="ion ion-ios-search"></i></button>
        </form>
    </div>
    <div class="wd wd-categories">
        <h3 class="wd-title">Categories</h3>
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{ route('blog.categories',$category->slug) }}">{{ $category->name }} ({{ $category->posts_count }})</a></li>
            @endforeach
        </ul>
    </div>
    <div class="wd wd-image-box">
        <div class="image-box">
            <img src="{{ asset('frontend/images/gallery/masonry-5.jpg') }}" alt="">
        </div>
    </div>
    <div class="wd wd-categories">
        <h3 class="wd-title">Tags</h3>
        <ul>
            @foreach ($tags as $tag)
                <li><a href="{{ route('blog.tags',$tag->slug) }}">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="wd wd-recent-post clearfix">
        <h3 class="wd-title">Popular Posts</h3>
        @foreach ($popularposts as $post)
            <div class="post clearfix">
                <div class="post-content">
                    <h4 class="post-title"><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a></h4>
                    <span class="post-meta">{{$post->created_at->diffForHumans()}}</span><hr>
                </div>
            </div>
        @endforeach
    </div>

</aside>





{{-- <div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Popular Posts</h3>
        <ul class="collection">
            @foreach($popularposts as $post)
                <li class="collection-item">
                    <a href="{{ route('blog.show',$post->slug) }}" class="indigo-text text-darken-4">
                        <span class="truncate tooltipped" data-position="bottom" data-tooltip="{{ $post->title }}">{{ $post->title }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Categories</h3>
        <ul>
            @foreach($categories as $category)
                <li class="category-bg-image" style="background-image:url({{Storage::url('category/slider/'.$category->image)}});">

                    <a href="{{ route('blog.categories',$category->slug) }}">

                        <span class="left">{{ $category->name }}</span>

                        <span class="right">{{ $category->posts_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Archives</h3>
        <ul class="collection">
            @foreach($archives as $stats)
                <li class="collection-item">

                    <a href="/blog/?month={{ $stats['month'] }}&year={{ $stats['year'] }}" class="indigo-text text-darken-4">

                        {{ $stats['month'] . ' ' . $stats['year'] }}

                        <span class="badge indigo darken-1 white-text">{{ $stats['published'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Tags</h3>

        @foreach($tags as $tag)

            <a href="{{ route('blog.tags',$tag->slug) }}">

                <span class="btn-small indigo white-text m-b-5 card-no-shadow">{{ $tag->name }}</span>

            </a>

        @endforeach
    </div>
</div> --}}
