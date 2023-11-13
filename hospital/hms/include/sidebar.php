<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <nav>
            <!-- start: MAIN NAVIGATION MENU -->
            <div class="navbar-title">
                <span>Main Navigation</span>
            </div>
            <ul class="main-navigation-menu">
                <?php foreach ($items as $item) {
                    if (isset($item['href'])) { ?>
                        <li>
                            <a href="<?= $item['href'] ?>">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-<?= $item['icon'] ?>"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> <?= $item['name'] ?> </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="javascript:void(0)">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-<?= $item['icon'] ?>"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> <?= $item['name'] ?> </span><i class="icon-arrow"></i>
                                    </div>
                                </div>
                            </a>
                            <ul class="sub-menu">
                                <?php foreach ($item['subitems'] as $subitem) {  ?>
                                    <li>
                                        <a href="<?= $subitem['href'] ?>">
                                            <span class="title"> <?= $subitem['name'] ?> </span>
                                        </a>
                                    </li>
                        </li>
                    <?php } ?>
            </ul><?php }
                } ?>
    </ul>
    <!-- end: CORE FEATURES -->
        </nav>
    </div>
</div>
<?php
