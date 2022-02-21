<?php
//get all products
function getAllProducts($db)
{
$sql = 'Select p.title, p.category, p.price, p.brand from products p ';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by id
function getProduct($db, $productId)
{
$sql = 'Select p.title, p.category, p.price, p.brand from products p ';
$sql .= 'Where p.id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $productId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new product
function createProduct($db, $form_data) {
    $sql = 'Insert into products (title, category, price, brand)';
    $sql .= 'values (:title, :category, :price, :brand)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':title', $form_data['title']);
    $stmt->bindParam(':category', $form_data['category']);
    $stmt->bindParam(':price', ($form_data['price']));
    $stmt->bindParam(':brand', ($form_data['brand']));
    $stmt->execute();
    return $db->lastInsertID(); //insert last number.. continue
    }

//delete product by id
function deleteProduct($db,$productId) {
    $sql = ' Delete from products where id = :id';
    $stmt = $db->prepare($sql);
    $id = (int)$productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    }
    
//update product by id
function updateProduct($db,$form_dat,$productId) {
    $sql = 'UPDATE products SET title = :title , category = :category , price = :price , brand = :brand ';
    $sql .=' WHERE id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int)$productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $form_dat['title']);
    $stmt->bindParam(':category', $form_dat['category']);
    $stmt->bindParam(':price', ($form_dat['price']));
    $stmt->bindParam(':brand', ($form_dat['brand']));
    $stmt->execute();
    }