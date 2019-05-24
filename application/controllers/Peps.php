<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Products extends Admin_Controller 
    {
        public function fetchPepsData() {
            $result = array('data' => array());

            $data = $this->model_products->getPepsData();

            foreach ($data as $key => $value) {

                $result['data'][$key] = array(
                    $img,
                    $value['sku'],
                    $value['name'],
                    $value['price'],
                    $value['qty'] . ' ' . $qty_status,
                    $store_data['name'],
                    $availability,
                    $buttons
                );

            }
        }
    }
?>