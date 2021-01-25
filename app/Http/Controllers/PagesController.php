<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

use App\Gallery;
use App\Comment;
use App\Post;
use App\Rating;
use App\Room;
use App\Type;
use App\User;

use Carbon\Carbon;
use Auth;
use DB;

class PagesController extends Controller
{
    public function rooms()
    {
        $types = Type::all();
        $rooms = Room::latest()->with('rating')->withCount('comments')->paginate(12);

        return view('pages.rooms.index', compact('rooms', 'types'));
    }

    // ROOMS ACCORDING TO TYPES
    public function roomType($id)
    {
        $types = Type::where('id', $id)->get();
        $rooms = Room::where('type_id', $id)->latest()->with('rating')->withCount('comments')->paginate(12);

        return view('pages.rooms.index', compact('rooms','types'));
    }


    public function showRoom($slug)
    {
        $room = Room::with('features','gallery','comments')
                            ->withCount('comments')
                            ->where('slug', $slug)
                            ->first();

        $rating = Rating::where('room_id',$room->id)->where('type','room')->avg('rating');

        return view('pages.rooms.single', compact('room', 'rating'));
    }

        // ROOM COMMENT
        public function roomComments(Request $request, $id)
        {
            $request->validate([
                'body'  => 'required'
            ]);

            $room = Room::find($id);
            $room->comments()->create(
                [
                    'user_id'   => Auth::id(),
                    'body'      => $request->body,
                    'parent'    => $request->parent,
                    'parent_id' => $request->parent_id
                ]
            );

            return back();
        }


        // ROOM RATING
        public function roomRating(Request $request)
        {
            $rating      = $request->input('rating');
            $room_id = $request->input('room_id');
            $user_id     = $request->input('user_id');
            $type        = 'room';

            $rating = Rating::updateOrCreate(
                ['user_id' => $user_id, 'room_id' => $room_id, 'type' => $type],
                ['rating' => $rating]
            );

            if($request->ajax()){
                return response()->json(['rating' => $rating]);
            }
        }


    // AGENT PAGE
    public function agents()
    {
        $agents = User::latest()->where('role_id', 2)->paginate(12);

        return view('pages.agents.index', compact('agents'));
    }

    public function agentshow($id)
    {
        $agent      = User::findOrFail($id);
        $properties = Property::latest()->where('agent_id', $id)->paginate(10);

        return view('pages.agents.single', compact('agent','properties'));
    }


    // BLOG PAGE
    public function blog()
    {
        $month = request('month');
        $year  = request('year');

        $posts = Post::latest()->withCount('comments')
                                ->when($month, function ($query, $month) {
                                    return $query->whereMonth('created_at', Carbon::parse($month)->month);
                                })
                                ->when($year, function ($query, $year) {
                                    return $query->whereYear('created_at', $year);
                                })
                                ->where('status',1)
                                ->paginate(6);

        return view('pages.blog.index', compact('posts'));
    }

    public function blogshow($slug)
    {
        $post = Post::with('comments')->withCount('comments')->where('slug', $slug)->first();

        $blogkey = 'blog-' . $post->id;
        if(!Session::has($blogkey)){
            $post->increment('view_count');
            Session::put($blogkey,1);
        }

        return view('pages.blog.single', compact('post'));
    }


    // BLOG COMMENT
    public function blogComments(Request $request, $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $post = Post::find($id);

        $post->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // BLOG CATEGORIES
    public function blogCategories()
    {
        $posts = Post::latest()->withCount(['comments','categories'])
                                ->whereHas('categories', function($query){
                                    $query->where('categories.slug', '=', request('slug'));
                                })
                                ->where('status',1)
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG TAGS
    public function blogTags()
    {
        $posts = Post::latest()->withCount('comments')
                                ->whereHas('tags', function($query){
                                    $query->where('tags.slug', '=', request('slug'));
                                })
                                ->where('status',1)
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG AUTHOR
    public function blogAuthor()
    {
        $posts = Post::latest()->withCount('comments')
                                ->whereHas('user', function($query){
                                    $query->where('username', '=', request('username'));
                                })
                                ->where('status',1)
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }



    // MESSAGE TO AGENT (SINGLE AGENT PAGE)
    public function messageAgent(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());

        if($request->ajax()){
            return response()->json(['message' => 'Message send successfully.']);
        }

    }


    // CONATCT PAGE
    public function contact()
    {
        return view('pages.contact');
    }

    public function messageContact(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        $message  = $request->message;
        $mailfrom = $request->email;

        Message::create([
            'agent_id'  => 1,
            'name'      => $request->name,
            'email'     => $mailfrom,
            'phone'     => $request->phone,
            'message'   => $message
        ]);

        $adminname  = User::find(1)->name;
        $mailto     = $request->mailto;

        Mail::to($mailto)->send(new Contact($message,$adminname,$mailfrom));

        if($request->ajax()){
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    public function contactMail(Request $request)
    {
        return $request->all();
    }


    // GALLERY PAGE
    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('pages.gallery',compact('galleries'));
    }



}
