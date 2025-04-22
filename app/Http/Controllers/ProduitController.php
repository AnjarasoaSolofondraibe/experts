<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::query();

        if ($request->filled('type') && $request->type != 'Toutes') {
            $query->where('type', $request->type);
        }

        if ($request->filled('prix')) {
            $query->where('prix', '<=', $request->prix);
        }

        $produits = $query->paginate(12);

        return view('catalogue', compact('produits'));
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('show', compact('produit'));
    }
    
}
