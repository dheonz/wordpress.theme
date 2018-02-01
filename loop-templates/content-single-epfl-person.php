<?php


$menu=1;
$with_red_ribbon=1; //highlights the first box (red ribbon)


/**
 * Partial template for a person.
 *
 * @package epflsti
 */


use \EPFL\WS\Persons\Person;

// TODO: we should eliminate more and more of this, and move it into accessors
// of the Person instance, below
$incoming_json=file_get_contents('https://stisrv13.epfl.ch/cgi-bin/whoop/peoplepage.pl?sciper='.$post->post_name);
$incoming=json_decode($incoming_json);
$labname=$incoming->labname;
$mylabname=$incoming->mylabname;
$labwebsite=$incoming->labwebsite;
$keywords=$incoming->keywords;
$biography=$incoming->bio;
$research=$incoming->interests;
$position=$incoming->position;
$id=$incoming->id;
$surname=$incoming->surname;
$firstname=$incoming->firstname;
$epflname=$incoming->epflname;
$phone=$incoming->phone;
$office=$incoming->office;
$sciper=$incoming->sciper;
$videoeng=$incoming->videoeng;
$news=$incoming->news;
$labimage="https://stisrv13.epfl.ch/brochure/img/$id/research.png";

if (class_exists('\\EPFL\\WS\\Persons\\Person')) {
    global $post;
    $person = Person::get($post);
    $biography = $person->get_bio();
} else {
    error_log("Class not exists");
}

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header ></header>

<?php

if ($position == 'PO') { $officialtitle='Prof. ';
$position='Full Professor'; }
else if ($position == 'PA') { $officialtitle='Prof. '; $position='Associate Professor'; }
else if ($position == 'SNF') { $officialtitle='Prof. '; $position='SNF Funded Assistant Professor'; }
else if ($position == 'PATT') { $officialtitle='Prof. '; $position='Tenure Track Assistant Professor'; }
else if ($position == 'PT') { $officialtitle='Prof. '; $position='Adjunct Professor'; }
else if ($position == 'MER') {$officialtitle='Dr. '; $position='Senior Scientist'; }
else {$officialtitle=$position; }

//the rest must come from other sources

$epfl_positions="
<br>
Associate Professor:<br><br>
<ul>
  <li>Laboratory for Information and Inference Systems
  <li>Institute of Electrical Engineering
  <li>School of Engineering
</ul>
<ul>
  <li>EDEE - Doctoral Program in Electrical Engineering
</ul>
";

$newstitle1=$incoming->newstitle1;
$newstitle2=$incoming->newstitle2;
$newstitle3=$incoming->newstitle3;
$newstitle4=$incoming->newstitle4;

$newsimage1=$incoming->newsimage1;
$newsimage2=$incoming->newsimage2;
$newsimage3=$incoming->newsimage3;
$newsimage4=$incoming->newsimage4;

$newslink1=$incoming->newslink1;
$newslink2=$incoming->newslink2;
$newslink3=$incoming->newslink3;
$newslink4=$incoming->newslink4;

$publicationtext1="C. Aprile, A. Cevrero, P. A. Francese, C. Menolfi and M. Braendli et al. An Eight lanes 7Gb/s/pin Source Synchronous Single-Ended RX with Equalization and Far-End Crosstalk Cancellation for Backplane Channels, in IEEE Journal of Solid State Circuits, vol. PP, num. 99, p. 1-12, 2018";
$publicationlink1="https://infoscience.epfl.ch/record/233712/files/08246724.pdf?version=1";
$publicationrecord1="https://infoscience.epfl.ch/record/233712?ln=en";

$publicationtext2="S. Mitrovic, I. Bogunovic, A. Norouzi Fard, J. Tarnawski and V. Cevher. Streaming Robust Submodular Maximization: A Partitioned Thresholding Approach. Conference on Neural Information Processing Systems (NIPS), Long Beach, 2017";
$publicationlink2="https://infoscience.epfl.ch/record/232540/files";
$publicationrecord2="https://infoscience.epfl.ch/record/232540?ln=en";

$publicationtext3="A. Alacaoglu, Q. Tran-Dinh, O. Fercoq and V. Cevher. Smooth Primal-Dual Coordinate Descent Algorithms for Nonsmooth Convex Optimization. 31st Conference on Neural Information Processing Systems (NIPS 2017), Long Beach, CA, USA, 2017";
$publicationlink3="https://infoscience.epfl.ch/record/232391/files/SMOOTH-CD_MAIN.pdf?version=1";
$publicationrecord3="https://infoscience.epfl.ch/record/232391?ln=en";

$publicationtext4="I. Bogunovic, S. Mitrovic, J. Scarlett and V. Cevher. A Distributed Algorithm for Partitioned Robust Submodular Maximization. IEEE International Workshop on Computational Advances in Multi-Sensor Adaptive Processing (CAMSAP), 2017";
$publicationlink4="https://infoscience.epfl.ch/record/232383/files/A%20Distributed%20Algorithm%20for%20Partitioned%20Robust%20Submodular%20Maximization.pdf?version=1";
$publicationrecord4="https://infoscience.epfl.ch/record/232383?ln=en";

?>
<div class="container-fluid"><?php # row if there is a box of links on the right ?>
  <div class=row><?php #  container if there is a box of links on the right ?>
    <div class="<?php echo $listoflinks_main; ?>"><?php # column if there is a box of links on the right ?>
      <div class=container><?php # main container ?>
        <div class=row><?php #  main row ?>
          <card class="<?php echo $listoflinks_width; ?>">
           <?php if ($with_red_ribbon): ?>
            <header>
             <img class="ribbon-red-top" src="/wp-content/themes/epfl-sti/img/src/topright.png"> 
             <img class="ribbon-red-bottom" src="/wp-content/themes/epfl-sti/img/src/bottomleft.png">
            </header>
         <?php endif;  ?>
          <?php the_title( '<h1>'.$officialtitle, '</h1>' ); ?>
              <div class="card-body">
              <div class="sti_content_prof_photo">
                <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
              </div><?php # prof_photo ?>
            <?php echo "<b>$position</b><br><br>"; ?>
            <?php
              echo "\n" . '<biography class="person-bio" id="person-bio-' . $post->post_name . '">' . "\n";
              echo "\t" . $biography . "\n";
              echo "</biography>\n";
            ?>
          </div><?php # prof_text ?>
        </div>
        <?php
          // succeeding boxes currently take the_content() too
        ?>
        <card class="mainmatter <?php echo $listoflinks_width; ?>">
          <h2>Contact</h2>
          <h5><br><?php echo "$firstname $surname"; ?></h5>
          <div class="container">
            <div class="row entry-body">
              <div class="col-xs-6 text-column">
                <?php echo "Office: <a href=https://maps.epfl.ch/?q=$office>$office</a><br><a href=mailto:$epflname@epfl.ch>$epflname@epfl.ch</a><br><a href=https://people.epfl.ch/$epflname>https://people.epfl.ch/$epflname</a><br>Tel: <a href=\"tel:$phone\">$phone</a><br><br>"; ?>
              </div>
              <div class="col-xs-6 text-column">
                <?php echo "$labname<br> $office<br> Station 11<br> 1015 Lausanne<br> Switzerland"; ?>
              </div>
            </div>
          </div>
        </card>

      <?php
      if ($videoeng != "") {
        echo '<card class="mainmatter '.$listoflinks_width.'; ?>">
                <a name=video></a>
                <div style="margin: 20px 0px 40px 0px; float:left; width:100%; height:285px; ">
                  <iframe src="https://www.youtube.com/embed/'.$videoeng.'?enablejsapi=1&amp;autoplay=0&amp;rel=0" allowscriptaccess="always" allowfullscreen="" width="100%" height="280" frameborder="0"></iframe>
                </div>
              </div>';
      }
      ?>

        <card class="mainmatter <?php echo $listoflinks_width; ?>"><a name=research></a>
         <header>
          <h2>Research Area</h2>
         </header>
          <?php echo $research; ?>
        </div>

      <?php
      if ( get_post_meta( $post->ID, 'publication_link', true) ) { ?>
        <card class="mainmatter card-prof-publications <?php echo $listoflinks_width; ?>">
         <header>
          <h2>Recent Publications</h2>
         </header>
          <main>
            <?php
              // get publication through the shortcode
              $tmp = do_shortcode( '[infoscience url=' . get_post_meta( $post->ID, 'publication_link', true) . ']' );
              $dom = new DOMDocument();
              // be sure to load the encoding
              $dom->loadHTML('<?xml encoding="utf-8" ?>' . $tmp);
              // let's use XPath
              $finder = new DomXPath($dom);
              // set the limit
              $limit = 10; $cnt = 0;
              // and remove unwanted elements
              foreach($finder->query("//*[contains(@class, 'infoscience_record')]") as $elm ) {
                if ($cnt >= $limit)
                  $elm->parentNode->removeChild($elm);
                $cnt++;
              }
              // finally, echo
              echo $dom->saveHTML($dom->documentElement);
            ?>
          </main>
        </card>
      <?php
      } ?>

      <?php
        if ($newslink1 !="") {
          echo '
                <card class="prof-news '.$listoflinks_width.'">
                  <header>
                    <a name=news></a>
                    <h2>News</h2>
                  </header>
                  <main>
                    <div class="frontrowcontent">';
        }
        if ($newslink1 != "") {
          echo "<div class='mini-news zoomy' style='background-image:url(\"$newsimage1\");'>\n<div class=peoplenewstitle><a class=whitelink href=$newslink1>$newstitle1</a></div>\n</div>\n";
        }
        if ($newslink2 != "") {
          echo "<div class='mini-news zoomy' style='background-image:url(\"$newsimage2\");'>\n<div class=peoplenewstitle><a class=whitelink href=$newslink2>$newstitle2</a></div>\n</div>\n";
        }
        if ($newslink3 != "") {
          echo "<div class='mini-news zoomy' style='background-image:url(\"$newsimage3\");'>\n<div class=peoplenewstitle><a class=whitelink href=$newslink3>$newstitle3</a></div>\n</div>\n";
        }
        if ($newslink4 != "") {
          echo "<div class='mini-news zoomy' style='background-image:url(\"$newsimage4\");'>\n<div class=peoplenewstitle><a class=whitelink href=$newslink4>$newstitle4</a></div>\n</div>\n$news";
        }
        if ($newslink1 !="") {
        echo '
                  </main>
                </card>
        ';
        }
      ?>
      </div><?php # main row ?>
    </div><?php #  main container ?>
  </div><?php # column in case there is a list of links on the right ?>

<?php
  // this box is a list of links
if ($menu):

 $listoflinks_main=" col-md-8 content-area";
 $listoflinks_width=" width-main-listoflinks";
 $listoflinks_menu=" sti_righthand_menu col-md-4";
?>
  <aside class="col-md-4">
    <card class="first frontrowmarker">
     '.$labname.' <span class="sti_people_menu_black">'.$mylabname.'</span>
     <img src='.$labimage.' class="sti_people_menu_image">
    </div><?php #  menutitle ?>
    <card class="links">
      <div class="research-topics">
        Research topics:<br><br>'.$keywords.'
      </div>
      <div class="prof-nav-menu">
        <ul class="menu">
          <li id="menu-item-128" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-128"><a href="'.$labwebsite.'">LAB WEBSITE</a></li>

          <?php if ($videoeng != "") { ?>
              <li id="menu-item-132" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-131"><a href="#video">VIDEOS</a></li>
          <?php } ?>

          <li id="menu-item-134" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-131"><a href="#research">RESEARCH</a></li>
          <li id="menu-item-129" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-129"><a href="https://people.epfl.ch/cgi-bin/people?id='.$sciper.'&op=publications&lang=en&cvlang=en">PUBLICATIONS</a></li>
          <li id="menu-item-130" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-131"><a href="#news">NEWS</a></li>
          <li id="menu-item-133" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-130"><a href="https://stisrv13.epfl.ch/collaborations/tube_html5.php?sciper='.$sciper.'&showpublications=1&showpatents=1&showexternals=1&showindustry=1">COLLABORATIONS</a></li>
        </ul>
      </div><?php # prof-nav-menu ?>
    </card>
<?php endif; ?>


      </div><?php # column if there is a box of links on the right ?>
    </div><?php # row if there is a box of links on the right ?>
  </div><?php #  container if there is a box of links on the right ?>
  <div class="entry-meta">
  </div><?php # .entry-meta ?>
  <footer>
    <?php epflsti_entry_footer(); ?>
  </footer>
</article><?php # #post-## ?>
