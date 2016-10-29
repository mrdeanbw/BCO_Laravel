<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use App\NewsItem;

class NewsItemController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $news = \App\NewsItem::orderBy('pinned', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        $news->load(['created_by']);                
        return \View::make('newsitems.index')->withNews($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', NewsItem::class);
        return \View::make('newsitems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->authorize('create', NewsItem::class);

        $rules = array(
            'title' => 'required|min:5|max:255',
            'body' => 'required');

        $validator = Validator::make(Request::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('members/news/create')
            ->withErrors($validator)
            ->withInput(Request::all());
        } else {
            $user = \Auth::user();
            $newsItem = new NewsItem;
            $newsItem->title = Request::get('title');
            $newsItem->body = Request::get('body');
            $newsItem->user_id = $user->id;

            $newsItem->save();
            Session::flash('message', 'Succesfully created a new post');
            return Redirect::route('news.show', [$newsItem]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->authorize('view', $id);
        $id->load(['created_by']);                
        return \View::make('newsitems.show')->withNews($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $this->authorize('update', $id);
        $id->load(['created_by']);
        return \View::make('newsitems.edit')->withNews($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        
        $this->authorize('update', $id);

        $rules = array(
            'title' => 'required|min:5|max:255',
            'body' => 'required');

        $validator = Validator::make(Request::all(), $rules);

        if($validator->fails()) {
            return Redirect::route('news.edit', [$id])
            ->withErrors($validator)
            ->withInput(Request::all());
        } else {
            $newsItem = $id;
            $newsItem->title = Request::get('title');
            $newsItem->body = Request::get('body');            
            $newsItem->pinned = Request::get('pinned') ? 1 : 0;
            $newsItem->save();
            Session::flash('message', 'Succesfully updated your post');
            return Redirect::route('news.show', [$newsItem]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->authorize('delete', $id);
        $id->delete();

        Session::flash('message', 'Post Deleted.');
        return Redirect::route('news.index');
    }
}
