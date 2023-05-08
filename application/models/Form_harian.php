<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Form_harian extends CI_Model
{

    public function get($username)
    {
        $this->db->where('user_Username', $username);
        $result = $this->db->get('users')->row();
        return $result;
    }

    public function getBy($username)
    {
        $this->db->where('user_Usernam', $username);
        $result = $this->db->get('users')->row();
        return $result;
    }

    public function updatePW($id)
    {
        $post = $this->input->post();
        $data = array(
            'password' => md5($post["password_baru"]),
        );

        $this->db->where('id_admin', $id);
        return $this->db->update('users', $data);
    }
}
