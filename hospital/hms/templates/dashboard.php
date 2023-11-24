<?php $userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> <?php echo $userTypeString; ?> | Dashboard</title>

    <?php include_once("../include/head_links.php");
    echo generate_head_links(); ?>
    <>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">

            <?php include('../include/header.php'); ?>

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle"> <?php echo $userTypeString; ?> | Dashboard</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span><?php echo $userTypeString; ?></span>
                                </li>
                                <li class="active">
                                    <span>Dashboard</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row" style="align-items: stretch;">
                            <?php foreach ($dashItems as $dashItem) { ?>
                                <div class="col-md-4 col-sm-6 col-12" style="text-overflow:ellipsis;">
                                    <div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-<?= $dashItem['icon'] ?> fa-stack-1x fa-inverse"></i> </span>
                                            <h2 class="StepTitle" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $dashItem['title'] ?></h2>

                                            <p class="links cl-effect-1">
                                                <a href="<?= $dashItem['href'] ?>">
                                                    <?php if (isset($dashItem['linkText'])) {
                                                        echo $dashItem['linkText'];
                                                    } else {
                                                        echo $dashItem['linkFunction']();
                                                    } ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- start: FOOTER -->
                <?php include('../include/footer.php'); ?>
                <!-- end: FOOTER -->

                <!-- start: SETTINGS -->
                <?php include('../include/setting.php'); ?>
                <>
                    <!-- end: SETTINGS -->
            </div>
            <?php include_once("../include/body_scripts.php");
            ?>
            <script>
                jQuery(document).ready(function() {
                    Main.init();
                    FormElements.init();
                });
            </script>
            <!-- end: JavaScript Event Handlers for this page -->
            <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>