<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Exception;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function show(Applicant $applicant) {
        return response()->json($applicant,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $applicants = Applicant::where('name','like',"%$request->key%")
            ->orWhere('age','like',"%$request->key%")->get();

        return response()->json($applicants, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'age' => 'string|required',
            'expertise' => 'string|required',
            'address' => 'string|required',
            'contact' => 'string|required',
        ]);

        try {
            $applicant = Applicant::create($request->all());
            return response()->json($applicant, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Applicant $applicant) {
        try {
            $applicant->update($request->all());
            return response()->json($applicant, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Applicant $applicant) {
        $applicant->delete();
        return response()->json(['message'=>'applicant deleted.'],202);
    }

    public function index() {
        $applicants = Applicant::orderBy('name')->get();
        return response()->json($applicants, 200);
    }
}
