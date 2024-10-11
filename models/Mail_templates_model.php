<?php
class Mail_templates_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //Check
    public function is_avaliable($conditions)
    {
        $t = $this->db->where($conditions)->count_all_results('mail_templates');
        return ($t > 0);
    }
    //get
    public function get($conditions) {
        $this->db->from('mail_templates');
        $this->db->where($conditions);
        $query = $this->db->get();
        return $query->row();
    }
    //get_all
    public function get_all() {
        $query = $this->db->get('mail_templates');
        return $query->result();
    }

    //update
    public function update($type, $data) {
        $data = array(
            'data' => $data
        );
        $this->db->where('type', $type);
        return $this->db->update('mail_templates', $data);
    }
}
