<?php
    require('../model/database.php');
    require('../model/categories_db.php');
    require('../model/products_db.php');
    
    $sessionTime = 60*60*24;//24hours
    session_set_cookie_params($sessionTime, '/');
    session_start();
    //initialize session cart if its empty
    if (empty($_SESSION['cart'])){

        $_SESSION['cart'] = array();
    }

    require_once('cart.php');

    //intialize view to list_products
    $action = filter_input(INPUT_POST, 'action');
    if ($action == null) {

        $action = filter_input(INPUT_GET, 'action');
            if ($action == NULL){
                
                $action ='list_products';
            }
    }

    //first view
    switch($action){

        case 'list_products':

        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        if ($category_id == NULL || $category_id == FALSE){

            $category_id = 1;
        }

        //echo $category_id;
        $categories = get_categories();
        //echo "\n" . count($categories);
        $categoryName = get_category_name($category_id);  

        //set the order of items
        if (isset($_GET['sort'])){

            $sort = $_GET['sort'];
        }
        else {

            $sort = FALSE;
        }
        //change order of items
        switch($sort){

            case FALSE:
                $sort = TRUE;
                break;
            case TRUE:
                $sort = FALSE;
                break;
            default:
                $sort = FALSE;
        }

        //set page number
        if (isset($_GET['pageNum'])){
            
            $pageNum = $_GET['pageNum'];
        } 
        else {

            $pageNum = 1;
        }
        
        $numOfRows = get_Number_Of_Rows($category_id);
        $items_Per_Page = 8;
        $totalPages = ceil($numOfRows/$items_Per_Page);
        $products = get_products_by_category($category_id, $items_Per_Page, $pageNum, $sort);
        //echo $totalPages;



        include('product_shop.php');
        break;
        
     case 'view_product':

        $product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
        if ($product_id == NULL || $product_id == FALSE){

            $ERROR = "Incorrect Product ID";
            //FIX ME create error message(html)
        }
        else {

            $categories = get_categories();
            $product = get_product($product_id);

            //retrieve data for single product view
            $id             = $product['category_ID'];
            $code           = $product['product_ID'];
            $companyName    = $product['company_Name'];
            $name           = $product['product_Name'];
            $price          = $product['product_Price'];
            $image          = $product['product_Image'];
            
            //echo $id;
            
            if ($id == 1){
            
                $imageResize = '<img src="data:image/png;base64,'.base64_encode($image).'"width="250"height="500" >';
            }
            else{

                $imageResize = '<img src="data:image/png;base64,'.base64_encode($image).'"width="550"height="550" >';
            }
            
            include('product_View.php');
            break;
        }

     case 'cart_View':

        $userItem = filter_input(INPUT_POST, 'addProduct', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        if ($userItem == NULL || $userItem == FALSE){

            $ERROR = "Incorrect Product ID";
            //FIX ME create error message(html)
        } else if($quantity == NULL || $quantity == FALSE){
            $quantity = 1;
        }
       //echo $userItem;

        $products = get_product($userItem);
        
        addItem($userItem, $quantity, $products);
        
        include('product_cart.php');
        break;

     case 'update':

        $newQuantity = filter_input(INPUT_POST,'newquantity',FILTER_DEFAULT,
                                        FILTER_REQUIRE_ARRAY);
        foreach($newQuantity as $key => $qty){

            if ($_SESSION['cart'][$key]['qty'] != $qty){
                
                update_Quantity($key, $qty);
            }
        }

        include('product_cart.php');
        break;
    
     case 'empty_cart':
        
            unset($_SESSION['cart']);
            include('product_cart.php');
            break;

    case 'checkout':
        
        include('product_checkout.php');
        unset($_SESSION['cart']);
        break;
    }

    


?>