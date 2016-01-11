<?php

namespace PostCheck\Http\Controllers;

use Illuminate\Http\Request;

use PostCheck\Core\Feeds\Twitter;
use PostCheck\Core\FeedService;
use PostCheck\Feeds;
use PostCheck\Http\Requests;
use PostCheck\Http\Controllers\Controller;

class FeedsController extends Controller
{

    public function __construct()
    {
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
            'notify_by' => 'required',
        ]);
        $data = $request->only(['link', 'notify_by']);
        $data['type'] = FeedService::type($data['link']);

        $feed = Feeds::create($data);

        $this->currentUser()->feeds()->save($feed);

        $feed->checkNow();

        flash()->success('You\'ve added a feed for us to monitor');

        return redirect('/dashboard');

    }

    public function multi(Request $request)
    {
        dd($request->input('choice'), $request->input('todo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feed = $this->currentUser()->feeds()->find($id);

        return $feed;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
