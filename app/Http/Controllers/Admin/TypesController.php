<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class TypesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::latest()->get();

        return view('admin.types.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:features|max:255'
        ]);

        $type = new Type();
        $type->name = $request->name;
        $type->slug = Str::slug($request->name);
        $type->save();

        Toastr::success('message', 'Type created successfully.');
        return redirect()->route('admin.types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $type->name = $request->name;
        $type->slug = Str::slug($request->name);
        $type->save();

        Toastr::success('message', 'Type updated successfully.');
        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        Toastr::success('message', 'Type deleted successfully.');
        return back();
    }
}
