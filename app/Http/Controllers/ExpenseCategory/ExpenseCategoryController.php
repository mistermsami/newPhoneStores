<?php

namespace App\Http\Controllers\ExpenseCategory; 
use App\Models\ExpenseCategory; 
use App\Http\Controllers\Controller;
use App\Mail\StockAlert;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ExpensesCategory\StoreExpensesCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Str;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $ExpenseCategories = ExpenseCategory::where('user_id', auth()->id())->count();

        return view('ExpenseCategory.index', [
            'ExpenseCategories' => $ExpenseCategories
        ]);
    }

    public function create()
    {
        return view('ExpenseCategory.create');
    }

    public function store(StoreExpensesCategoryRequest $request)
    {
        ExpenseCategory::create([
            "user_id"=>auth()->id(),
            "expenses_category_name" => $request->expenses_category_name, 
            "slug" => Str::slug($request->expenses_category_name),
        ]);

        return redirect()
            ->route('expensescategory.index')
            ->with('success', 'Expenses Category has been created!');
    }

    public function show(ExpenseCategory $ExpenseCategory)
    {
        return view('ExpenseCategory.show', [
            'ExpenseCategory' => $ExpenseCategory
        ]);
    }

    public function edit(ExpenseCategory $ExpenseCategory)
    {
        return view('ExpenseCategory.edit', [
            'ExpenseCategory' => $ExpenseCategory
        ]);
    }

    public function update(StoreExpensesCategoryRequest $request, ExpenseCategory $ExpenseCategory)
    {
        $ExpenseCategory->update([
            "expenses_category_name" => $request->expenses_category_name,
            "slug" => Str::slug($request->expenses_category_name)
        ]);

        return redirect()
            ->route('expensescategory.index')
            ->with('success', 'Expenses Category has been updated!');
    }

    public function destroy(ExpenseCategory $ExpenseCategory)
    {
        $ExpenseCategory->delete();

        return redirect()
        ->route('expensescategory.index')
            ->with('success', 'Expenses Category has been deleted!');
    }
}