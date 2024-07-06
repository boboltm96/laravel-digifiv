<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chef;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chefs = Chef::all();
        $statuses = Chef::$status;

        return view('chef.index', [
            'chefs' => $chefs,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('chef.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $chef = new Chef;
 
        $chef->name = $request->name;
        $chef->age = $request->age;
        $chef->phone = $request->phone;
        $chef->address = $request->address;
 
        $chef->save();

        return redirect()->route('chefs.index');
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
        try {
            $chef = Chef::findOrFail($id);
            $statuses = Chef::$status;
            return view('chef.show', [
                'chef' => $chef,
                'statuses' => $statuses,
            ]);
        }catch (\Exception $error) {
            abort(404);
        }
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
        try {
            $chef = Chef::findOrFail($id);
            $statuses = Chef::$status;
            return view('chef.edit', [
                'chef' => $chef,
                'statuses' => $statuses,
            ]);
        }catch (\Exception $error) {
            abort(404);
        }
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
        try {
            $chef = Chef::findOrFail($id);

            $chef->name = $request->name;
            $chef->age = $request->age;
            $chef->phone = $request->phone;
            $chef->address = $request->address;
            $chef->status = $request->status;
    
            $chef->save();

            return redirect()->back()->with('success', 'Chef information successfully updated.');
        }catch (\Exception $error) {
            abort(404);
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
        //
        try {
            $chef = Chef::findOrFail($id);
            $chef->delete();

            return redirect()->back()->with('success', 'Chef information successfully deleted.');
        }catch (\Exception $error) {
            abort(404);
        }
    }
}