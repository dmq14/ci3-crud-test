<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'My App' ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <div id="loading-spinner" class="loading-spinner">
        <div class="div-spinner">
            <div class="spinner-border text-dark" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
        if (isset($_view) && $_view) {
            $this->load->view($_view);
        }
        ?>
    </div>
</body>
</html>
