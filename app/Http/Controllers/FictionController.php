<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewReplyRequest;
use App\Http\Requests\NewTitleRequest;

use \Auth;
use \Session;

use Carbon\Carbon;

use App\Models\Title;
use App\Models\Post;
use App\Models\Tag;

class FictionController extends Controller
{
    const PER_PAGE = 30;
    
    /*
     * View all Titles
     */
    public function index()
    {
        
        $titles = Title::orderBy('last_post','desc')
            ->paginate(self::PER_PAGE);
            
        return view('list')->with('titles',$titles);    
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
        $data = [
            'title' => $request->get('title'),
            'user_id' => Auth::user()->id,
            'last_post' => Carbon::now(),
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
            Title::destroy($id);
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
