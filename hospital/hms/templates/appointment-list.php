<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <?php
    $pageName = 'Appointment List';
    include('../include/new-header.php');
    ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include('./include/nav.php'); ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include('../include/navbar.php'); ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="table-responsive text-nowrap">
                                            <!-- Dropdown Filter -->
                                            <form action="" method="GET" class="mb-3 row g-2 align-items-end">
                                                <div class="col-md-3">
                                                    <label for="filterStatus" class="form-label">Filter by Status: <?php echo $filter_value !== '' ? $FILTER_OPTIONS[$filter_value] : ''; ?></label>
                                                    <select id="filterStatus" name="filter" class="form-select">
                                                        <option value="" <?php if ($filter_value === '') echo 'selected'; ?>>All</option>
                                                        <?php
                                                        foreach ($FILTER_OPTIONS as $value => $name) {
                                                            echo $filter_value === $value ? "<option value=\"{$value}\" selected>{$name}</option>" : "<option value=\"{$value}\">{$name}</option>";
                                                        }
                                                        ?>
                                                        <!-- Add more status options as needed -->
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                                                </div>
                                            </form>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                                        <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                                    <table class="table table-hover" id="sample-table-1">
                                                        <thead>
                                                            <tr>
                                                                <?php echo $tableHeadRow ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql = mysqli_execute_query($con, $countStr . $whereClause, $queryParams);
                                                            $row = mysqli_fetch_row($sql);
                                                            $total_records = $row[0];

                                                            if ($total_records) {
                                                                $total_pages = ceil($total_records / $ITEMS_PER_PAGE);

                                                                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                                                if ($current_page > $total_pages) $current_page = $total_pages;
                                                                elseif ($current_page <= 0) $current_page = 1;

                                                                $offset = ($current_page - 1) * $ITEMS_PER_PAGE;

                                                                $queryStr .=  $whereClause . " ORDER BY appointments.id DESC LIMIT {$offset}, {$ITEMS_PER_PAGE}";
                                                                $sql = mysqli_execute_query($con, $queryStr, $queryParams);

                                                                $cnt = 1;

                                                                while ($row = mysqli_fetch_array($sql)) {
                                                            ?>
                                                                    <tr>
                                                                        <td class="center"><?php echo $cnt; ?>.</td>
                                                                        <?php $rowContents =  getTableRowContents($row);
                                                                        foreach ($rowContents as $rowCell) {
                                                                            if (is_array($rowCell)) {
                                                                                if (isset($rowCell['class'])) {
                                                                                    echo '<td class="' . $rowCell['class'] . '">' . $rowCell['value'] . '</td>';
                                                                                } else {
                                                                                    echo '<td>';
                                                                                    foreach ($rowCell as $action) {
                                                                        ?>
                                                                                        <a href="<?php echo $action['href'] ?>" onClick="return confirm('<?php echo $action['prompt'] ?>')" class="btn btn-transparent btn-xs tooltips" title="<?php echo $action['title'] ?>" tooltip-placement="top" tooltip="Remove"><i class="bx bx-<?php echo $action['icon'] ?>"></i></a>
                                                                        <?php
                                                                                    }
                                                                                    echo '</td>';
                                                                                }
                                                                            } else {
                                                                                echo "<td>$rowCell</td>";
                                                                            }
                                                                        } ?>
                                                                    </tr>
                                                                <?php
                                                                    $cnt = $cnt + 1;
                                                                }
                                                            } else { ?>
                                                                <tr>
                                                                    <td colspan="<?php echo $tableColCount; ?>" class="text-center">No appointments found using given filter.</td>
                                                                </tr>
                                                            <?php
                                                            } ?>


                                                        </tbody>
                                                    </table>
                                                    <?php if ($total_records) { ?>
                                                        <div class="col-md-12 mt-4 text-center">
                                                            <p>Showing <?php echo $offset + 1 ?> - <?php echo min($total_records, $offset + $ITEMS_PER_PAGE) ?> of <?php echo $total_records ?></p>
                                                            <div class="d-flex justify-content-center">
                                                                <ul class="pagination">

                                                                    <!-- First page button -->
                                                                    <li>
                                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='?page=1&filter=<?php echo urlencode($filter_value); ?>';" <?php echo $current_page == 1 ? 'disabled' : ''; ?>>First</button>
                                                                    </li>
                                                                    &nbsp; &nbsp;
                                                                    <!-- Previous page button -->
                                                                    <li>
                                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='?page=<?php echo max($current_page - 1, 1); ?>&filter=<?php echo urlencode($filter_value); ?>';" <?php echo $current_page == 1 ? 'disabled' : ''; ?>>&laquo; Previous</button>
                                                                    </li>
                                                                    &nbsp; &nbsp;
                                                                    <!-- Next page button -->
                                                                    <li>
                                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='?page=<?php echo min($current_page + 1, $total_pages); ?>&filter=<?php echo urlencode($filter_value); ?>';" <?php echo $current_page == $total_pages ? 'disabled' : ''; ?>>Next &raquo;</button>
                                                                    </li>
                                                                    &nbsp; &nbsp;
                                                                    <!-- Last page button -->
                                                                    <li>
                                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='?page=<?php echo $total_pages; ?>&filter=<?php echo urlencode($filter_value); ?>';" <?php echo $current_page == $total_pages ? 'disabled' : ''; ?>>Last</button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="content-backdrop fade"></div>
                                            <!-- Content wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Layout page -->

                            <!-- Overlay -->
                            <div class="layout-overlay layout-menu-toggle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main JS -->
            <!-- start: PDF GEN JAVASCRIPTS -->
            <?php include('../include/links.php'); ?>

            <script>
                jQuery(document).ready(function() {
                    Main.init();
                    FormElements.init();
                });
            </script>
</body>

</html>