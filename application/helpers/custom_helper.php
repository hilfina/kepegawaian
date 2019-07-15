<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('send_email')) {
    function send_email($kepada, $subyek, $pesan) {
        $CI =& get_instance();
    
        // Load PHPMailer library
        $CI->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $CI->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sdi.rsiaisyiyah@gmail.com';
        $mail->Password = 'SUBHANALLAH';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        $mail->setFrom('sdi.rsiaisyiyah@gmail.com', 'SDI RSI Aisyiyah Malang');
        $mail->addReplyTo('sdi.rsiaisyiyah@gmail.com', 'SDI RSI Aisyiyah Malang');
        
        // Add cc or bcc 
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = $subyek;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        //$template = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><title>Email</title></head><body style="background-color: #fafafa; margin: 0; padding: 0; border: 0; font-family: Arial, Helvetica, sans-serif; font-size: 100%; font: inherit; vertical-align: baseline;"> <header style="background-color: #083065; height: 50px; width: 100%;"></header> <main style="background-color: #ffffff; position: relative; margin: 0 auto; width: 80%;"><div style="padding: 30px;">';

        $template = $pesan;

        //$template .= '</div></main></body></html>';
        
        $mail->Body = $template;
        
        foreach($kepada as $tujuan) {
            // Add a recipient
            $mail->addAddress($tujuan);   
        }
        
        // Send email
        if($mail->send())
        {
            
            echo "<script>alert('Email berhasil terkirim');</script>";
        }else{
            echo "<script>alert('Email gagal terkirim'); </script>";
        }
    }
}