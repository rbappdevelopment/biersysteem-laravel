<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bierstand;
use App\Models\Mutaties;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function LoadAdminPage(){
        //Load mutaties for mutaties button in header
        $mutaties = Mutaties::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.admin', compact('mutaties'));
    }

    public function LoadAdminPage_AddPerson(){
        $mutaties = Mutaties::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.admin-addperson', compact('mutaties'));
    }

    public function UpdateValue($id, Request $req){
        // $Bierstand = Bierstand::where($id)->first();
        $Bierstand = Bierstand::find($id);

        echo "voor optellen: " . $Bierstand->Bier . " & er komt bij: " . $req->changeDrinksAmount;
        $oldValue = $Bierstand->Bier;
        $Bierstand->Bier += $req->changeDrinksAmount;
        $Bierstand->save();
        echo "na optellen: " . $Bierstand->Bier;

        return redirect()->back()
        ->with('successfulUpdateTitle', 'Bierstand geüpdatet!')
        ->with('successfulUpdateBody', 'Bierstand aangepast voor  ' . $Bierstand->where('id', $id)->value('Heer') . ':  ' . $req->changeDrinksAmount . " is bij " . $oldValue . " opgeteld.")
        ->with('successfulUpdateEnd', "Totaal is nu: " . $Bierstand->Bier);
    }
    
    public function AddPerson(Request $req){

        $req->validate([
            'Heer' => 'required|max:50|unique:Bierstand'
        ]);

        $person = new Bierstand;
        $person->Heer = $req->Heer;
        $person->Bier = 0;
        $person->save();

        return redirect()->back()
        ->with('success', 'Persoon is aangemaakt: ')
        ->with('persoonadded', $req->Heer);
    }

    public function LoadAdminPage_EditPerson(){
        $bierstand = Bierstand::orderBy('TotaalOnzichtbaar', 'desc')->get();
        $mutaties = Mutaties::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.admin-editperson', compact('mutaties', 'bierstand'));
    }    
}

// user roles (for admin) --> https://www.youtube.com/watch?v=kZOgH3-0Bko