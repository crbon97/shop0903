<?php
include_once 'Controller.php';
include_once 'model/DetailModel.php';
include_once 'helper/Cart.php';
session_start();

class CartController extends Controller{

    function loadShoppingCart(){
        return $this->loadView('shopping-cart');
    }

    function addToCart(){
        $id = $_POST['id'];
        $qty =  isset($_POST['qty']) ? (int)$_POST['qty'] : 1;
        $model = new DetailModel;
        $product = $model->selectProductById($id);
        
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$qty);
        $_SESSION['cart'] = $cart;
        echo $cart->items[$id]['item']->name;
    }
}



?>