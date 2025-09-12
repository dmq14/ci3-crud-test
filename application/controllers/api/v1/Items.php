<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Items extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_model');
    }

    // GET /api/items or /api/items/{id}
    public function item_get($id = null)
    {
        if ($id === null) {
            $items = $this->Item_model->get_all();
            $this->response(['status' => true, 'data' => $items], RestController::HTTP_OK);
        } else {
            $item = $this->Item_model->get($id);
            if ($item) {
                $this->response(['status' => true, 'data' => $item], RestController::HTTP_OK);
            } else {
                $this->response(['status' => false, 'message' => 'Item not found'], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    // POST /api/items
    public function item_post()
    {
        $input = $this->post();

        if (empty($input['title'])) {
            $this->response(['status' => false, 'message' => 'Title is required'], RestController::HTTP_BAD_REQUEST);
            return;
        }

        $data = [
            'title' => $input['title'],
            'description' => $input['description'] ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $id = $this->Item_model->insert($data);
        $this->response(['status' => true, 'message' => 'Item created', 'id' => $id], RestController::HTTP_CREATED);
    }

    // PUT /api/items/{id}
    public function item_put($id)
    {
        $input = $this->put();

        $item = $this->Item_model->get($id);

        if (!$item) {
            $this->response(['status' => false, 'message' => 'Item not found'], RestController::HTTP_NOT_FOUND);
            return;
        }

        if (empty($input['title'])) {
            $this->response(['status' => false, 'message' => 'Title is required'], RestController::HTTP_BAD_REQUEST);
            return;
        }

        $data = [
            'title' => $input['title'],
            'description' => $input['description'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->Item_model->update($id, $data);
        $this->response(['status' => true, 'message' => 'Item updated'], RestController::HTTP_OK);
    }

    // DELETE /api/items/{id}
    public function item_delete($id)
    {
        $item = $this->Item_model->get($id);
        
        if (!$item) {
            $this->response(['status' => false, 'message' => 'Item not found'], RestController::HTTP_NOT_FOUND);
            return;
        }
        $this->Item_model->delete($id);
        $this->response(['status' => true, 'message' => 'Item deleted'], RestController::HTTP_OK);
    }
}
