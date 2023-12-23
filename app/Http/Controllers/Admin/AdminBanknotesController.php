<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankNotesRequest;
use App\Models\BankNote;
use Illuminate\Http\Request;

class AdminBanknotesController extends Controller
{
    public function index(){
        $banknotes=BankNote::orderBy('id','desc')->get();
        return view('banknotes.index', compact('banknotes'));
    }

    public function create(){
        return view('banknotes.create');
    }
    public function store(BankNotesRequest $request){

        BankNote::create([
            'title'=>$request->title,
            'price'=>$request->price,
            'count'=>$request->count,
        ]);

        return redirect()->route('banknotes.index');
    }

    public function edit(Request $request, $id){
        $banknote=BankNote::find($id);
        return view('banknotes.edit', compact('banknote'));

    }

    public function destroy($id){
        BankNote::find($id)->delete();
        return redirect()->route('banknotes.index');
    }


    public function update(BankNotesRequest  $request, $id){
        $banknote=BankNote::find($id);
        $banknote->title=$request->title;
        $banknote->price=$request->price;
        $banknote->count=$request->count;
        $banknote->save();
        return redirect()->route('banknotes.index');
    }

}
