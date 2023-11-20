<?php

namespace App\Http\Controllers;

use App\Chanel;
use App\Http\Requests\Channels\UpdateChannelRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth'])->only('update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $channel = Chanel::find($id);
        $videos  = $channel->videos()->paginate(5);
       
        return view('channels.show', compact('channel', 'videos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChannelRequest $request, string $id)
    {
        $chanel = Chanel::find($id);

        if ($request->hasFile('image')) {
            $chanel->clearMediaCollection('images');

            $chanel->addMediaFromRequest('image')
                ->toMediaCollection('images');
        }
        $chanel->name = $request->name;
        $chanel->description = $request->description;
        $chanel->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        //
    }
}
