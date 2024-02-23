<?php
    // การเรียกใช้งาน
    include('orderController.php');
    $order = new OrderController();

    // $order->addOrder(2, '{
    //     "order": [
    //         {
    //             "menuId": 1,
    //             "menuCount": 2
    //         },
    //         {
    //             "menuId": 2,
    //             "menuCount": 3
    //         }
    //     ]
    // }');

    $order->getOrder(2);

    // $order->updateOrder(2, '{
    //     "order": [
    //         {
    //             "menuId": 1,
    //             "menuCount": 4
    //         },
    //         {
    //             "menuId": 2,
    //             "menuCount": 5
    //         }
    //     ]
    // }');

    // $order->deleteOrderItem(2, 2);
    ?>
