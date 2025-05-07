<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::paginate(10);
        return view('dashboard.transactions.index', compact('transactions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.transactions.show', ['transaction' => Transaction::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.transactions.edit', ['transaction' => Transaction::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        $transaction->updated_at = now();
        $transaction->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return back();
    }

    // filter function
    public function filter(Request $request)
    {
        $query = Transaction::query();

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search Keyword filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                    ->orWhere('booking_id', 'like', '%' . $request->search . '%')
                    ->orWhere('transaction_type', 'like', '%' . $request->search . '%')
                    ->orWhere('amount', 'like', '%' . $request->search . '%')
                    ->orWhere('status', 'like', '%' . $request->search . '%')
                    ->orWhere('payment_method', 'like', '%' . $request->search . '%');
            });
        }

        // Sort filter
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'amount':
                    $query->orderBy('amount', 'desc');
                    break;
                default:
                    break;
            }
        }

        $transactions = $query->paginate(10);

        return view('dashboard.transactions.index', compact('transactions'));
    }
}
