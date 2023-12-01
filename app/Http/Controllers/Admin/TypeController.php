<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;
use App\Function\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view("admin.types.index", compact("types"));
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
        $exist = Type::where("name", $request->name)->first();

        if($exist){
            return redirect()->route("admin.types.index")->with("error", "Tipologia già presente");
        }else{
            $new_type = new Type();
            $new_type->name = $request->name;
            $new_type->slug = Str::slug($request->name, "-");
            $new_type->save();

            return redirect()->route("admin.types.index")->with("success", "Tipologia creata correttamente");
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
        $val_data = $request->validate([
            "name" => "required|min:2|max:20",
        ],[
            "name.required" => 'Devi inserire il nome della tipologia',
            "name.min" => 'Il nome della tipologia deve essere minimo 2 caratteri',
            "name.max" => 'Il nome della tipologia deve essere massimo 20 caratteri'
        ]);

        $exixts = Type::where("name", $request->name)->first();
        if($exixts){
            return redirect()->route("admin.types.index")->with("error", "Tipologia già presente");
        }

        $val_data["slug"] = Helper::generateSlug($request->name, Type::class);
        $type->update($val_data);

        return redirect()->route("admin.types.index")->with("success", "Tipologia aggiornata con successo");
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
        return redirect()->route("admin.types.index")->with("success", "Hai eliminato con successo la tipologia");
    }
}
