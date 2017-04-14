<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewReplyRequest;
use App\Http\Requests\NewTitleRequest;
use App\Http\Requests\EditPostRequest;

use \Auth;
use \Session;

use Carbon\Carbon;

use App\Models\Title;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class FictionController extends Controller
{
    const PER_PAGE = 30;
    
    /*
     * View all Titles
     */
    public function index()
    {
        $users = User::has('posts', '>', 0)
            ->orderBy('name')
            ->get();
        
        $titles = Title::visible()
            ->orderBy('last_post','desc')
            ->paginate(self::PER_PAGE);
            
        $tags = Tag::all();    
            
        return view('list')
        ->with('titles',$titles)
        ->with('users',$users)
        ->with('tags',$tags);    
    }
    
    /*
     * View all titles by tag
     */
    public function tag($tag)
    {
        $tags = Tag::all();
        
        $users = User::where('id','=', \Auth::user()->id)
            ->has('posts', '>', 0)
            ->orderBy('name')
            ->get();
        
        $sTag = str_replace('-',' ',$tag);
        $titles = Title::visible()
            ->orderBy('last_post','desc')
            ->whereHas('tags', function($query) use($sTag) {
                $query->where('tag','=',$sTag);
            })
            ->paginate(self::PER_PAGE);
            
        return view('list')
        ->with('titles',$titles)
        ->with('users',$users)
        ->with('tags', $tags);    
    }
    
    /*
     * View Single Title and all Posts
     */
    public function view($id)
    {
        $title = Title::where('id','=',(int) $id)
            ->orderBy('created_at')
            ->with('user', 'posts', 'tags')
            ->first();
        
        return view('thread')->with('title',$title);
    }
    
    /*
     * View New Title form
     */
    public function create()
    {
        return view('new');
    }
    
    /*
     * Create New Title & Post
     */
    public function store(NewTitleRequest $request)
    {
        $rating = Rating::find($request->get('rating'));
        $private = $rating->private;
        
        if($request->has('private')) {
            $private = true;
        }
        
        
        $data = [
            'title' => $request->get('title'),
            'user_id' => Auth::user()->id,
            'last_post' => Carbon::now(),
            'rating' => $request->get('rating'),
            'private' => $private,
        ];
        
        $title = Title::create($data);
        
        $tags = $this->createOrFetchTags($request->get('tags'));
        
        foreach($tags as $tag) {
            $title->tags()->attach($tag->id);
        }
        
        $this->createPost($title, $request);
        
        Session::flash('success','New thread created');
        return redirect('/');
        
    }
    
    /*
     * Reply to a specific title form
     */
    public function reply($id)
    {
        $title = Title::where('id','=',(int) $id)
            ->first();
            
        return view('reply')->with('title', $title);
    }
    
    /*
     * Save reply post to title
     */
    public function post(NewReplyRequest $request)
    {
        $title = Title::where('id','=',(int) $request->get('title_id'))
            ->first();
            
        $post = $this->createPost($title, $request);
        
        $title->last_post = $post->created_at;
        $title->save();
        
        Session::flash('success','New reply created');
        return redirect('/view/'.$title->id);
    }
    
     /*
      * Delete a post or a whole thread
      */
    public function delete($id, $type)
    {
        if($type === 'title') {
            $title = Title::find((int) $id);
            
            $title->tags()->detach();
            
            foreach($title->posts as $post) {
                $post->delete();
            }
            
            $title->delete();
            Session::flash('success','Thread deleted successfully.');
        }
        else if($type === 'post') {
            Post::destroy($id);
            Session::flash('success','Post deleted successfully.');
        }
        else  {
            Session::flash('error','This item doesn\'t exist.');
        }
        
        return redirect('/');
    }
    
    /*
     * Edit
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        return view('edit')
            ->with('post',$post);
    }
    
    public function update(EditPostRequest $request)
    {
        $post = Post::find((int) $request->get('id'));
        
        $post->body = $request->get('body');
        $post->save();
        
        \Session::flash('succes','Post has been successfully edited.');
        return redirect()->route('view',['id' => $post->title_id]);
    }
     
    
    /*
     * Create 
     */
    protected function createOrFetchTags($tags)
    {
        $tags_array = explode(',',$tags);
        
        $models = [];
        
        foreach($tags_array as $tag) {
            $mTag = trim(strtolower($tag));
            $model = Tag::where('tag','=', $mTag)
                ->first();
                
            if($model == null) {
                $model = Tag::create([
                    'tag' => $mTag,
                ]);
            }    
            
            $models[] = $model;
        }
        
        return $models;
    }
    
    protected function createPost($title, $request)
    {
        $data = [
            'title_id' => $title->id,
            'user_id' => Auth::user()->id,
            'body' => $request->get('body'),
        ];
        
        $post = Post::create($data);
        
        $title->last_post = $post->created_at;
        $title->save();
        
        return $post;

    }
}
