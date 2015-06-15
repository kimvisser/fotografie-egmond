		<div class="row">
			<div class="large-12 hide-for-small">
				<div id="featured" data-orbit>
				<?php
				if ($handle = opendir('img/header/')) {
					 while (false !== ($entry = readdir($handle))) {
						  if ($entry != "." && $entry != ".." && strpos($entry,'jpg')) {
								echo "<img src=\"img/header/$entry\" alt=\"&copy; Fotografie-Egmond\">\n";
						  }
					 }
					 closedir($handle);
				}
				?>
				</div>
			</div>
		</div>		
   
      <div class="row content">
         <div class="small-12 large-8 columns">

            <article>
               <h3>Grote portfolio update! (23 augustus 2014)</h3>
               <div class="row">
               <div class="large-4 columns">
                  <p>We hebben een grote portfolio update doorgevoerd! 
				  Veel nieuwe foto's in de volgende categorieen: <a href="portfolio/10__Strand/">Strand</a>, <a href="portfolio/20__Duinen/">Duinen</a>, <a href="portfolio/40__Vuurtoren/">Vuurtoren</a>, <a href="portfolio/60__Tulpen/">Tulpen</a>, <a href="portfolio/80__Wildlife/">Wildlife</a> en een nieuwe categorie <a href="portfolio/90__Polder">Polder</a>.
				  De foto's in het portfolio zijn voorzien van een watermerk, uiteraard geldt dit niet voor de foto's die u daadwerkelijk bestelt. Bestellen van afdrukken kan vanuit het <a href="portfolio">portfolio</a>. Mocht u vragen hebben <a href="contact">laat het ons dan weten</a>.</p>
               </div>
               <div class="large-8 columns">
                  <img class="border" src="img/news/201408/newstuff.jpg" />
               </div>
               </div>
            </article>
            
            <article>
               <h3>Nieuwe foto's (7 jan 2014)</h3>
               <div class="row">
               <div class="large-4 columns">
                  <p>We hebben weer 7 nieuwe foto's aan de portfolio toegevoegd. Bestellen van afdrukken kan vanuit het <a href="portfolio">portfolio</a>. Mocht u vragen hebben <a href="contact">laat het ons dan weten</a>.</p>
               </div>
               <div class="large-8 columns">
                  <img class="border" src="img/news/201401/Strand.jpg" />
               </div>
               </div>
            </article>
            
            <article>
               <h3>Welkom op www.fotografie-egmond.nl!</h3>
               <div class="row">
               <div class="large-6 columns">
                  <p>Welkom op de nieuwe website van Fotografie Egmond. Wij bieden u een gebalanceerd aanbod van landschaps-en natuurfoto's uit vooralsnog 
                  de omgeving van de Egmonden die door u als vergroting, op canvas of op acryluxe te bestellen zijn voor thuis aan de muur, of in uw bedrijfsruimte.</p>
                  <p>Wij streven ernaar om een standaard neer te zetten die meer biedt dan "een leuk kiekje". Onze selectieprocedure laat dan ook enkel het meest hoogwaardige 
                  materiaal wat wij zelf maken door waarna het hier op de website beschikbaar komt en te <a href="portfolio">bestellen</a> is.</p>
                  <p>Wanneer u aparte wensen heeft voor een foto kunt u altijd <a href="contact">contact</a> met ons opnemen, dan kunnen wij op die specifieke wens inspelen.</p>
                  <p>Volg ons ook op facebook!
                  <div class="fb-follow" data-href="https://www.facebook.com/fotografieegmond" data-width="200" data-show-faces="true"></div>
                  </p>
               </div>
               <div class="large-6 columns">
                  <img class="border" src="img/20120614__HekVoorVuurtorenVanSpeijkVerticaal.jpg" />
               </div>
               </div>
            </article>

         </div>
         
         <div class="small-0 large-4 columns hide-for-small-only">
            <div class="fb-like" data-ref="news" data-href="http://www.fotografie-egmond.nl" data-width="200" data-colorscheme="light" data-show-faces="true" data-send="false"></div>
            <div id="PixxerSelection"></div><br clear=all>
         </div>
      </div>
