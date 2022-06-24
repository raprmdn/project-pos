<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Product::all();

        // $products = DB::table('products')
        //     ->join('categories', 'categories.id', '=', 'products.category_id')
        //     ->join('units', 'units.id', '=', 'products.unit_id')
        //     ->select('products.barcode','products.name', 'categories.name AS kategori', 'units.name AS unit','products.stock','products.price', 'products.description')
        //     ->get();

        // dd($products);
        $products = Product::with(['unit', 'category'])->latest()->get();
        return $products;

    }

    //buat judul kolom di excel
    public function headings(): array
    {
        return ["Barcode","Nama Produk", "Kategori Produk", "Unit", "Stok","Harga","Deskripsi", "Created At"];
    }

    public function map($row): array
    {
        return [
            $row->barcode,
            $row->name,
            $row->category->name,
            $row->unit->name,
            $row->stock,
            'Rp. ' . Helper::rupiahFormat($row->price),
            $row->description,
            $row->created_at->format('d F Y, H:i'),
        ];
    }
}
