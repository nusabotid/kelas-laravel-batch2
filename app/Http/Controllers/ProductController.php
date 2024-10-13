<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function rootPage()
    {
        return view('welcome');
    }

    public function index()
    {
        // $title = request('title', 'Tidak ada judul');
        // $desc = request('desc', 'Tidak ada deskripsi');

        // echo "Judul Halaman: $title";
        // echo "<br />";
        // echo "Deskripsi: $desc";
        // $products = DB::table('products')
        //     ->select('id', 'name', 'price', 'stock', 'description')
        //     ->where('stock', '>=', 10)
        //     ->orderBy('id', 'desc')
        //     ->get();

        $products = Product::select('id', 'name', 'price', 'stock', 'description')
            ->where('stock', '>', 10)
            ->orderBy('id', 'desc')
            ->get();

        return $products;
    }

    public function getDetail($id)
    {
        // echo "Ini Produk dengan ID = $id";

        $product = Product::find($id);

        return $product;
    }

    public function store(Request $request)
    {
        $product = [
            "name" => $request->input('name') ?? '',
            "price" => (int) $request->input('price') ?? 0,
            "stock" => (int) $request->input('stock') ?? 0,
            "description" => $request->input('description'),
        ];

        // DB::table('products')->insert($product);
        Product::create($product);

        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = [
            "name" => $request->input('name') ?? '',
            "price" => (int) $request->input('price') ?? 0,
            "stock" => (int) $request->input('stock') ?? 0,
            "description" => $request->input('description'),
        ];

        // DB::table('products')->where('id', $id)->update($product);
        Product::where('id', $id)->update($product);

        return $product;
    }

    public function delete($id)
    {
        // DB::table('products')->where('id', $id)->delete();
        $product = Product::where('id', $id);

        $selectedProduct = $product->first();

        $product->delete();

        return $selectedProduct;
    }
}
