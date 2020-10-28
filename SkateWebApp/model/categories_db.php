<?php
    //get Categories on Search Page
    function get_categories(){
        
        global $db;
    
        $query = 'SELECT * FROM categories
                    ORDER BY category_ID';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        
        return $categories;
    }
    
    //get Names of Categories on Search Categories Page
    function get_category_name($category_id){
        
        global $db;

        $query = 'SELECT * FROM categories
                    WHERE category_ID = :category_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();
        $categoryName = $category['category_Name'];

        return $categoryName;
    }
?>