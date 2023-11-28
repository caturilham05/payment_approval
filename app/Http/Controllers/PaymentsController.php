<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('public.dashboard', [
            'title'   => 'public Dashboard',
            'navbar'  => 'Payments',
            'user'    => $user,
            'payments' => Payments::select('id', 'user_id', 'name', 'amount', 'status', 'created_at')->where('user_id', $user->id)->get() ?? '',
        ]);
    }

    public function payment_add(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:10000',
        ], [
            'amount.required' => 'Nominal pembayaran tidak boleh 0',
            'amount.min'      => 'Nominal pembayaran minimal 10000',
        ]);

        $user = Auth::user();

        $datas[] = [
            'user_id'    => $user->id,
            'name'       => $user->name,
            'amount'     => $request->amount,
            'status'     => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $insert = Payments::insert($datas);

        return $insert ? redirect()->route('public.dashboard')->with(['success' => 'Data payment berhasil ditambahkan']) : redirect()->route('public.dashboard')->with(['error' => 'Data payment gagal ditambahkan']);
    }
}
