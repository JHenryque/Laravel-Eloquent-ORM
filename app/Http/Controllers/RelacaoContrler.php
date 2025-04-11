<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Phone;
use App\Models\Product;
use Illuminate\Http\Request;

class RelacaoContrler extends Controller
{
    public function index() {
        echo 'Eloquent Relação';
    }

    public function oneToOne() {
        //busca telefone do cliente
//        $client1 = Client::find(3)->phone;
//        echo "Telefone do cliente ID: " . $client1->client_id . " : " . $client1->phone_number . "<br>";

        //todos os dados do cliente eo telefone
//        $client2 = Client::find(12);
//        $phone = $client2->phone->phone_number;
//        echo "<br>";
//        echo "Nome do cliente: " . $client2->client_name ."<br>" ;
//        echo "Telefone do cliente: " . $phone ."<br>" ;
//        echo "<br>";

//        $client3 = Client::with('phone')->find(12);
//        echo "<br>";
//        echo "Nome do cliente: " . $client3->client_name ."<br>" ;
//        echo "Telefone do cliente: " . $client3->phone->phone_number ."<br>" ;
//        echo "<hr>";

        $clients = Client::with('phone')->get();
        foreach ($clients as $client) {
            echo "Nome do cliente: " . $client->client_name ."<br>";
            echo "Telefone do cliente: " . $client->phone->phone_number ."<br>";
            echo "<hr>";
        }
    }

    public function oneToMany() {
        // busca o id e o nome do cliente e todos os telefones dele
//        $client1 = Client::find(3);
//        $phones = $client1->phones;
//        echo "Nome do cliente: " . $client1->client_name ."<br>";
//        echo "Telefone dp cliente: <br>";
//        foreach ($phones as $phone) {
//            echo $phone->phone_number ."<br><hr>";
//        }
        // ourto foem e usando o metodo with()
//        $client2 = Client::with('phones')->find(2);
//        echo "Nome do cliente: " . $client2->client_name ."<br>";
//        echo 'Telefones: ';
//        foreach ($client2->phones as $phone) {
//            echo $phone->phone_number .", ";
//        }
//        echo "<hr>";
        //vamos buscar todos os clientes e os seus telefone
        $clients = Client::with('phones')->get();
        foreach ($clients as $client) {
            echo "Nome do cliente: " . $client->client_name ."<br>";
            echo 'Telefones do clientes: ';
            foreach ($client->phones as $phone) {
                echo $phone->phone_number .", ";
            }
            echo "<hr>";
        }
    }

    public function BelongsTo()
    {
        // neste metodo vamos pegar no telefone e descobir q que cliente pertence
//        $phone1 = Phone::find(4);
//        $client =  $phone1->client;
//        echo "Telefone:  " . $phone1->phone_number ."<br>";
//        echo "Nome do cliente: " . $client->client_name ."<br>";
        //outra forma é usando o metodo with
        $phone2 = Phone::with('client')->find(1);
        echo 'Telefone: '. $phone2->phone_number ."<br>";
        echo 'Cliente: '. $phone2->client->client_name ."<br>";
    }

    public function ManyToMany() {
        //buscar um cliente e todos os produtos que ele comprou
//        $client1 = Client::find(2);
//        $products = $client1->products;
//        echo "Cliente: " . $client1->client_name ."<br>";
//        echo "produtos: " . "<br>";
//        foreach ($products as $product) {
//            echo $product->product_name . "<br>";
//        }

        //buscar um cliente e todos os produtos que ele comprou
        $product1 = Product::find(2);
        $clients = $product1->clients;
        echo "Cliente: " . $product1->product_name ."<br>";
        echo "produtos: " . "<br>";
        foreach ($clients as $client) {
            echo $client->client_name . "<br>";
        }

    }

    public function RunningQueries()
    {
//        // vamos buscar um cliente e ps seus telefones, mas só queremos os telefones que começa po 8
//        $client1 = Client::find(1);
//        $phones = $client1->phones()->where('phone_number', 'like', '8%')->get();
//        echo "Cliente: " . $client1->client_name ."<br>";
//        echo "telefones: <br>";
//        foreach ($phones as $phone) {
//            echo $phone->phone_number .", ";
//        }

        // buscar todos os produtos que um cliente comoru, mas os produtos que custam mais de 50
//        $client2 = Client::find(1);
//        $products = $client2->products()->where('price', '>', 50)->orderBy('product_name')->get();
//        echo "Cliente: " . $client2->client_name ."<br>";
//        echo "Produtos: <br>";
//        foreach ($products as $product) {
//            echo $product->product_name ." - " . $product->price ."<br>";
//        }

        // vao apatecer produtos repetidos. Para evitar isso, podemos usar o metodo distinct() e vamos ordenar os produtos em  ordem alfabetica do nome
        $client2 = Client::find(1);
        $products = $client2->products()->where('price', '>', 50)->distinct()->orderBy('product_name')->get();
        echo "Cliente: " . $client2->client_name ."<br>";
        echo "Produtos: <br>";
        foreach ($products as $product) {
            echo $product->product_name ." - " . $product->price ."<br>";
        }
//        dd([
//            $client1->toArray(),
//            $phones->toArray()
//        ]);

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
