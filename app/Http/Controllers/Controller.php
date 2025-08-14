<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    public function tncIndex(){
        $tncs=DB::table('tnc')->get();
        return view('admin.tnc.tnc',compact('tncs'));
    }

    public function addTncPage(){
        return view('admin.tnc.add-tnc');
    }

    public function create(Request $request){
        DB::table('tnc')->insert([

            'Description'=>$request->Description,
            'created_at'=>now(),

        ]);

        return redirect()->route('tnc-admin')->with('success', 'Terms & Condition Added successfully.');
    }

    public function editPage(){
    $tnc=DB::table('tnc')->first();
    return view('admin.tnc.edit-tnc',compact('tnc'));
}

public function update(Request $request,$id){
    

    $validateData=$request->validate([
        'Description'=>'required|string',
    ]);

    $saveData=[
        'description'=>$validateData['Description'],
        'updated_at'=>now()
    ];

    DB::table('tnc')->where('id',$id)->update($saveData);

        return redirect()->route('tnc-admin')->with('success', 'Terms & Condition Updated successfully.');

}
public function destroy($id)
{
    $faq = DB::table('tnc')->where('id', $id)->first();

    if ($faq) {
        DB::table('tnc')->where('id', $id)->delete();
        return redirect()->route('tnc-admin')->with('success', 'Terms & Condition deleted successfully..');

    } else {
        return redirect()->route('tnc-admin')->with('success', 'Terms & Condition ID not found.');

    }
}



        public function ppIndex(){
            $privacy_policy=DB::table('privacy_policy')->get();
            return view('admin.privacyPolicy.privacy_policy',compact('privacy_policy'));
        }

        public function addppPage(){
            return view('admin.privacyPolicy.add-pp');
        }

        public function createpp(Request $request){
            DB::table('privacy_policy')->insert([

                'Description'=>$request->Description,
                'created_at'=>now(),

            ]);

            return redirect()->route('pp-admin')->with('success', 'privacy_policy Added successfully.');
        }

        public function editppPage(){
        $privacy_policy=DB::table('privacy_policy')->first();
        return view('admin.privacyPolicy.edit-pp',compact('privacy_policy'));
    }

    public function updatePp(Request $request,$id){
        

        $validateData=$request->validate([
            'Description'=>'required|string',
        ]);

        $saveData=[
            'description'=>$validateData['Description'],
            'updated_at'=>now()
        ];

        DB::table('privacy_policy')->where('id',$id)->update($saveData);

            return redirect()->route('pp-admin')->with('success', 'Privacy Policy Updated successfully.');

    }
    public function destroyPp($id)
    {
        $faq = DB::table('privacy_policy')->where('id', $id)->first();

        if ($faq) {
            DB::table('privacy_policy')->where('id', $id)->delete();
            return redirect()->route('pp-admin')->with('success', 'Privacy Policy deleted successfully..');

        } else {
            return redirect()->route('pp-admin')->with('success', 'Privacy Policy ID not found.');

        }
    }



    //refund
     public function refundIndex(){
            $refund=DB::table('refund')->get();
            return view('admin.refund.refund',compact('refund'));
        }

        public function addrefundPage(){
            return view('admin.refund.add-refund');
        }

        public function createrefund(Request $request){
            DB::table('refund')->insert([

                'Description'=>$request->Description,
                'created_at'=>now(),

            ]);

            return redirect()->route('pp-refund')->with('success', 'refund policy Added successfully.');
        }




       public function editrefundPage($id)
{
    $refund = DB::table('refund')->where('id', $id)->first();

    if (!$refund) {
        abort(404); // Optional: better error handling
    }

    return view('admin.refund.edit-refund', compact('refund'));
}

    public function updaterefund(Request $request,$id){
        

        $validateData=$request->validate([
            'Description'=>'required|string',
        ]);

        $saveData=[
            'description'=>$validateData['Description'],
            'updated_at'=>now()
        ];

        DB::table('refund')->where('id',$id)->update($saveData);

            return redirect()->route('pp-refund')->with('success', 'Refund Updated successfully.');

    }
    public function destroyrefund($id)
    {
        $faq = DB::table('refund')->where('id', $id)->first();

        if ($faq) {
            DB::table('refund')->where('id', $id)->delete();
            return redirect()->route('pp-refund')->with('success', 'Refund deleted successfully..');

        } else {
            return redirect()->route('pp-refund')->with('success', 'Refund ID not found.');

        }
    }


    //disclaimer
     public function disclaimerIndex(){
            $disclaimer=DB::table('disclaimer')->get();
            return view('admin.disclaimer.disclaimer',compact('disclaimer'));
        }

        public function adddisclaimerPage(){
            return view('admin.disclaimer.add-disclaimer');
        }

        public function createdisclaimer(Request $request){
            DB::table('disclaimer')->insert([

                'Description'=>$request->Description,
                'created_at'=>now(),

            ]);

            return redirect()->route('pp-disclaimer')->with('success', 'disclaimer policy Added successfully.');
        }




       public function editdisclaimerPage($id)
{
    $disclaimer = DB::table('disclaimer')->where('id', $id)->first();

    if (!$disclaimer) {
        abort(404); // Optional: better error handling
    }

    return view('admin.disclaimer.edit-disclaimer', compact('disclaimer'));
}

    public function updatedisclaimer(Request $request,$id){
        

        $validateData=$request->validate([
            'Description'=>'required|string',
        ]);

        $saveData=[
            'description'=>$validateData['Description'],
            'updated_at'=>now()
        ];

        DB::table('disclaimer')->where('id',$id)->update($saveData);

            return redirect()->route('pp-disclaimer')->with('success', 'disclaimer Updated successfully.');

    }
    public function destroydisclaimer($id)
    {
        $faq = DB::table('disclaimer')->where('id', $id)->first();

        if ($faq) {
            DB::table('disclaimer')->where('id', $id)->delete();
            return redirect()->route('pp-disclaimer')->with('success', 'disclaimer deleted successfully..');

        } else {
            return redirect()->route('pp-disclaimer')->with('success', 'disclaimer ID not found.');

        }
    }


}
