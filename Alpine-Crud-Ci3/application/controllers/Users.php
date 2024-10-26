<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index($id = "")
    {
        $data['title'] = (!empty($id)) ? 'User Update Form' : 'User Registration Form';
        if (!empty($id)) {
            $data['user'] = User_model::find($id)->toArray();
            $data['user']['skills'] = explode(",", $data['user']['skills']);
        }
        $this->load->view('form', $data);
    }

    public function save()
    {

        $data = $this->input->post();
        if (empty($data['id'])) {
            unset($data['id']);
        }
        $result = (!empty($data['id'])) ? User_model::where('id', $data['id'])->update($data) : User_model::insert($data);
        echo json_encode([
            'status' => $result,
            'message' => $result ? (!empty($data['id']) ? 'User Updated Successfully' : 'User Created Successfully') : 'Something Went Wrong'
        ]);
    }

    public function table()
    {
        $data['titile'] = 'User List';
        $data['users']  = User_model::get()->toArray();
        $this->load->view('user', $data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $result = User_model::where('id', $id)->delete();
        echo json_encode([
            'status' => $result,
            'message' => $result ? 'User Deleted Successfully' : 'Something Went Wrong'
        ]);
    }
}
