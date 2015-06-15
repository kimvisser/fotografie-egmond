<?php
$f3=require('lib/base.php');
include('app/mail.php');

// set globals
$f3->set('DEBUG',1);
$f3->set('UI','ui/');

// set application globals
$f3->set('httpHost','http://'.$_SERVER['HTTP_HOST'].'/');
// development
$f3->set('httpHostContextPrefix',$f3->get('httpHost').'fotografie-egmond/');
// production
// $f3->set('httpHostContextPrefix',$f3->get('httpHost'));

// set routes
$f3->route('GET /',
   function() {
      echo View::instance()->render('header.php');
      echo View::instance()->render('content-header.php');
      echo View::instance()->render('news.php');
      echo View::instance()->render('footer.php');
   }
);

$f3->route('GET /about',
   function() {
      echo View::instance()->render('header.php');
      echo View::instance()->render('content-header.php');
      echo View::instance()->render('about.php');
      echo View::instance()->render('footer.php');
   }
);

$f3->route('GET /products',
   function() {
      echo View::instance()->render('header.php');
      echo View::instance()->render('content-header.php');
      echo View::instance()->render('products.php');
      echo View::instance()->render('footer.php');
   }
);

$f3->route('GET /portfolio',
   function() {
      echo View::instance()->render('header.php');
      echo View::instance()->render('content-header.php');
      echo View::instance()->render('portfolio.php');
      echo View::instance()->render('footer.php');
   }
);

$f3->route('GET /contact','renderContact');
function renderContact($f3) {
   if ($f3->exists('SESSION.messages')) {
      $f3->set('messages',$f3->get('SESSION.messages'));
      $f3->clear('SESSION.messages');
   }
   if ($f3->exists('SESSION.formInput')) {
      $f3->set('POST',$f3->get('SESSION.formInput'));
      $f3->clear('SESSION.formInput');
   }
   
   echo View::instance()->render('header.php');
   echo View::instance()->render('content-header.php');
   
   // render the right contact page
   if ($f3->exists('SESSION.contactStatus')) {
      echo Template::instance()->render('contact-succes.html');
      $f3->clear('SESSION.contactStatus');
   } else {
      echo Template::instance()->render('contact.html');
   }
   
   echo View::instance()->render('footer.php');
}

$f3->route('POST /contact-askquestion',
   function($f3) {
      $formInput = $f3->get('POST');
      
      // sanitize form input data
      $f3->scrub($formInput);
      
      // error message composing
      $messages = array();
      if (empty($formInput['captcha'])) { array_push($messages,'Voer een beveiliginscode in'); }
      else if ($f3->get('SESSION.captcha_code') != strtoupper($formInput['captcha'])) { array_push($messages,'De ingevoerde beveiligingscode is onjuist'); }     
      if (empty($formInput['name'])) { array_push($messages,'Voer een naam in'); }
      
      if (count($messages)==0) {
         sendMailContactQuestion($f3, $formInput);
         sendMailContactConfirmation($f3, $formInput);
         $f3->set('SESSION.contactStatus','succes');
      } else {
         // set messages and form input in SESSION since we're rerouting all other variables will be lost
         $f3->set('SESSION.messages', $messages);
         $f3->set('SESSION.formInput', $formInput);
      }
         
      // $f3->reroute('/contact');
      renderContact($f3);
   }
);

$f3->route('GET /captcha',
   function() {
      $img = new Image();
      $img->captcha('fonts/ARCHRISTY.ttf',16,5,'SESSION.captcha_code');
      $img->render();
   }
);

$f3->run();
?>