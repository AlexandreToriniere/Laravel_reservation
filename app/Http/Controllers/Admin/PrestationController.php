<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Prestation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PrestaStoreRequest;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestations = Prestation::all();
        return view('admin.prestations.index', compact('prestations'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view ('admin.prestations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrestaStoreRequest $request)
    {   
        
        $image = $request->file('image')->store('public/prestations');
      
        $prestation = Prestation::create([
            'name'=>$request->name,
            'description'=> $request->description,
            'image' =>$image,
            'price' =>$request->price
        ]);

        if($request->has('categories')){
            $prestation->categories()->attach($request->categories);
        }

        return to_route('admin.prestations.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestation $prestation)
    {
        $categories = Category::all();
        return view('admin.prestations.edit', compact('prestation', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestation $prestation)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ]);
        
        $image = $prestation->image;
        if($request->hasFile('image')){
            Storage::delete($prestation->image);
            $image = $request->file('image')->store('public/prestation');
        }
        $prestation->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>$image
        ]);

        return to_route('admin.prestations.index')->with('success', 'Prestations Created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestation $prestation)
    {
        Storage::delete($prestation->image);
        $prestation->reservations()->delete();
        $prestation->delete();

        return to_route('admin.prestations.index')->with('Alert', 'Prestations Created successfully');
    }
}
