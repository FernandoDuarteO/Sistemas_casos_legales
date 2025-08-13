<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegalCase;
use App\Http\Requests\LegalCaseRequest;

use App\Models\Audience;
use App\Models\Hall;
use App\Models\Stage;
use App\Models\Customer;
use App\Models\Lawyer;

class LegalCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $legal_cases = Legal_Case::with('legal_case','audience', 'hall', 'stage', 'customer', 'lawyer')->paginate(5);
        return view('audiences.index', compact('audiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $legal_cases = new Legal_Case();
        $audiences = Audience::all();
        $halls = Hall::all();
        $stages = Stage::all();
        $customers = Customer::all();
        $lawyers = Lawyer::all();
        return view('legal_cases.create', compact('legal_cases', 'audiences', 'halls', 'stages', 'customers', 'lawyers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LegalCaseRequest $request)
    {
        Legal_Case::create($request->validated());
        return redirect()->route('legal_cases.index')->with('success', 'Caso Legal creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $legal_cases = Legal_Case::find($id);
        $audiences = Audience::all();
        $halls = Hall::all();
        $stages = Stage::all();
        $customers = Customer::all();
        $lawyers = Lawyer::all();
        return view('legal_cases.show', compact('legal_cases', 'audiences', 'halls', 'stages', 'customers', 'lawyers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $legal_cases = Legal_Case::find($id);
        $audiences = Audience::all();
        $halls = Hall::all();
        $stages = Stage::all();
        $customers = Customer::all();
        $lawyers = Lawyer::all();
        return view('legal_cases.edit', compact('legal_cases', 'audiences', 'halls', 'stages', 'customers', 'lawyers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LegalCaseRequest $request, int $id)
    {
        $legal_cases = Legal_Case::find($id);
        $legal_cases->update($request->validated());
        return redirect()->route('legal_cases.index')->with('updated', 'Caso Legal actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $legal_cases = Legal_Case::find($id);
        $legal_cases->delete();
        return redirect()->route('legal_cases.index')->with('deleted', 'Caso Legal eliminida con éxito.');
    }
}
