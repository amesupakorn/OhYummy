<?php
class OrderController {
    private $conn;

    public function __construct() {
        session_start();
        include('connectToDatabase.php');
        $this->conn = new database();
    }

    public function addOrder($orderid ,$json_data) {
        // แปลง JSON เป็น associative array
        $data = json_decode($json_data, true);
        $menu_details = [];
        
        // วนลูปผ่านทุก order และเพิ่ม menuId และ menucount เข้าไปใน array
        foreach ($data['order'] as $order_item) {
            $menu_details[] = ['menuId' => $order_item['menuId'], 'menuCount' => $order_item['menuCount']];
        }
        
        $order_menu_json = json_encode(['order' => $menu_details]); // แปลง array เป็น JSON
        
        $sql = "INSERT INTO OrderTable (orderid, order_menu) VALUES ('$orderid', '$order_menu_json')";

        mysqli_query($this->conn->getDatabase(), $sql);
    }

    public function addOrderJson(){
        $orderData = array();

        // คิวรีเพื่อเลือกรายละเอียดการสั่งซื้อจากตาราง BasketOrder
        $sqlOrder = "SELECT * FROM BasketOrder WHERE tableId = $tableID";
        $resultOrder = mysqli_query($conn->getDatabase(), $sqlOrder);

        // ตรวจสอบว่ามีแถวที่ถูกส่งกลับจากคิวรีหรือไม่
        if ($resultOrder->num_rows > 0) {
            // วนลูปผ่านทุกแถวของผลลัพธ์
            while($row = $resultOrder->fetch_assoc()) {
                // นำ menuId และ menuCount เข้าไปในอาร์เรย์ $orderData
                $orderData[] = array(
                    "menuId" => $row['menuId'],
                    "menuCount" => $row['countMenu']
                );
            }
        }

        // สร้างสตริง JSON
        $json_data = array(
            "order" => $orderData // เพิ่มอาร์เรย์ $orderData เข้าไปใน key "order"
        );


        $order_menu_json = json_encode($json_data); // แปลง array เป็น JSON
        $num = mysqli_num_rows($conn->executeQuery("OrderTable"))+1;
        $sql = "INSERT INTO OrderTable(orderID, orderMenu, tableid, orderTime, orderStatus, orderTotal) VALUES ($num, '$order_menu_json', $tableID, CONVERT_TZ(NOW(),@@session.time_zone,'+07:00'), 'take', $total)";
    }


    
    public function getOrder($orderid) {
        $select_sql = "SELECT order_menu FROM OrderTable WHERE orderid = '$orderid'";
        $result = mysqli_query($this->conn->getDatabase(), $select_sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order_menu_json = $row['order_menu'];
                
                // แปลง JSON เป็น associative array
                $order_menu_data = json_decode($order_menu_json, true);
                
                if (isset($order_menu_data['order'])) {
                    $order_items = $order_menu_data['order'];
                    
                    foreach ($order_items as $order_item) {
                        echo "Menu ID: " . $order_item['menuId'] . ", Menu Count: " . $order_item['menuCount'] . "<br>";
                    }
                } else {
                    echo "No order data found.";
                }
            }
        } else {
            echo "0 results";
        }
    }

    public function updateOrder($orderid, $new_json_data) {
        $update_sql = "UPDATE OrderTable SET order_menu = '$new_json_data' WHERE orderid = '$orderid'";

        if (mysqli_query($this->conn->getDatabase(), $update_sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($this->conn->getDatabase());
        }
    }

    public function deleteOrderItem($orderid, $menuIdToDelete) {
        $select_sql = "SELECT order_menu FROM OrderTable WHERE orderid = '$orderid'";
        $result = mysqli_query($this->conn->getDatabase(), $select_sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $order_menu_json = $row['order_menu'];
            
            // แปลง JSON เป็น associative array
            $order_menu_data = json_decode($order_menu_json, true);

            foreach ($order_menu_data['order'] as $key => $order_item) {
                if ($order_item['menuId'] == $menuIdToDelete) {
                    unset($order_menu_data['order'][$key]);
                }
            }

            $new_order_menu_json = json_encode($order_menu_data);
            $update_sql = "UPDATE OrderTable SET order_menu = '$new_order_menu_json' WHERE orderid = '$orderid'";
            if (mysqli_query($this->conn->getDatabase(), $update_sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($this->conn->getDatabase());
            }
        } else {
            echo "No results found";
        }
    }
}