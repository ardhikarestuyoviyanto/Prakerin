<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <?php if(isset($agenda)): ?>
    <?php foreach($agenda as $x): ?>
    <meta property="og:image" content="<?= base_url('assets/agenda/'.$x->gambar) ?>">
    <meta property="og:image:width" content="450">
    <meta property="og:image:height" content="298">
    <?php endforeach; ?>
    <?php endif; ?> 
    <title><?= $title; ?> <?php foreach($app as $x): echo $x->nama_app; endforeach; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>