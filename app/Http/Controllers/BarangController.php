<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangController extends Controller {
    protected $barangService;

    public function __construct(BarangService $service) {
        $this->barangService = $service;
    }

    // FUNGSI TAMBAH (Dengan Validasi & Error Handling)
    public function store(Request $request) {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|numeric'
        ]);

        try {
            $this->barangService->tambah($request->all());
            return response()->json(['message' => 'Data berhasil ditambah!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function index() { return Barang::all(); } // Tampil Data
    
    public function update(Request $request, $id) {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return "Data diperbarui!";
    }

    public function destroy($id) {
        Barang::destroy($id);
        return "Data dihapus!";
    }
}