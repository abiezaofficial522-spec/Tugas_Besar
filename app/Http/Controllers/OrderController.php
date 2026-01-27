<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pacar;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrderForm($pacar_id)
    {
        $pacar = Pacar::findOrFail($pacar_id);
        return view('formorder.order', compact('pacar'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'nama_pasangan' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_wa' => 'required|string|max:20',
            'pacar_id' => 'required|integer|exists:pacars,id',
            'order_date' => 'required|date',
            'status' => 'required|string',
        ]);

        Order::create([
            'nama_pasangan' => $request->nama_pasangan,
            'email' => $request->email,
            'nomor_wa' => $request->nomor_wa,
            'pacar_id' => $request->pacar_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
        ]);

        return redirect('/')->with('success', 'Pemesanan berhasil!');
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'nama_pasangan' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_wa' => 'required|string|max:20',
            'pacar_id' => 'required|integer|exists:pacars,id',
            'order_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'nama_pasangan' => $request->nama_pasangan,
            'email' => $request->email,
            'nomor_wa' => $request->nomor_wa,
            'pacar_id' => $request->pacar_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Order berhasil diupdate!']);
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['success' => true, 'message' => 'Order berhasil dihapus!']);
    }
}
