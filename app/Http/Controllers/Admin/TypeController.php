<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// importo la tabella Type
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //* vengono mostrati tutti tipi in una volta
      // $types = Type::all();
      //* vengono mostrati 8 tipi alla volta (per far ciò è necessario importare bootstrap in AppServiceProvider)
      $types = Type::paginate(8);
      // $types = Type::paginate(2);


      return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $val_data = $request->validate(
        ['name' => 'required|unique:types|max:50']
      );

      $val_data['slug'] = Str::slug($val_data['name']);

      $new_type = new Type();
      $new_type->fill($val_data);
      $new_type->save();

      // redirect per ritornare indietro con un messaggio
      return redirect()->back()->with('message', "Type $new_type->name creata");
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
    public function update(Request $request, Type $type)
    {
      $val_data = $request->validate(
        ['name' => 'required|unique:types|max:50']
      );

      $val_data['slug'] = Str::slug($val_data['name']);

      $type->update($val_data);

      // redirect per ritornare indietro con un messaggio
      return redirect()->back()->with('message', "Type $type->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
      $type->delete();
      return redirect()->back()->with('message', "Type $type->name deleted successfully");
    }
}
