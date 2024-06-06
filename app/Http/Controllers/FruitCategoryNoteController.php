<?php

namespace App\Http\Controllers;

use App\Models\FruitCategory;
use App\Models\FruitCategoryNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FruitCategoryNoteController extends Controller
{
    public function index()
    {
        $fruitCategoryNotes = FruitCategory::with('fruitCategoryNotes')->get();
        return Inertia::render('FruitCategoryNote/FruitCategoryNote', ['fruitCategoryNotes' => $fruitCategoryNotes]);
    }
}
