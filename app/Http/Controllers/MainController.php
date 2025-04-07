<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TesteModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {

//        $products = TesteModel::all()->toArray();
//        echo "<pre>";
//        print_r($products);

        // buscar todos os dados dos produtos
//        $results = Product::all(); //-> SELECT * FROM products

        // resultado sera o array em string
        //$results = Product::all()->toArray();

        // retornar os resultados como um array do objetos stdClass
        //$products = $this->arrayOfObject(Product::all()->toArray());


        // buscar produtos ordenados pelo nome alfabetico
        //$products = Product::orderBy('product_name')->get()->toArray();

        // buscar os 3 primeiro produtos
        $products = Product::limit(3)->get()->toArray();

        // buscar um produto pelo id
        $products = Product::find(10)->toArray();
        $this->showData($products);
    }

    private function showData($product) {
        echo "<pre>";
        print_r($product);
    }

    private function arrayOfObject($products) {
        $temp = [];
        foreach ($products as $key => $product) {
            $temp[] = (object) $product;
        }
        return $temp;
    }
}
