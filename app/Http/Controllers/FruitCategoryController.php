<?php

namespace App\Http\Controllers;

use App\Models\FruitCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FruitCategoryController extends Controller
{
    public function index()
    {
        $fruitCategories = FruitCategory::all();
        return Inertia::render('FruitCategory/FruitCategory', ['fruitCategories' => $fruitCategories]);
    }
}
