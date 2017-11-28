<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Requests\ItemFormRequest;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['su','auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all items
        $items = Item::all();
        $addBtn = ['title'=>'Add Item', 'action' => 'items/create', 'icon' => 'icon md-plus'];
        $buttons =[];
        array_push($buttons, $addBtn);
        return view('backend.items.index', compact('items', 'buttons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create new item
        $listBtn = ['title'=>'All Items', 'action' => 'items', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $listBtn);
        return view('backend.items.create', compact('buttons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFormRequest $request)
    {
        $item = Item::create($request->all());
        flash('New item has been added!', 'success');
        return redirect('items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // Show item of $id

        $addBtn = ['title'=>'Add Item', 'action' => 'items/create', 'icon' => 'icon md-plus'];
        $editBtn = ['title'=>'Edit Item', 'action' => 'items/' . $item->id . '/edit', 'icon' => 'icon md-edit'];
        $listBtn = ['title'=>'All Items', 'action' => 'items', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $addBtn, $editBtn, $listBtn);
        return view('backend.items.show', compact('item', 'buttons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $addBtn = ['title'=>'Add Item', 'action' => 'items/create', 'icon' => 'icon md-plus'];
        $listBtn = ['title'=>'All Items', 'action' => 'items', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons, $addBtn, $listBtn);
        return view('backend.items.edit', compact('item', 'buttons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemFormRequest $request
     * @param  \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemFormRequest $request, Item $item)
    {
        // Update other data except image
        $item->update($request->all());
        flash('Item has been successfully updated!', 'success');
        return redirect('items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // Delete a item
        $item->delete();
        flash('Item has been deleted!', 'success');
        return redirect('items');
    }
}
