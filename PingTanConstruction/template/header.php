<header id="header">
    <section class="top">
        <div class="container_12">
            <div class="grid_12 txt1">
                <h1><a href="index.php"><img src="./images/pingtanLogo.png"></a></h1>
                <section class="menu">
                    <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                        <ul class="sf-menu">
                            <li <?php if($current == 'home') {echo 'class="current"';} ?>>
                                <a href="index.php">home</a>
                            </li>
                            <li <?php if($current == 'about us' || $current == 'our team') 
                                        {echo 'class="current"';} ?>><a href="#">about</a>
                                <ul>
                                    <li><a href="aboutUs.php">about us</a></li>
                                    <!--<li><a href="#">news</a>
                                        <ul>
                                            <li><a href="#">latest</a></li>
                                            <li><a href="#">archive</a></li>
                                        </ul>
                                    </li>-->
                                    <li><a href="team.php">our team</a></li>
                               </ul>
                            </li>
                            <li <?php if($current == 'services') {echo 'class="current"';} ?>>
                                <a href="service.php">services</a></li> 
                            <li <?php if($current == 'projects') {echo 'class="current"';} ?>>
                                <a href="project.php">projects</a></li>
                            <li <?php if($current == 'career') {echo 'class="current"';} ?>>
                                <a href="career.php">career</a></li>
                            <li <?php if($current == 'contacts') {echo 'class="current"';} ?>>
                                <a href="contact.php">contacts</a></li>
                        </ul>
                    </nav>
                </section>
            </div>
        </div>
    </section>
</header>