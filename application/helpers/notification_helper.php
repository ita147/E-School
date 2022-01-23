<?php
function send_notification($to, $subject, $content)
{
    $ci = get_instance();
    $ci->load->model('GlobalModel');
    // get mail data
    $settings  = $ci->GlobalModel->getAppApi();
    $settings2  = $ci->GlobalModel->getAppSettings();
    $mail_add  = $settings['mailsender_address'];
    $mail_pass = $settings['mailsender_password'];
    $from      = $settings2['site_title'];
    // load library
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => $mail_add,
        'smtp_pass' => $mail_pass,
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
    );
    $ci->load->library('email', $config);
    $ci->email->from($mail_add, $from);
    if (is_array($to)) {
        $ci->email->to(implode(",", $to));
    }else{
        $ci->email->to($to);
    }
    
    $ci->email->subject($subject);
    $ci->email->message($content);
    $ci->email->set_newline("\r\n");  
    if ($ci->email->send()) {
        return true;
    } else {
        $error = $ci->email->print_debugger();
        $ci->session->set_flashdata('error', $error); 
        log_message('error', $error); 
        return false;
    } 
}

