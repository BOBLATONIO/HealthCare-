<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $medicines = Medicine::where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->paginate(5)
            ->withQueryString();

        if ($request->ajax()) {
            return view('components.medicine-partials', compact('medicines'));
        }

        return view('inventory', compact('medicines'));
    }

    public function showInventoryPage()
    {
        $medicines = Medicine::orderBy('created_at', 'desc')->paginate(6);

        return view('inventory', compact('medicines'));
    }

    public function destroyMedicine(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->back()->with('success', 'Medicine deleted successfully.');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);


        $medicine = Medicine::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);


        return redirect()->back()->with('success', 'Medicine added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Medicine updated successfully!');
    }
}
