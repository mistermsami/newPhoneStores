<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Mail\StockAlert;
use Illuminate\Http\Request;
use App\Http\Requests\Expenses\ExpensesRequest;
use Str;

class ExpenseController extends Controller
{
    public function index()
    {
        $Expenses = Expense::where("user_id", auth()->id())->count();
        return view('expense.index', [
            'Expense' => $Expenses
        ]);
    }

    public function create()
    {
        $expensescategories = ExpenseCategory::where('user_id', auth()->id())->get();
        return view('expense.create', [
            'expensescategories' => $expensescategories
        ]);
    }

    public function store(ExpensesRequest $request)
    {
        Expense::create([
            "user_id" => auth()->id(),
            "expenses_name" => $request->expenses_name,
            "expenses_date" => $request->expenses_date,
            "expenses_amount" => $request->expenses_amount,
            "expenses_notes" => $request->expenses_notes,
            "expenses_category_id" => $request->expenses_category_id,
            "slug" => Str::slug($request->expenses_name)
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense has been created!');
    }

    public function show(Expense $Expense)
    {

        return view('expense.show', [
            'Expense' => $Expense
        ]);
    }

    public function edit(Expense $Expense)
    {
        $expensescategories = ExpenseCategory::where('user_id', auth()->id())->get();
        return view('expense.edit', [
            'Expense' => $Expense,
            'expensescategories' => $expensescategories,
        ]);
    }

    public function update(ExpensesRequest $request, Expense $Expense)
    {
        $Expense->update([
            "user_id" => auth()->id(),
            "expenses_name" => $request->expenses_name,
            "expenses_date" => $request->expenses_date,
            "expenses_amount" => $request->expenses_amount,
            "expenses_notes" => $request->expenses_notes,
            "expenses_category_id" => $request->expenses_category_id,
            "slug" => Str::slug($request->expenses_name)
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Category has been updated!');
    }

    public function destroy(Expense $Expense)
    {
        $Expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Category has been deleted!');
    }
}
