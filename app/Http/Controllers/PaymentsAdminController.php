<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payments;

class PaymentsAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Admin Dashboard Payments',
            'payments' => Payments::select('id', 'user_id', 'name', 'amount', 'status', 'created_at')->get()
        ]);
    }

    public function payment_approve(Request $request, $id)
    {
        $payments = Payments::find($id);
        if (empty($payments)) return back()->with('error', 'pembayaran tidak ditemukan');
        $payments->status = 1;
        $payments->update();
        return back()->with('success', 'pembayaran berhasil diapprove');
    }
}
