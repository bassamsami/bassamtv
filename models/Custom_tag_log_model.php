<?php
class Custom_tag_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Check
    public function is_avaliable($conditions)
    {
        $t = $this->db->where($conditions)->count_all_results('custom_tag_log');
        return ($t > 0);
    }

    // Create
    public function insert_log($custom_tags_id, $content_id, $content_type) {
        $data = array(
            'custom_tags_id' => $custom_tags_id,
            'content_id' => $content_id,
            'content_type' => $content_type
        );

        $this->db->insert('custom_tag_log', $data);
        return $this->db->insert_id();
    }

    // Read by ID with name and colors from custom_tags
    public function get_log_by_id($log_id) {
        $this->db->select('custom_tag_log.*, custom_tags.name as custom_tags_name, custom_tags.background_color, custom_tags.text_color');
        $this->db->from('custom_tag_log');
        $this->db->join('custom_tags', 'custom_tags.id = custom_tag_log.custom_tags_id');
        $this->db->where('custom_tag_log.id', $log_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Read by content_id and content_type with names and colors from custom_tags
    public function get_logs_by_content($content_id, $content_type) {
        $this->db->select('custom_tag_log.*, custom_tags.name as custom_tags_name, custom_tags.background_color, custom_tags.text_color');
        $this->db->from('custom_tag_log');
        $this->db->join('custom_tags', 'custom_tags.id = custom_tag_log.custom_tags_id');
        $this->db->where('custom_tag_log.content_id', $content_id);
        $this->db->where('custom_tag_log.content_type', $content_type);
        $query = $this->db->get();
        return $query->row();
    }

    // Read all with names and colors from custom_tags
    public function get_all_logs() {
        $this->db->select('custom_tag_log.*, custom_tags.name as custom_tags_name, custom_tags.background_color, custom_tags.text_color');
        $this->db->from('custom_tag_log');
        $this->db->join('custom_tags', 'custom_tags.id = custom_tag_log.custom_tags_id');
        $query = $this->db->get();
        return $query->result();
    }

    // Update
    public function update_log($log_id, $custom_tags_id, $content_id, $content_type) {
        $data = array(
            'custom_tags_id' => $custom_tags_id,
            'content_id' => $content_id,
            'content_type' => $content_type
        );

        $this->db->where('id', $log_id);
        $this->db->update('custom_tag_log', $data);
    }

    // Delete
    public function delete_log($log_id) {
        $this->db->where('id', $log_id);
        $this->db->delete('custom_tag_log');
    }

    // Update By Content
    public function update_log_by_content($custom_tags_id, $content_id, $content_type) {
        $data = array(
            'custom_tags_id' => $custom_tags_id
        );

        $this->db->where('content_id', $content_id);
        $this->db->where('content_type', $content_type);
        $this->db->update('custom_tag_log', $data);
    }

    // Delete By Content
    public function delete_log_by_content($content_id, $content_type) {
        $this->db->where('content_id', $content_id);
        $this->db->where('content_type', $content_type);
        $this->db->delete('custom_tag_log');
    }
}
