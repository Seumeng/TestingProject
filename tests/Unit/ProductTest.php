<?php

use PHPUnit\Framework\TestCase;

    use App\Product;

    class ProductTest extends TestCase
    {
        protected $product;

        public function setUp() :void
        {
            $this->product=new Product('Testing 4',50);
        }
        function testProductHasName(){
            // $product =new Product('testing');
            $product=new Product('Testing 4',50);
            $this->assertEquals('Testing 4',$this->product->name());
        }

        function testProductHasCost(){
            // $product =new Product('testing');

            $product=new Product('Testing 4',50);
            $this->assertEquals('50',$this->product->cost());
        }
    }