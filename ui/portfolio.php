<?php
include 'app/portfolio.php';
$portfolio = new Portfolio();
?>

<div class="row content">
    <dl class="sub-nav portfolio-category filter">
        <dt>Categorie:</dt>
        <?php
        $firstCategory='class="active"';
        foreach ($portfolio->getCategories() as $category) {
            echo "<dd $firstCategory><a href=\"#\" class=\"".$category["key"]."\">".$category["i18n"]."</a></dd>";
            $firstCategory="";
        }
        ?>
    </dl>

    <div id="gallery" class="large-12 small-12 columns">
        <ul class="portfolio-area small-block-grid-1 medium-block-grid-2 large-block-grid-3">

            <?php
            $idx = 0;
            foreach ($portfolio->getPhotos() as $photo) {

            }
            ?>

            <li class="portfolio-item2" data-id="id-0" data-type="strand">
                <a href="gallery/10__Strand/20120512__Strand.jpg"
                   rel="prettyPhoto[ gallery ]"
                   title="Wall-E">
                    <img src="app/thumb.php?src=../gallery/10__Strand/20120512__Strand.jpg&size=<300"
                         class="th"
                         alt="Wall-E"
                         title="Wall-E"/>
                </a>

                <div class="home-portfolio-text">
                    <h5><a href="#" rel="bookmark" title="Wall-E">Wall-E</a></h5>
                    <!--                        <p>released: 2008</p>-->
                </div>
            </li>

            <li class="portfolio-item2" data-id="id-1" data-type="strand">
                <a href="gallery/10__Strand/20121007__GolfbrekerSchoorl.jpg"
                   rel="prettyPhoto[ gallery ]"
                   title="Wall-E">
                    <img src="app/thumb.php?src=../gallery/10__Strand/20121007__GolfbrekerSchoorl.jpg&size=<300"
                         class="th"
                         alt="Wall-E"
                         title="Wall-E"/>
                </a>

                <div class="home-portfolio-text">
                    <h5><a href="#" rel="bookmark" title="Wall-E">Wall-E</a></h5>
                    <!--                        <p>released: 2008</p>-->
                </div>
            </li>

            <li class="portfolio-item2" data-id="id-2" data-type="strand">
                <a href="gallery/10__Strand/20121111__ZonsondergangHargenAanZee.jpg"
                   rel="prettyPhoto[ gallery ]"
                   title="Wall-E">
                    <img src="app/thumb.php?src=../gallery/10__Strand/20121111__ZonsondergangHargenAanZee.jpg&size=<300"
                         class="th"
                         alt="Wall-E"
                         title="Wall-E"/>
                </a>

                <div class="home-portfolio-text">
                    <h5><a href="#" rel="bookmark" title="Wall-E">Wall-E</a></h5>
                    <!--                        <p>released: 2008</p>-->
                </div>
            </li>

            <li class="portfolio-item2" data-id="id-3" data-type="strand">
                <a href="gallery/10__Strand/20130727__ZonsondergangStrandEgmondBinnen1.jpg"
                   rel="prettyPhoto[ gallery ]"
                   title="Wall-E">
                    <img
                        src="app/thumb.php?src=../gallery/10__Strand/20130727__ZonsondergangStrandEgmondBinnen1.jpg&size=<300"
                        class="th"
                        alt="Wall-E"
                        title="Wall-E"/>
                </a>

                <div class="home-portfolio-text">
                    <h5><a href="#" rel="bookmark" title="Wall-E">Wall-E</a></h5>
                    <!--                        <p>released: 2008</p>-->
                </div>
            </li>

            <li class="portfolio-item2" data-id="id-4" data-type="duin">
                <a href="gallery/20__Duinen/20121111__Duinbos.jpg"
                   rel="prettyPhoto[ gallery ]"
                   title="Wall-E">
                    <img src="app/thumb.php?src=../gallery/20__Duinen/20121111__Duinbos.jpg&size=<300"
                         class="th"
                         alt="Wall-E"
                         title="Wall-E"/>
                </a>

                <div class="home-portfolio-text">
                    <h5><a href="#" rel="bookmark" title="Wall-E">Wall-E</a></h5>
                    <!--                        <p>released: 2008</p>-->
                </div>
            </li>

        </ul>
    </div>
</div>

