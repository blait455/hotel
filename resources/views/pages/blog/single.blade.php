@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <div id="main-content">
        <div class="page-title">
            <div class="page-title-wrapper" data-stellar-background-ratio="0.5">
                <div class="content container">
                    <h1 class="heading_primary">Blog Single</h1>
                    <ul class="breadcrumbs">
                        <li class="item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="item"><span class="separator"></span></li>
                        <li class="item"><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="item"><span class="separator"></span></li>
                        <li class="item active">{{ $post->title }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="site-content container">
            <div class="row">
                <main class="site-main col-sm-12 col-md-9 flex-first">
                    <div class="blog-single-content">
                        <article class="post clearfix">
                            <div class="post-content">
                                <div class="post-media">
                                    <img src="{{Storage::url('posts/'.$post->image)}}" alt="">
                                </div>

                                <div class="post-summary">
                                    <h2 class="post-title">{{ $post->title }}</h2>
                                    <ul class="post-meta">
                                        <li>by <a href="#">{{$post->user->name}}</a></li>
                                        <li><span class="separator"></span></li>
                                        <li>
                                            @foreach ($post->tags as $tag)
                                                <a href="{{ route('blog.tags',$tag->slug) }}">{{ $tag->name }}</a>,
                                            @endforeach
                                        </li>
                                        <li><span class="separator"></span></li>
                                        <li>{{$post->created_at->diffForHumans()}}</li>
                                        <li><span class="separator"></span></li>
                                        <li><a href="blog-single.html#comments-list">{{ $post->comments_count }} Comments</a></li>
                                    </ul>
                                    <div class="post-description">
                                        {!! $post->body !!}
                                    </div>
                                    <div class="meta_post">
                                        <ul class="post-tags">
                                            <li class="title"><i class="fa fa-tags"></i>Tags:</li>
                                            <li><a href="#">minimalist</a></li>
                                            <li><a href="#">color</a></li>
                                            <li><a href="#">designer</a></li>
                                        </ul>

                                        <div class="social-share">
                                            <ul>
                                                <li><a class="link facebook" title="Facebook" href="http://www.facebook.com/sharer/sharer.php?u=#" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="ion-social-facebook"></i></a></li>
                                                <li><a class="link twitter" title="Twitter" href="https://twitter.com/intent/tweet?url=#&amp;text=TheTitleBlog" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="ion-social-twitter"></i></a></li>
                                                <li><a class="link pinterest" title="Pinterest" href="http://pinterest.com/pin/create/button/?url=#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="ion-social-pinterest"></i></a></li>
                                                <li><a class="link google" title="Google" href="https://plus.google.com/share?url=#" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="ion-social-googleplus"></i></a>
                                                <li><a class="link linkedin" title="LinkedIn" href="http://www.linkedin.com/shareArticle/?url=#" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="comments-list" id="comments-list">
                                    <h3 class="total-comments">3 comments</h3>
                                    <ul>
                                        <li class="comment clearfix">
                                            <div class="comment-img">
                                                <img src="images/blog/author.jpg" alt="">
                                            </div>
                                            <div class="comment-content">
                                                <h6>Anna Shubina</h6>
                                                <span>March 03, 2015</span>
                                                <a class="reply" href="#post-comment" title="Reply">Reply</a>
                                                <p>Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor. Erates vitae node metus. Morbi suspendisse a tortor velim pellentesque uter justo magna gravida. Pellentesque accumsan, ex in tempus ullamcorper terminal.</p>
                                            </div>
                                            <ul class="children">
                                                <li class="comment clearfix">
                                                    <div class="comment-img">
                                                        <img src="images/blog/author.jpg" alt="">
                                                    </div>

                                                    <div class="comment-content">
                                                        <h6>Anna Shubina</h6>
                                                        <span>March 03, 2015</span>
                                                        <a class="reply" href="#post-comment" title="Reply">Reply</a>
                                                        <p>Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor. Erates vitae node metus. Morbi suspendisse a tortor velim pellentesque uter justo magna gravida. Pellentesque accumsan, ex in tempus ullamcorper terminal.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="comment clearfix">
                                            <div class="comment-img">
                                                <img src="images/blog/author.jpg" alt="">
                                            </div>
                                            <div class="comment-content">
                                                <h6>Ann Smith</h6>
                                                <span>March 03, 2018</span>
                                                <a class="reply" href="#post-comment" title="Reply">Reply</a>
                                                <p>Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor. Erates vitae node metus. Morbi suspendisse a tortor velim pellentesque uter justo magna gravida. Pellentesque accumsan, ex in tempus ullamcorper terminal.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="post-comment" id="post-comment">
                                    <h3 class="reply-comment">leave a comment</h3>
                                    <form action="#" method="post" id="comment-form">
                                        <p>Your email address will not be published. Required fields are marked *</p>
                                        <div class="row">
                                            <div class="col-sm-6"><input placeholder="Name *" id="name" name="name" type="text" value="" size="30" required></div>
                                            <div class="col-sm-6"><input placeholder="Email *" id="email" name="email" type="email" value="" size="30" required></div>
                                        </div>
                                        <textarea placeholder="Message *" name="message" id="message" cols="45" rows="8" required></textarea>
                                        <input name="submit" type="submit" id="submit" class="submit" value="Post Comment">
                                    </form>
                                </div>

                            </div>
                        </article>
                    </div>
                </main>
                @include('pages.blog.sidebar')
            </div>
        </div>
    </div>


    {{-- <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m8">

                    <div class="card">
                        <div class="card-image">
                            @if(Storage::disk('public')->exists('posts/'.$post->image))
                                <img src="{{Storage::url('posts/'.$post->image)}}" alt="{{$post->title}}">
                            @endif
                        </div>
                        <div class="card-content">
                            <span class="card-title" title="{{$post->title}}">{{ $post->title }}</span>
                            {!! $post->body !!}
                        </div>
                        <div class="card-action blog-action">
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

                            <a href="#" class="btn-flat disabled">
                                <i class="material-icons">visibility</i>
                                <span>{{$post->view_count}}</span>
                            </a>
                        </div>

                    </div>

                    <div class="card" id="comments">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">{{ $post->comments_count }} Comments</h5>
                        </div>
                        <div class="single-narebay p-15">

                            @foreach($post->comments as $comment)

                                @if($comment->parent_id == null)
                                    <div class="comment">
                                        <div class="author-image">
                                            <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                        </div>
                                        <div class="content">
                                            <div class="author-name">
                                                <strong>{{ $comment->users->name }}</strong>
                                                <span class="time">{{ $comment->created_at->diffForHumans() }}</span>

                                                @auth
                                                    <span class="right replay" data-commentid="{{ $comment->id }}">Replay</span>
                                                @endauth

                                            </div>
                                            <div class="author-comment">
                                                {{ $comment->body }}
                                            </div>
                                        </div>
                                        <div id="comment-{{$comment->id}}"></div>
                                    </div>
                                @endif

                                @if($comment->children->count() > 0)
                                    @foreach($comment->children as $comment)
                                        <div class="comment children">
                                            <div class="author-image">
                                                <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                            </div>
                                            <div class="content">
                                                <div class="author-name">
                                                    <strong>{{ $comment->users->name }}</strong>
                                                    <span class="time">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="author-comment">
                                                    {{ $comment->body }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            @endforeach

                            @auth
                                <div class="comment-box">
                                    <h6>Leave a comment</h6>
                                    <form action="{{ route('blog.comment',$post->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parent" value="0">

                                        <textarea name="body" class="box"></textarea>
                                        <input type="submit" class="btn indigo" value="Comment">
                                    </form>
                                </div>
                            @endauth

                            @guest
                                <div class="comment-login">
                                    <h6>Please Login to comment</h6>
                                    <a href="{{ route('login') }}" class="btn indigo">Login</a>
                                </div>
                            @endguest

                        </div>
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
<script>
    $(document).on('click','span.right.replay',function(e){
        e.preventDefault();

        var commentid = $(this).data('commentid');

        $('#comment-'+commentid).empty().append(
            `<div class="comment-box">
                <form action="{{ route('blog.comment',$post->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent" value="1">
                    <input type="hidden" name="parent_id" value="`+commentid+`">

                    <textarea name="body" class="box" placeholder="Leave a comment"></textarea>
                    <input type="submit" class="btn indigo" value="Comment">
                </form>
            </div>`
        );
    });
</script>
@endsection
