<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_content {

    public function email_footer() {
        $footer = ' <div class="Unsubscribe--addressLine">
                        <p class="Unsubscribe--senderName" style="font-family:Arial,Helvetica, sans-serif;font-size:12px;line-height:20px">'.COMPANYNAME.'</p>
                        <p style="font-family:Arial,Helvetica, sans-serif;font-size:12px;line-height:20px;text:center">
                            <span class="Unsubscribe--senderAddress"><a target="_blank" style="color:black" href="' . base_url() . '">' . COMPANYNAME . '                     
                            </a></span>, 
                            
                             <span class="Unsubscribe--senderState" style="color:black;">' . SUPPEMAIL . '</span> 
                            
                        </p>
                        <p><span style="text:center;color:black;">' . COMPANYADDR . '</span> </p>
                    </div>
                    
                    ';
        return $footer;
    }

    public function email_header() {
        $header = ' <tr>
                        <td style="font-size:6px;line-height:10px;padding:0px 0px 0px 0px;" valign="top" align="center">
                        <a target="_blank" style="color:black" title="Micro Testting Lab Solutions Pvt. Ltd" href="'. base_url() .'"><img class="max-width" border="0" style="display:block;color:#fff;text-decoration:none;font-family:Helvetica, arial, sans-serif;font-size:16px;" src="' . base_url() . COMPANYLOGO . '" alt="' . COMPANYNAME . '" width="166" height="58" ></a>
                        </td>
                    </tr>';
        return $header;
    }

}

?>