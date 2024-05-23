@extends('themes.theme1.layouts.app')
@section('content')
<!-- single brand -->
<section class="category-page single_brand">
    <!-- container -->
    <div class="pixel-container">
        <!-- row -->
        <div class="wrap">
            <!-- header -->
            <section class="s-block">
                <!-- brand data -->
                <div class="brand_data">
                    <!-- img -->
                    <div class="brand_img">
                        <img class="" src="images/brands/XspQyl8oKzYAkn4AvIFtB4CNeIMsL8rN3388ojJx.webp" alt="Dior">
                    </div>
                    <!-- ./img -->
                    <!-- title -->
                    <div class="brand_title">
                        <h1>Dior</h1>
                        <p>For a bolder and more attractive look</p>
                    </div>
                    <!-- ./title -->
                </div>
                <!-- ./brand data -->
            </section>
            <!-- ./header -->

            <!-- header -->
            <section class="s-block">
                <!-- brand product items -->
                <div class="brand_products">
                    <?php include "blocks/items/item-01.php"?>
                    <?php include "blocks/items/item-02.php"?>
                    <?php include "blocks/items/item-03.php"?>
                    <?php include "blocks/items/item-04.php"?>
                    <?php include "blocks/items/item-05.php"?>
                    <?php include "blocks/items/item-06.php"?>
                    <?php include "blocks/items/item-07.php"?>
                    <?php include "blocks/items/item-08.php"?>
                </div>
                <!-- ./brand product items -->
            </section>
            <!-- ./header -->

        </div>
        <!-- ./row -->
    </div>
    <!-- ./container -->
</section>
<!-- ./single brand -->
@endsection
