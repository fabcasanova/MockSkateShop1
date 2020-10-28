<?php
    
    function get_Number_Of_Rows($category_id){

        global $db;

        $query = 'SELECT * FROM products
                    WHERE products.category_ID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $numOfRows = $statement->rowCount();
        $statement->closeCursor();
        
        return $numOfRows;
    }


    function get_products_by_category($category_id, $items_Per_Page, $pageNum, $sort){

        global $db;
        if ($sort == FALSE){
        
            $viewOrder = 'DESC';
        }
        else if ($sort == TRUE){

            $viewOrder = 'ASC';
        }

        $offSet = ($pageNum - 1) * $items_Per_Page;
        
        $query = "SELECT * FROM products
                    WHERE products.category_ID = :category_id
                    ORDER BY product_Price $viewOrder
                    LIMIT $offSet, $items_Per_Page";
                    
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        
        return $products;
    }

    function get_product($product_id){

        global $db;

        $query = 'SELECT * FROM products
                    WHERE product_ID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $product = $statement->fetch();
        $statement->closeCursor();
        
        return $product;
    }

    function delete_product($product_ID){

        global $db;

        $query = 'DELETE * FROM 
                    WHERE products_ID = :product_ID';
        $statement = $db->prepare($query);
        $statement->bindValue('product_ID', $product_ID);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function add_product($product_ID){}

?>