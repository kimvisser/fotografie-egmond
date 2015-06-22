<?php

/**
 * Created by PhpStorm.
 * User: kim
 * Date: 22-6-2015
 * Time: 20:26
 */
class Portfolio
{
    public function getCategories()
    {
        return [
            array("key" => "all", "i18n" => "Alles")
            , array("key" => "strand", "i18n" => "Strand")
            , array("key" => "duin", "i18n" => "Duin")
            , array("key" => "vuurtoren", "i18n" => "Vuurtoren")
        ];
    }

    public function getPhotos()
    {
        return [
            new Photo("Strand", "Strand", "strand", "20120512__Strand.jpg", "http://fotografieegmond.werkaandemuur.nl")
        ];
    }
}

class Photo
{
    public $title;
    public $description;
    public $category;
    public $pathOnServer;
    public $linkToExternal;

    function __construct($name, $description, $category, $pathOnServer, $linkToExternal)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->pathOnServer = $pathOnServer;
        $this->linkToExternal = $linkToExternal;
    }
}

class PhotoTemplate
{
    private $tpl = <<<EOT
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
                <!-- <p>released: 2008</p> -->
            </div>
        </li>
EOT;

    function __construct($photo)
    {

    }

    function getHtml()
    {
        return $this->tpl;
    }
}