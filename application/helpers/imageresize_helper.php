<?php

function resize_image($width, $image)
{
    if (!empty($image)) {
        if (is_file('tmp/'.$width.'_'.$image)) {
            return base_url('tmp/').$width.'_'.$image;
        }else{
            $ci = get_instance();
            $ci->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'upload/'.$image;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = $image;
            
            $image = str_replace('/', '_', $image);
            $config['new_image']     = 'tmp/'.$width.'_'.$image;

            $ci->image_lib->clear();
            $ci->image_lib->initialize($config);
            try {
                if ($ci->image_lib->resize()) {
                    return base_url('tmp/').$width.'_'.$image;
                }else{
                    if (is_file('upload/'.$image)) {
                        return  base_url('upload/').$image;
                    }else{
                        return base_url('assets/img/default.jpg');
                    }
                   
                }    
            } catch (Exception $e) {
                if (is_file('upload/'.$image)) {
                    return  base_url('upload/').$image;
                }else{
                    return base_url('assets/img/default.jpg');
                }
            }
            
        }
    }else {
        return base_url('assets/img/default.jpg');
    }
}

