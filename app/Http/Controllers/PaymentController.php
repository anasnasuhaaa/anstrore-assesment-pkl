<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payment = DB::table('payments')->get();
        return view('admin.payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg'
            ]);
            // Create Image file name and move to Public Path
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/payment'), $filename);

            $data = [
                'name' => $request->input('name'),
                'image' => $filename
            ];

            DB::table('payments')->insert($data);

            return redirect()->route('admin.payment.index')->with('success-added', "$request->name berhasil ditambahkan");
        } catch (Throwable $caugh) {
            dd($caugh);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $payment = DB::table('payments')->find($id);
        return view('admin.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $payment = DB::table('payments')->find($id);
            $request->validate([
                'name' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg'
            ]);

            $data = [
                'name' => $request->input('name'),
            ];

            if ($request->hasFile('image')) {
                // Create Image file name and move to Public Path
                $filename = time() . '.' . $request->image->extension();
                $request->image->move(public_path('img/payment'), $filename);
                // Delete old image
                if (file_exists(public_path('img/payment/' . $payment->image))) {
                    unlink(public_path('img/payment/' . $payment->image));
                }
                // Update Image
                $data['image'] = $filename;
            }

            DB::table('payments')->where('id', $id)->update($data);

            return redirect()->route('admin.payment.index')->with('success-updated', 'Payment Berhasil diupdate');
        } catch (Throwable $caugh) {
            dd($caugh);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $payment = DB::table('payments')->find($id);
            if (file_exists(public_path('img/payment/' . $payment->image))) {
                unlink(public_path('img/payment/' . $payment->image));
            }
            DB::table('payments')->where('id', $id)->delete();
            return redirect()->route('admin.payment.index')->with('success-deleted', "$payment->name berhasil dihapus");
        } catch (Throwable $caugh) {
            dd($caugh);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
