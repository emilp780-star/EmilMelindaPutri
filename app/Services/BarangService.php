<?php
namespace App\Services;
use App\Models\Barang;

class BarangService {
    public function tambah($data) {
        return Barang::create($data);
    }
}