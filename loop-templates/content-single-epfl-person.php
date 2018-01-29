<?php
/**
 * Single post partial template.
 *
 * @package epflsti
 */

$incoming_json=file_get_contents('https://stisrv13.epfl.ch/cgi-bin/whoop/peoplepage.pl?sciper='.$post->post_name);
$incoming=json_decode($incoming_json);

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">



	</header><!-- .entry-header -->

<?php

//the following is ready to go as json from https://stisrv13.epfl.ch/cgi-bin/whoop/peoplepage.pl?sciper=

$labname=$incoming->labname;
$mylabname=$incoming->mylabname;
$labwebsite=$incoming->labwebsite;
$keywords=$incoming->keywords;
$bio="Prof. Volkan Cevher received his BSc degree (valedictorian) in Electrical Engineering from Bilkent University in 1999, and his PhD degree in Electrical and Computer Engineering from Georgia Institute of Technology in 2005. He held Research Scientist positions at University of Maryland, College Park during 2006-2007 and at Rice University during 2008-2009. Currently, he is an Assistant Professor at Ecole Polytechnique Federale de Lausanne and a Faculty Fellow at Rice University. His research interests include signal processing theory, machine learning, graphical models, and information theory.";
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

$labimage="https://stisrv13.epfl.ch/brochure/img/$id/research.png";

if ($position == 'PO') { $officialtitle='Prof. ';
$position='Full Professor'; }
else if ($position == 'PA') { $officialtitle='Prof. '; $position='Associate Professor'; }
else if ($position == 'SNF') { $officialtitle='Prof. '; $position='SNF Funded Assistant Professor'; }
else if ($position == 'PATT') { $officialtitle='Prof. '; $position='Tenure Track Assistant Professor'; }
else if ($position == 'PT') { $officialtitle='Prof. '; $position='Adjunct Professor'; }
else if ($position == 'MER') {$officialtitle='Dr. '; $position='Senior Scientist'; }
else {$officialtitle=$position; }

//the rest must come from other sources

$address="LIONS<br> ELE233<br> Station 11<br> 1015 Lausanne<br> Switzerland";

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

$newstitle1="Three Prestigious Consolidator Grants";
$newstitle2="Volkan Cevher wins an ERC starting grant";
$newstitle3="Algorithms are all around";
$newstitle4="IEEE Signal Processing Best Paper Award";

$newsimage1="https://stisrv13.epfl.ch/newsdesk/covershots/el/left2017.png";
$newsimage2="https://stisrv13.epfl.ch/newsdesk/covershots/el/left1263.png";
$newsimage3="https://stisrv13.epfl.ch/newsdesk/covershots/el/left1180.png";
$newsimage4="https://i.ytimg.com/vi/blIMmx5oh7o/maxresdefault.jpg";

$newslink1="http://sti.epfl.ch/page-140428.html#anchor2017";
$newslink2="http://sti.epfl.ch/page-67196.html#anchor1263";
$newslink3="http://sti.epfl.ch/page-57268.html";
$newslink4="http://sti.epfl.ch/page-108381.html#anchor2025";

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

$menu=1;

if ($menu) {
 $rosesarered="<img class='ribbon-red-top' src='/wp-content/themes/epfl-sti/img/src/topright.png'> 
<img class='ribbon-red-bottom' src='/wp-content/themes/epfl-sti/img/src/bottomleft.png'>";

 $listoflinks_main=" col-md-8 content-area";
 $listoflinks_width=" width-main-listoflinks";
 $listoflinks_menu=" sti_righthand_menu col-md-4";

 $menu='
<?PHP # LIST OF LINKS START ?>
 <div class="col-md-4">
  <div class="sti_people_menu_title frontrowmarker">
   '.$labname.' <span class="sti_people_menu_black">'.$mylabname.'</span>
   <img src='.$labimage.' class="sti_people_menu_image">
  </div><!-- menutitle-->
  <div class="sti_people_box">
   <div class="sti_people_menu_white">
    Research topics:<br><br>'.$keywords.'
   </div><!--menuwhite-->
   <div class="prof-nav-menu">
    <ul class="menu">
     <li id="menu-item-128" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-128"><a href="'.$labwebsite.'">LAB WEBSITE</a></li>
        <li id="menu-item-132" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-131"><a href="#video">VIDEOS</a></li>
        <li id="menu-item-134" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-131"><a href="#research">RESEARCH</a></li>
      <li id="menu-item-129" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-129"><a href="https://people.epfl.ch/cgi-bin/people?id='.$sciper.'&op=publications&lang=en&cvlang=en">PUBLICATIONS</a></li>
        <li id="menu-item-130" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-131"><a href="#news">NEWS</a></li>
        <li id="menu-item-133" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-130"><a href="https://stisrv13.epfl.ch/collaborations/tube_html5.php?sciper='.$sciper.'&showpublications=1&showpatents=1&showexternals=1&showindustry=1">COLLABORATIONS</a></li>
</ul>
   </div><!-- menucontainer-->
  </div><!-- peoplebox-->
 <?PHP # LIST OF LINKS END ?>
 ';
}
?>
<div class=container><!--row if there is a box of links on the right-->
  <div class=row><!-- container if there is a box of links on the right-->
    <div class="<?php echo $listoflinks_main; ?>"><!--column if there is a box of links on the right-->



	 <div class=container><!-- main container -->
           <div class=row><!-- main row-->

	    <div class="entry-content standard-content-box <?php echo $listoflinks_width; ?>">
		<?php  // the choice is made to highlight this box
		 echo $rosesarered;
		?>
		<?php the_title( '<h1 class="entry-title">'.$officialtitle, '</h1>' ); ?>
		     <div class="entry-body">
		      <div class="sti_content_prof_photo">
			 <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		      </div><?php # prof_photo ?>
		      <?php echo "<b>$position</b><br><br>"; ?>
					<?php
					// Fetching the BIO form people page
					$fetch_bio = file_get_contents("https://people.epfl.ch/cgi-bin/people?id=" . $post->post_name . "&op=bio&lang=en&cvlang=en");
					$dom = new DOMDocument();
					// https://stackoverflow.com/questions/8218230/php-domdocument-loadhtml-not-encoding-utf-8-correctly
					$dom->loadHTML(mb_convert_encoding($fetch_bio, 'HTML-ENTITIES', 'UTF-8'));
					$xpath = new DOMXpath($dom);
					$biography = $xpath->query("//div[@id='content']/h3[text()='Biography']/following-sibling::text()")[0]->textContent;
					echo "\n" . '<biography class="person-bio" id="person-bio-' . $post->post_name . '">' . "\n";
					echo "\t" . $biography . "\n";
					echo "</biography>\n";
					 ?>
		     </div><?php # prof_text ?>

		     
  	    </div><!-- .entry-content -->


		<?php   
		 // succeeding boxes currently take the_content() too
                ?>
	
	
	
	    <div class="entry-content standard-content-box <?php echo $listoflinks_width; ?>">
		<h2 class="entry-title">Positions and Contact</h2>
		<h5><br><?php echo "$firstname $surname"; ?></h5>
 		    <div class="container">
			<div class="row entry-body">
			      <div class="col-xs-6 standard-margin">
<?php echo "Office: <a href=https://maps.epfl.ch/?q=$office>$office</a><br><a href=mailto:$epflname@epfl.ch>$epflname@epfl.ch</a><br><a href=https://people.epfl.ch/$epflname>https://people.epfl.ch/$epflname</a><br>Tel: <a href=\"tel:$phone\">$phone</a><br><br>"; ?>	
			      </div><!-- col  -->
			      <div class="col-xs-6 standard-margin">
			        <?php echo $address; ?>
			      </div><!-- col  -->
			</div><!-- row -->

		     </div> <!-- entry-body-->
  	    </div><!-- .entry-content -->

	    <div class="entry-content standard-content-box <?php echo $listoflinks_width; ?>">
		    <a name=video></a>

     <div style="margin: 20px 0px 40px 0px; float:left; width:100%; height:285px; "><iframe src="https://www.youtube.com/embed/<?php echo $videoeng; ?>?enablejsapi=1&amp;autoplay=0&amp;rel=0" allowscriptaccess="always" allowfullscreen="" width="100%" height="280" frameborder="0"></iframe></div> 
  	    </div><!-- .entry-content -->

	    <div class="entry-content standard-content-box <?php echo $listoflinks_width; ?>"><a name=research></a>
		<h1>Research Area</h1><br><br>
		<?php echo $research; ?>
  	    </div><!-- .entry-content -->

	    <div class="entry-content standard-content-box <?php echo $listoflinks_width; ?>">
     <h2 class=people_titles>Recent Publications</h2>     
        <div class="sti_content_prof_text">
<?php
        echo "<br>";
        echo "<h3>2018</h3>";
        echo "<a href=$publicationlink1>$publicationtext1</a><br><br><a href=$publicationrecord1>Detailed record</a><br><br>";
        echo "<h3>2017</h3>";
        echo "<a href=$publicationlink2>$publicationtext2</a><br><br><a href=$publicationrecord2>Detailed record</a><br><br>";
        echo "<a href=$publicationlink3>$publicationtext3</a><br><br><a href=$publicationrecord3>Detailed record</a><br><br>";
        echo "<a href=$publicationlink4>$publicationtext4</a><br><br><a href=$publicationrecord4>Detailed record</a><br><br>";
?>
	</div>
  	    </div><!-- .entry-content -->

	    <div class="entry-content standard-content-box <?php echo $listoflinks_width; ?>">
    <h2 class=people_titles>News</h2>
    <div class="sti_content_prof_text">
     <a name=news></a>
     <div class="frontrowcontent">
<?php
        echo "<div class='sti_people_news' style='background-image:url(\"$newsimage1\");'><div class=peoplenewstitle><a class=whitelink href=$newslink1>$newstitle1</a></div></div>";
        echo "<div class='sti_people_news' style='background-image:url(\"$newsimage2\");'><div class=peoplenewstitle><a class=whitelink href=$newslink2>$newstitle2</a></div></div>";
        echo "<div class='sti_people_news' style='background-image:url(\"$newsimage3\");'><div class=peoplenewstitle><a class=whitelink href=$newslink3>$newstitle3</a></div></div>";
        echo "<div class='sti_people_news' style='background-image:url(\"$newsimage4\");'><div class=peoplenewstitle><a class=whitelink href=$newslink4>$newstitle4</a></div></div>";
?>
     </div><?php # frontrowcontent ?>
    </div><?php # prof_text ?>
	    </div>
	 </div><!-- main row-->
	</div><!-- main container-->

     </div><!--column in case there is a list of links on the right-->


		<?php   
			// this box is a list of links 
			echo $menu;
                ?>
	



  </div><!--column if there is a box of links on the right-->
 </div><!--row if there is a box of links on the right-->
</div><!-- container if there is a box of links on the right-->
		<div class="entry-meta">

			<!---?php epflsti_posted_on(); --->

		</div><!-- .entry-meta -->
	<footer class="entry-footer">

		<?php epflsti_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
