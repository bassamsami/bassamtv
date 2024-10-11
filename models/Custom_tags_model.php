<?php
class Custom_tags_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Check
    public function is_avaliable($conditions)
    {
        $t = $this->db->where($conditions)->count_all_results('custom_tags');
        return ($t > 0);
    }

    // Create
    public function insert_tag($name, $background_color, $text_color) {
        $data = array(
            'name' => $name,
            'background_color' => $background_color,
            'text_color' => $text_color,
            'created_at' => time(),
            'updated_at' => time()
        );

        $this->db->insert('custom_tags', $data);
        return $this->db->insert_id();
    }

    // Read
    public function get_all_tags() {
        $query = $this->db->get('custom_tags');
        return $query->result();
    }

    // Read Single
    public function get_tag($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('custom_tags');
        return $query->row();
    }

    // Update
    public function update_tag($id, $name, $background_color, $text_color) {
        $data = array(
            'name' => $name,
            'background_color' => $background_color,
            'text_color' => $text_color,
            'updated_at' => time()
        );

        $this->db->where('id', $id);
        $this->db->update('custom_tags', $data);
    }

    // Delete
    public function delete_tag($id) {
        $this->db->where('id', $id);
        $this->db->delete('custom_tags');
    }
}