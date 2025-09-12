<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

    private $table = 'items';

    public function __construct()
    {
        parent::__construct();
    }

    // get all items
    public function get_all()
    {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }

    // get item by id
    public function get($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    // create item
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // update item
    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    // delete item
    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
