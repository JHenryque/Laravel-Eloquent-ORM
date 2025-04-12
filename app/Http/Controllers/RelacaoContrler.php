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

    public function SameResults() {
        //vamos buscar os mesmos resultados, mas sem usar as relaçoes e um cliente e os seus telefones
//        $client1 = Client::find(1);
//        $phone = Phone::where('client_id', $client1->id)->get();
//        echo "Cliente: " . $client1->client_name ."<br>";
//        echo "Telefone: <br>";
//        foreach ($phone as $phone) {
//            echo $phone->phone_number ."<br>";
//        }
        // vamos buscar todos os produtos que um cliente comprou
        $client2 = Client::find(1);
        $products = Product::join('orders', 'products.id', '=', 'orders.product_id')->where('orders.client_id', '=', $client2->id)->get();
        echo "Cliente: " . $client2->client_name ."<br>";
        echo "Produtos: <br>";
        foreach ($products as $product) {
            echo $product->product_name ." - " . $product->price ."<br>";
        }
    }

    public function Collections() {
//        $clients = Client::take(5)->get();
//        foreach ($clients as $client) {
//            echo "Nome do cliente: " . $client->client_name ."<br>";
//        }
        //APPEND
        $clients = Client::take(5)->get();
        $clients->each->append(['client_name_uppercase', 'email_domain']);
        foreach ($clients as $client) {
            $client->client_name_uppercase = strtoupper($client->client_name);
            $client->email_domain = explode('@', $client->email)[1];
        }

        foreach ($clients as $client) {
          echo  $client->client_name . ' - ' . $client->client_name_uppercase . ' - ' . $client->email_domain . '<br>';
        }
        // CONTAINS
        $clients = Client::take(5)->get();
        $result = $clients->contains('client_name', 'Laura Teresa Nunes');
        var_dump($result);

        //DIFF
        $client1 = Client::take(5)->get();
        $client2 = Client::take(3)->get();
        $result = $client1->diff($client2)->toArray();
        $this->showData($result);

        // INTERSECT
        $client1 = Client::take(5)->get();
        $client2 = Client::where('id', '>', 3)->take(5)->get();
        $result = $client1->intersect($client2)->toArray();
        $this->showData($result);

        echo '<hr>';

        // MAKEHIDDEN
        $clients = Client::take(5)->get();
        $clients->makeHidden(['id', 'active', 'deleted_at']); // ele remove as chaves quando estar declarado, no mentodo dentro dos argumentos de uma array
        $this->showData( $clients->toArray());

    }

    public function Serializacao() {
//        $clients = Client::take(5)->get()->toArray();
//        $this->showData( $clients);
//        echo '<hr>';
//        $clients = Client::take(3)->get()->toJson(JSON_PRETTY_PRINT);
//        echo '<pre>';
//        print_r($clients);

//        $client1 = Client::take(10)
//                            ->get()
//                            ->setHidden(['id', 'active', 'deleted_at'])
//                            ->toJson(JSON_PRETTY_PRINT);
//        $this->showData( $client1);

        $client1 = Client::take(10)
            ->get()
            ->setVisible(['id', 'active', 'deleted_at', 'created_at', 'updated_at'])
            ->toJson(JSON_PRETTY_PRINT);
        $this->showData( $client1);

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
