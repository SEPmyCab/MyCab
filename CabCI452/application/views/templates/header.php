<!DOCTYPE html>
<?php 
       $status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}
 
    ?>
<html>
<head>
	<title><?php echo $title ?></title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" >

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" >
        
        <!-- pathum css -->
       
        <base href="<?php echo base_url(); ?>">
        <link href="assets/css/css_pathum.css" rel="stylesheet">
<link href="assets/css/nu.css" rel="stylesheet">
      <!--<link href="nu.css" rel="stylesheet" type="<?php echo asset_url();?>css/css_pathum.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/nu.css"/>-->
        
        
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-12953034-1']);
		  _gaq.push(['_setDomainName', 'ellislab.com']);
		  _gaq.push(['_setCustomVar', 1, 'Category', 'user-guide',3]);
		  _gaq.push(['_setCustomVar', 2, 'Product', 'ExpressionEngine',3]);
		  _gaq.push(['_setCustomVar', 3, 'Member Group', '3',3]);
		  _gaq.push(['_setCustomVar', 4, 'Site', '{site_short_name}',3]);
		  _gaq.push(['_trackPageview']);

		function trackOutboundLink(link, category, action, label) {

		try {
		_gaq.push(['_trackEvent', category , action, label]);
		} catch(err){}

		setTimeout(function() {
		// jQuery handles rel="external" links for us so we don't have anything to do here but pause
		return false;
		}, 100);
		}

		(function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

		</script></head>
<body>
	 <div id="wrapper">  
          

        <header class="row">
            <img src="<?= asset_url();?>images/my_cab_logo.png" class="img-responsive image-header-margin" height="100" width="331">
            <div><label class="userLabel"><?php 
                $email='';
                if (isset($this->session->userdata['logged_in']['email'])){
                $email=$this->session->userdata['logged_in']['email'];}
                if (isset($this->session->userdata['logged_in']['fname']))
                {
                   $fname= $this->session->userdata['logged_in']['fname'];
                  // $email=$this->session->userdata['logged_in']['email'];
                
                if($email!='' && $fname!='')
                {
                 echo 'Welcome..'.$fname;
            
                }
                elseif($email!='')
                 { 
                 echo 'Welcome..'.$email;
                 }
                 else 
                 {
                 echo 'Welcome';
                 }
                }
                ?></label></div>
           <?php if ($email!=''){include 'authenticated.php';}else{include 'nonauthenticated.php';}?>
        </header>
          
      <nav id="navigation">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    
                    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                          <li ><a href="#"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> How It Works</a></li>
                          <li ><a href="index.php/driverShow"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search Drivers</a></li>
                         
                     <?php if ($email!=''){include 'showFeedback.php';}?>
                        
                      </ul>
                      
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php/aboutShow"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> About Us</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Contact Us</a></li>
                         <?php if ($email!=''){include 'showAccount.php';}?>
                        
                        
                      </ul>
                    </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
      </nav>
         
         

 