    <div class="row content">
        <div id="gallery" class="large-12 small-12 columns">
            <dl class="sub-nav" id="gallery-source">
              <dt>Categorie:</dt>
              <dd class="active"><a href="portfolio/all" id="category-all">Alles</a></dd>
              <dd><a href="portfolio/strand" 				id="category-strand">Strand</a></dd>
              <dd><a href="portfolio/duin" 					id="category-duin">Duin</a></dd>
              <dd><a href="portfolio/vuurtoren" 			id="category-vuurtoren">Vuurtoren</a></dd>
            </dl>

            <ul id="gallery-destination_all" class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
                <!-- strand -->
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20120512__Strand.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20121007__GolfbrekerSchoorl.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20121111__ZonsondergangHargenAanZee.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20130727__ZonsondergangStrandEgmondBinnen1.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20130902__Strandstoelen.jpg&size=<300' /></li>

              <!-- duinen -->
              <li><img class="th" src='app/thumb.php?src=../gallery/20__Duinen/20121111__Duinbos.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/20__Duinen/20131115__SpiegelDuinen.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/20__Duinen/20140816__PaarseDuinenPanorama.jpg&size=<300' /></li>

              <!-- vuurtoren -->
              <li><img class="th" src='app/thumb.php?src=../gallery/40__Vuurtoren/20120614__HekVoorVuurtorenVanSpeijkHorizontaal.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/40__Vuurtoren/20120614__PadVuurtorenVanSpeijk.jpg&size=<300' /></li>
            </ul>

            <ul id="gallery-destination_strand" class="hidden small-block-grid-1 medium-block-grid-2 large-block-grid-3">
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20120512__Strand.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20121007__GolfbrekerSchoorl.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20121111__ZonsondergangHargenAanZee.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20130727__ZonsondergangStrandEgmondBinnen1.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/10__Strand/20130902__Strandstoelen.jpg&size=<300' /></li>
            </ul>

            <ul id="gallery-destination_duin" class="hidden small-block-grid-1 medium-block-grid-2 large-block-grid-3">
              <li><img class="th" src='app/thumb.php?src=../gallery/20__Duinen/20121111__Duinbos.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/20__Duinen/20131115__SpiegelDuinen.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/20__Duinen/20140816__PaarseDuinenPanorama.jpg&size=<300' /></li>
            </ul>

            <ul id="gallery-destination_vuurtoren" class="hidden small-block-grid-1 medium-block-grid-2 large-block-grid-3">
              <li><img class="th" src='app/thumb.php?src=../gallery/40__Vuurtoren/20120614__HekVoorVuurtorenVanSpeijkHorizontaal.jpg&size=<300' /></li>
              <li><img class="th" src='app/thumb.php?src=../gallery/40__Vuurtoren/20120614__PadVuurtorenVanSpeijk.jpg&size=<300' /></li>
            </ul>

        </div>
    </div>

    <script>
        $(function() {
          $('#category-strand').click(function(e) {
             $('#gallery-destination_all').quicksand( $('#gallery-destination_strand li'), {
                duration: 1000,
                attribute: 'id'
             });
             $('#gallery-destination_strand').show();
             e.preventDefault();
          });

          $('#category-duin').click(function(e) {
             $('#gallery-destination_all').quicksand( $('#gallery-destination_duin li'), {
                duration: 1000,
                attribute: 'id'
             });
             $('#gallery-destination_duin').show();
             e.preventDefault();
          });

          $('#category-vuurtoren').click(function(e) {
             $('#gallery-destination_all').quicksand( $('#gallery-destination_vuurtoren li'), {
                duration: 1000,
                attribute: 'id'
             });
             $('#gallery-destination_vuurtoren').show();
             e.preventDefault();
          });

      });
    </script>