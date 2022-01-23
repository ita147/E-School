<?php

function check_status_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id        = $ci->session->userdata('role_id');
        $menu           = $ci->uri->segment(1);
        $sub_menu       = $ci->uri->segment(2);
        $queryMenu      = $ci->db->get_where('app_menu', ['url' => $menu])->row_array();
        $querySubMenu   = $ci->db->get_where('app_sub_menu', ['url' => $sub_menu, 'menu_id' => $queryMenu['id']])->row_array();
        $menu_id        = $queryMenu['id'];
        $sub_menu_id    = $querySubMenu['id'];

        // get sub menu
        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id, 'sub_menu_id' => $sub_menu_id]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{

    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
