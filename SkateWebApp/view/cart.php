<?php

    function addItem($key, $quantity, $products){

        if ($quantity < 1){
            return;
        }
        if(isset($_SESSION['cart'][$key])){
            $quantity += $_SESSION['cart'][$key]['qty'];
            update_Quantity($key, $quantity);
            return;
        }

        $cost = $products['product_Price'];
        $total = $cost * $quantity;
        $item = array(
            'company'       => $products['company_Name'],
            'productName'   => $products['product_Name'],
            'qty'           => $quantity,
            'cost'          => $cost,
            'total'         => $total
        );
        $_SESSION['cart'][$key] = $item;
    }

    function update_Quantity($key, $quantity){

        $quantity = (int) $quantity;
        if (isset($_SESSION['cart'][$key])){
            
            if ($quantity <= 0){

                unset($_SESSION['cart'][$key]);
            }
            else {

                $_SESSION['cart'][$key]['qty'] = $quantity;
                $total = $_SESSION['cart'][$key]['cost'] *
                        $_SESSION['cart'][$key]['qty'];
                $_SESSION['cart'][$key]['total'] = $total;
            }
        }
    }

    function subTotal(){
        $subTotal = 0;
        foreach ($_SESSION['cart'] as $item){
            
            $subTotal += $item['total'];
        }

        $finalTotal = number_format($subTotal, 2);

        return $finalTotal;
    }


?>