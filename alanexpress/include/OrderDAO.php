<?php

class OrderDAO {

    public function add($order) {
        // insert into order db
        $sql = 'insert into orders (customer_id) values (:customer_id)';
        
        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

        $stmt->bindParam(':customer_id', $order->customerId, PDO::PARAM_STR);
        
        $isAddOK = False;
        if ($stmt->execute()) {
          $isAddOK = True;
          // obtain autoincrement order id from successful insert
          $order->id = $conn->lastInsertId();
          foreach ($order->cartItems as $cartItem) {
            $sql = 'insert into order_items (order_id, book_id, quantity) values (:order_id, :book_id, :quantity)';
            
            $stmt = $conn->prepare($sql); 

            $stmt->bindParam(':order_id', $order->id, PDO::PARAM_INT);
            $stmt->bindParam(':book_id', $cartItem->isbn13, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $cartItem->quantity, PDO::PARAM_STR);
            
            $isAddOK = False;
            if ($stmt->execute()) {
                $isAddOK = True;
            }
          }

        } // if insert into order successful
        return $isAddOK;
    }


    // not implemented as yet
/*

    public  function retrieveAll() {
        $sql = 'SELECT * FROM orders';
        
            
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch()) {
            $result[] = new Order($row['id'], $row['customer_id']);
        }
            
                 
        return $result;
    }
  
    public  function retrieve($isbn13) {
        $sql = 'select title, isbn13, price from orders where isbn13=:isbn13';
        $result = array();
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':isbn13', $isbn13, PDO::PARAM_STR);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new Order($row['title'], $row['isbn13'], $row['price']);
        }
        
        return $result;
    }
  
  
    
    public function modify($order) {
        $sql = 'update orders set title=:title, price=:price where isbn13=:isbn13';      
        
        $connMgr = new ConnectionManager();           
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':title', $order->title, PDO::PARAM_STR);
        $stmt->bindParam(':isbn13', $order->isbn13, PDO::PARAM_STR);
        $stmt->bindParam(':price', $order->price, PDO::PARAM_STR);
        
        $stmt->execute();
        
    }
    
        
    public function remove($isbn13) {
        $sql = 'delete from orders where isbn13=:isbn13';
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':isbn13', $isbn13, PDO::PARAM_STR);
        
        $stmt->execute();
        $count = $stmt->rowCount();
    }

    */
} // class OrderDAO



?>
