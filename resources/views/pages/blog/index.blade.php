@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

<div id="main-content">
    <div class="page-title">
        <div class="page-title-wrapper" data-stellar-background-ratio="0.5">
            <div class="content container">
                <h1 class="heading_primary">Blog</h1>
                <ul class="breadcrumbs">
                    <li class="item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="item"><span class="separator"></span></li>
                    <li class="item active">Blog</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="site-content container">
        <div class="row">
            <main class="site-main col-sm-12 col-md-9 flex-first">
                <div class="blog-content layout-grid">
                    <div class="row">
                        @foreach ($posts as $post)
                            <article class="post col-sm-6 clearfix">
                                <div class="post-content">
                                    <div class="post-media">
                                        <a href="{{ route('blog.show',$post->slug) }}"><img src="{{Storage::url('posts/'.$post->image)}}" alt="{{ $post->title }}"></a>
                                    </div>
                                    <div class="post-summary">
                                        <h2 class="post-title">
                                            <a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a>
                                        </h2>
                                        <ul class="post-meta">
                                            <li>by <a href="#">{{$post->user->name}}</a></li>
                                            <li><span class="separator"></span></li>
                                            <li>{{$post->created_at->diffForHumans()}}</li>
                                            <li><span class="separator"></span></li>
                                            <li><a href="blog-single.html#comments-list">{{$post->comments_count}} Comments</a></li>
                                            <li><span class="separator"></span></li>
                                            <li>{{$post->view_count}} Views</li>
                                        </ul>
                                        <p class="post-description" lang="zxx">{!! \Illuminate\support\Str::limit($post->body,120) !!}</p>
                                        <a href="{{ route('blog.show',$post->slug) }}" class="btn-icon">Read more</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- <ul class="loop-pagination">
                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul> --}}
                </div>
            </main>
            @include('pages.blog.sidebar')
        </div>

    </div>
</div>
    {{-- <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Blog Posts</h4>
            </div>
            <div class="row">

                <div class="col s12 m8">

                    @foreach($posts as $post)
                        <div class="card horizontal">
                            <div>
                                <div class="card-content">
                                    @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                                        <div class="card-image blog-content-image">
                                            <img src="{{Storage::url('posts/'.$post->image)}}" alt="{{$post->title}}">
                                        </div>
                                    @endif
                                    <span class="card-title">
                                        <a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a>
                                    </span>
                                    {!! str_limit($post->body,120) !!}
                                </div>
                                <div class="card-action blog-action clearfix">
                                    <a href="{{ route('blog.author',$post->user->username) }}" class="btn-flat">
                                        <i class="material-icons">person</i>
                                        <span>{{$post->user->name}}</span>
                                    </a>
                                    <a href="#" class="btn-flat disabled">
                                        <i class="material-icons">watch_later</i>
                                        <span>{{$post->created_at->diffForHumans()}}</span>
                                    </a>
                                    @foreach($post->categories as $key => $category)
                                        <a href="{{ route('blog.categories',$category->slug) }}" class="btn-flat">
                                            <i class="material-icons">folder</i>
                                            <span>{{$category->name}}</span>
                                        </a>
                                    @endforeach
                                    @foreach($post->tags as $key => $tag)
                                        <a href="{{ route('blog.tags',$tag->slug) }}" class="btn-flat">
                                            <i class="material-icons">label</i>
                                            <span>{{$tag->name}}</span>
                                        </a>
                                    @endforeach

                                    <a href="{{ route('blog.show',$post->slug) . '#comments' }}" class="btn-flat">
                                        <i class="material-icons">comment</i>
                                        <span>{{$post->comments_count}}</span>
                                    </a>
                                    <a href="#" class="btn-flat disabled">
                                        <i class="material-icons">visibility</i>
                                        <span>{{$post->view_count}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="m-t-30 m-b-60 center">
                        {{ $posts->appends(['month' => Request::get('month'), 'year' => Request::get('year')])->links() }}
                    </div>

                </div>

                <div class="col s12 m4">

                    @include('pages.blog.sidebar')

                </div>

            </div>
        </div>
    </section> --}}

@endsection

@section('scripts')

@endsection
