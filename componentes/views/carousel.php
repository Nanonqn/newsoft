<?php
    use yii\helpers\Html;
?>
<div id="carouselMain" class="carousel slide"
    <?php
    if($settings['autoplay'] == false ){
        echo 'data-interval="false"';
    }
    ?>
     data-ride="carousel">
    <!-- Indicators -->
    <?php
    if ($settings['show_indicators']){
        echo '<ol class="carousel-indicators">
      <li data-target="#carouselMain" data-slide-to="0" 
          class="active"></li>';
        foreach (range(1, $count) as $number) {
            echo '<li data-target="#carouselMain" data-slide-to="'.$number.'"></li>';
        }
        echo '</ol> ';
    }
    ?>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <!-- dynamic slide data -->
        <?php
        $width = $settings['width'];
        $height = $settings['height'];
        //active item first
        echo '<div class="item active">
                  <center>'.
            Html::img(Yii::$app->urlManagerBackend->baseUrl. '/' .
                $activeImage['marketingImagePath'], ['width' => $width, 'height' => $height ])
            .'</center>';
        if($settings['show_captions']){
            echo '<div class="carousel-caption">';
            if ($settings['show_caption_title']){
                echo '<div><h1>' . $activeImage['marketingImageCaptionTitle'] . '</h1></div>';
            }
            echo $activeImage['marketingImageCaption'] . '</div>';
        }
        echo '</div>';
        //all other images
        foreach ($images as $image){
            echo '<div class="item">  
                  <center>' .
                Html::img(Yii::$app->urlManagerBackend->baseUrl . '/' .
                    $image['marketingImagePath'], ['width' => $width, 'height' => $height ])
                . '</center>';

            if($settings['show_captions']){

                echo '<div class="carousel-caption">';

                if ($settings['show_caption_title']){

                    echo   '<div><h1>' . $image['marketingImageCaptionTitle']. '</h1></div>';

                }

                echo $image['marketingImageCaption'].' </div>';

            }

            echo '</div>';

        }

        ?>

        <!-- end dynamic slide data -->

    </div>

    <!-- Controls -->

    <?php

    if ($settings['show_controls']){

        echo '<a class="left carousel-control" href="#carouselMain" role="button" 
            data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselMain" role="button" 
            data-slide="next">
           <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
           <span class="sr-only">Next</span>
           </a>';
    }

    ?>

</div>