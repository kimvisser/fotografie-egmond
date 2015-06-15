<?php

function sendMailContactQuestion($app, $formInput) {  
   // process form
   // instantiate smtp object
   $smtp = new SMTP('mail.antagonist.nl',465,'SSL','info@fotografie-egmond.nl','Stonefish8');
   
   // set template variables
   $app->set('name',$formInput['name']);
   $app->set('email',$formInput['email']);
   $app->set('phone',$formInput['phone']);
   $app->set('question',$formInput['question']);
   
   // set email headers
   $smtp->set('To','"Fotografie Egmond" <info@fotografie-egmond.nl>');
   $smtp->set('From','"'.$formInput['name'].'" <'.$formInput['email'].'>');
   $smtp->set('Subject','Informatie aanvraag Fotografie Egmond');
   $smtp->set('Content-Type','text/html');
   
   // send email message
   $smtp->send(Template::instance()->render('tpl-contact-question.txt','text/html'));
}

function sendMailContactConfirmation($app, $formInput) {
   // process form
   // instantiate smtp object
   $smtp = new SMTP('mail.antagonist.nl',465,'SSL','info@fotografie-egmond.nl','Stonefish8');
   
   // set template variables
   $app->set('name',$formInput['name']);
   
   // set email headers
   $smtp->set('To','"'.$formInput['name'].'" <'.$formInput['email'].'>');
   $smtp->set('From','"Fotografie Egmond" <info@fotografie-egmond.nl>');
   $smtp->set('Subject','Informatie aanvraag Fotografie Egmond in behandeling');
   $smtp->set('Content-Type','text/html');
   
   // send email message
   $smtp->send(Template::instance()->render('tpl-confirmation-question.txt','text/html'));
}

?>