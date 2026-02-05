<?php
/* 
/////////// tools website multiple languages ///////
@@@@@@@script tools
*######### about
##########
@@@@@@@@ about me
github
https://github.com/Abbasawad25
 faecbook 
https://www.facebook.com/abbasawad26
https://www.facebook.com/abbasawad24
youtube
https://youtube.com/@abbasawad?si=dyfkjbAiUOqsvJMn

Twitter
https://twitter.com/abbasawad26
https://twitter.com/abbasawad25
your web site
https://abbasawad25.epizy.com/abbasawad26
and
join from group on faecbook
رابط مجموعة مليون مبرمج سوداني https://facebook.com/groups/milliosudaneseprogrammer/



*/
session_start();
include("backend/languages/langConfig.php");

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $lang['site_description']; ?>">
	  <meta name="keywords" content="<?php echo $lang['site_keywords']; ?>">
  	<meta name="author" content="Brad Traversy">
    <title><?php echo $lang['site_title']; ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="img/favicon.png">
  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight"></span> <?php echo $lang['site_title']; ?></h1>
        </div>
        <nav>
          <ul>
            <li class="current"><a href="index.php"><?php echo $lang['home']; ?></a></li>
            <li><a href="index.php?lang=ar">العربية</a></li>
            <li><a href="index.php?lang=en">English </a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section id="showcase">
      <div class="container">
        <h1><?php echo $lang['created_web_site']; ?></h1>
        <p><?php echo $lang['div_description']; ?></p>
      </div>
    </section>

    <section id="newsletter">
      <div class="container">
        <h1><?php echo $lang['subscribe_to_newsletter']; ?></h1>
        <form>
          <input type="email" placeholder="<?php echo $lang['email']; ?>" required>
          <button type="submit" class="button_1"><?php echo $lang['subscribe']; ?></button>
        </form>
      </div>
    </section>

    <section id="boxes">
      <div class="container">
        <div class="box">
          <img src="./img/logo_html.png">
          <h3>HTML5 Markup</h3>
          <p><?php echo $lang['description_html']; ?></p>
        </div>
        <div class="box">
          <img src="./img/logo_css.png">
          <h3>CSS3 Styling</h3>
          <p><?php echo $lang['description_css']; ?></p>
        </div>
        <div class="box">
          <img src="./img/logo_brush.png">
          <h3><?php echo $lang['graphic_design']; ?></h3>
          <p><?php echo $lang['description_graphic_design']; ?></p>
        </div>
      </div>
    </section>

    <footer>
      <p><?php echo $lang['description_copyright']; ?> &copy; 2025</p>
    </footer>
  </body>
</html>

