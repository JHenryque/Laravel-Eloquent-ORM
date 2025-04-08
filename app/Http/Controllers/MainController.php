<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TesteModel;
use Carbon\Carbon;
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

        // buscar produtos por valor maior ou igual
        $products = Product::where('price', '>=', 70)->get()->toArray();

        //buscar apenas o primeiro resultado
        $products = Product::where('price', '>=', 70)->first()->toArray();

        //buscar apenas o primeiro alelmento se ele existir, caso contrario retorna array vazio
        $products = Product::where('price', '>=', 90)->firstOr(function (){
            echo 'Não exister';
            // ou podera fazer um array com retorno []; sera a mesma coisa
        });

        //$this->showData($products);

//        $products = Product::find(10);
//        echo $products->price; // valor db
//        echo '<br>';
//        echo $products->price = 200; // definir numero novo preço apenas no codigo (nao na db"
//        echo '<br>';
//        $products->refrech(); // vaolta a recuperar o preço original da db
//        echo '<br>';

        // buscar o nome e um preço é maior ou igual a o valor
        $products = Product::firstWhere('price', '>=', 90)->first();
        //echo $products->product_name . ' tem um preço de ' . $products->price . '<br>';

        // buscar um valor, se ele existe a logica vai aparece se nao exister vai aparecer uma message
//        $products = Product::findOr(910, function (){
//            echo  "Não foi encrontrado o produto desejado!";
//        });
//
//        if ($products) {
//            echo $products->product_name . ' tem um preço de ' . $products->price . '<br>';
//        }

//        $total_products = Product::count();
//        $product_max_price = Product::max('price');
//        $product_min_price = Product::min('price');
//        $product_avg_price = Product::avg('price');
//        $product_sun_price = Product::sun('price');
//
//        $result = [
//            'total_products' => $total_products,
//            'product_max_price' => $product_max_price,
//            '$product_min_price' => $product_min_price,
//            '$product_avg_price' => $product_avg_price,
//            'product_sun_price' => $product_sun_price,
//        ];
//
//        $this->showData($result);

        // insirir novo produto na table products DB
//        $new_product = new Product();
//        $new_product->product_name = "Jaca mole";
//        $new_product->price = 50;
//        $new_product->save();

// deu erro Add [product_name] to fillable property to allow mass assignment on [App\Models\Product].
//        Product::create([
//            "product_name" => 'Jaca',
//            "price" => 60,
//        ]);

        Product::insert([
            [
                "product_name" => 'produto 1',
                "price" => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "product_name" => 'produto 2',
                "price" => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "product_name" => 'produto 3',
                "price" => 60,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

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
