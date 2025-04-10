<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
