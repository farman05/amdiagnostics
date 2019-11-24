<?php

    if(isset($header) && $header)
        $this->load->view('front_end_templates/header');

   
    if(isset($_view))
        $this->load->view('front_end/'.$_view);

    if(isset($footer) && $footer)
        $this->load->view('front_end_templates/footer');
  ?>