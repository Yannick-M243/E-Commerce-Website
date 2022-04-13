<?php
require "header2.php";
?>

<main class="enri">
    <h1>Yannick Store</h1>

    <!--2x2 Image text grid-->
    <section class="wrapper" id="features-grid">
        <div class="features-grid-container txt-center">

            <!--first Row text-image-->
            <div class="d-flex-r features-grid-row" id="first-row">

                <!--first half for the image-->
                <div class="features-grid-row-img w-50">
                    <img src="./img/home1.jpg" alt="">
                </div>

                <!--second half for text-->
                <div class="w-50">
                    <div class="m-3">
                        <h2 class="font-x2">Sneakers</h2>
                        <div>
                            <p class="font-xs">Yannick Store focus on selective brands with personal touch designs, fabric and culture on every pair sold by us.
                                You can find anything from a OG Nike Air Force to some wild chuck Taylor ready for you everyday styling.</p>
                        </div>
                    </div>
                </div>
            </div>


            <!--second Row image-text-->
            <div class="d-flex-r features-grid-row" id="second-row">
                <!--second half for the image-->
                <div class="features-grid-row-img w-50">
                    <img src="./img/home2.jpg" alt="">
                </div>

                <!--fist half for text-->
                <div class="w-50">
                    <div class="m-3">
                        <h2 class="font-x2">StreetWear</h2>
                        <div>
                            <p class="font-xs">Yannick focus on selective brands with personal touch designs, fabric and culture on every garments sold by us.
                                You can find anything from OG Palace to some awesome graphict tees ready for your casual dressing. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require "footer.php";
?>