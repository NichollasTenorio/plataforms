<?php
declare(strict_types=1);
require_once "../../common.php";
?>

<?php

class Client
{
    private array $productsList = []; 

    public function __construct(
        private string $clientName,
        private string $clientEmail,
        // private string $clientAddress
    )
    {}

    public function getProductsList()
    {
        return $this->productsList;
    }    

    public function setClientName(string $clientName):void
    {
        $this->clientName = $clientName;
    }

    public function getClientName():string
    {
        return $this->clientName;
    }

    public function setClientEmail(string $clientEmail):void
    {
        $this->clientEmail = $clientEmail;
    }

    public function getClientEmail():string
    {
        return $this->clientEmail;
    }

    public function addProduct(Product $requestProduct)
    {
        $this->productsList[] = $requestProduct;
        return;
    }

    public function placeOrder()
    {
        if(!empty($this->productsList)){
            $newOrder = new Order($this, $this->getProductsList());
            return $newOrder;
        }else{
            throw new Exception('Sem Produtos selecionados');
        }
    }

    public function productsFullReport():void
    {
        if(!empty($this->productsList)){
            echo "<strong>Pedidos:</strong> <br>";
            foreach($this->productsList as $reportProducts){
                echo $reportProducts->getProductName()  . "<br/>";
            }            
        }else{
            throw new Exception('Sem Produtos selecionados');
        }

    }
}

class Product
{
    public function __construct(
        private string $productName,
        private string $productCategory,
        private float $productValue
    )
    {}

    public function setProductName(string $productName):void
    {
        $this->productName = $productName;
    }

    public function getProductName():string
    {
        return $this->productName;
    }
    
    public function setProductCategory(string $productCategory):void
    {
        $this->productCategory = $productCategory;
    }

    public function getProductCategory():string
    {
        return $this->productCategory;
    }
    public function setProductValue(float $productValue):void
    {
        $this->productValue = $productValue;
    }

    public function getProductValue():float
    {
        return $this->productValue;
    }

}

class Order
{
    public function __construct(
        private Client $client,
        private array $products
    )
    {}

    public function getTotal():float
    {
        return array_reduce($this->products, fn($carry, $p) => $carry + $p->getProductValue(), 0.0);
    }

    public function getFormattedTotal():string
    {
        $valor = $this->getTotal();
        
        return "R$ " . number_format($valor, 2, ',', '.');
    }    
    
    public function generateFullReport():void
    {
        echo "<strong>Cliente:</strong> {$this->client->getClientName()} <br/><br/>";
        echo "<strong>Lista do Pedido:</strong> <br>";
        foreach($this->products as $reportProducts){
            $price = number_format($reportProducts->getProductValue(), 2, ',', '.');
            echo "{$reportProducts->getProductName()} | R$ {$price} <br>";
        }

        echo "<br><strong>Total do Pedido: {$this->getFormattedTotal()}</strong>";
    }
}

$firstProduct = new Product(
    'X-Salada',
    'Lanches',
    25.90
);

$secondProduct = new Product(
    'Refri sabor cola 600ml',
    'Bebidas',
    6.00
);

$thirdProduct = new Product(
    'Batata Frita Média',
    'Acompanhamentos',
    12.50
);

$fourthProduct = new Product(
    'Milkshake de Chocolate 400ml',
    'Sobremesas',
    18.90
);

$fifthProduct = new Product(
    'Brownie com Sorvete',
    'Sobremesas',
    15.00
);

$firstClient = new Client(
    'Nichollas Tenório',
    'nichollas.tenorio.sj@gmail.com'
);

$firstClient->addProduct($firstProduct);
$firstClient->addProduct($secondProduct);
$firstClient->addProduct($thirdProduct);
$firstClient->addProduct($fourthProduct);
$firstClient->addProduct($fifthProduct);

$firstOrder = $firstClient->placeOrder();
$firstOrder->generateFullReport();
