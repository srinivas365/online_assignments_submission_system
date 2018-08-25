<?php  
    $the_site = "https://stackoverflow.com/questions/43598781/scraping-images-from-url-using-php";
    $the_tag = "div"; #
    $the_class = "images";

    $html = file_get_contents($the_site);
    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    foreach ($xpath->query('//'.$the_tag.'[contains(@class,"'.$the_class.'")]/img') as $item) {

        $img_src =  $item->getAttribute('src');
        print $img_src."\n";

    }
?>