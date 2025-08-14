<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{
    public function faqAdmin(){
        $faq=DB::table('faq')->get();
        return view('admin.faq.faq',compact('faq'));
    }


    public function addFaqPage(){
        return view('admin.faq.add-faq');
    }

public function create(Request $request){

    $validateData=$request->validate([
        'Title'=>'required|string',
        'Description'=>'required|string',
    ]);

    $saveData=[
        'title'=>$validateData['Title'],
        'description'=>$validateData['Description'],
        'created_at'=>now()
    ];

    DB::table('faq')->insert($saveData);

        return redirect()->route('faq-admin')->with('success', 'Faq Added successfully.');
    

}

public function editPage(){
    $faq=DB::table('faq')->first();
    return view('admin.faq.edit-faq',compact('faq'));
}

public function update(Request $request,$id){
    

    $validateData=$request->validate([
        'Title'=>'required|string',
        'Description'=>'required|string',
    ]);

    $saveData=[
        'title'=>$validateData['Title'],
        'description'=>$validateData['Description'],
        'updated_at'=>now()
    ];

    DB::table('faq')->where('id',$id)->update($saveData);

        return redirect()->route('faq-admin')->with('success', 'Faq Updated successfully.');

}
public function destroy($id)
{
    $faq = DB::table('faq')->where('id', $id)->first();

    if ($faq) {
        DB::table('faq')->where('id', $id)->delete();
        return redirect()->route('faq-admin')->with('success', 'FAQ deleted successfully..');

    } else {
        return redirect()->route('faq-admin')->with('success', 'FAQ ID not found.');

    }
}

}
