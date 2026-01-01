<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $user = $this->request->getSession()->read('Auth.User'); ?>
<!DOCTYPE html>
<html lang="<?= locale_get_primary_language('') ?>">

<head>
    <?= $this->Html->charset(); ?>
    <title><?= h($this->fetch('title')); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= h($this->fetch('description')); ?>">
    <meta name="keywords" content="<?= h(get_option('seo_keywords')); ?>">

    <?= $this->Html->meta('icon'); ?>

    <?= $this->Assets->css('/vendor/bootstrap/css/bootstrap.min.css?ver=' . APP_VERSION); ?>
    <?= $this->Assets->css('/vendor/font-awesome/css/font-awesome.min.css?ver=' . APP_VERSION); ?>
    <?= $this->Assets->css('/vendor/animate.min.css?ver=' . APP_VERSION); ?>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <?= $this->Assets->css('front.css?ver=' . APP_VERSION); ?>
    <?= $this->Assets->css('app.css?ver=' . APP_VERSION); ?>

    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');

    ?>

    <?= get_option('head_code'); ?>

    <?= $this->fetch('scriptTop') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index <?= ($this->request->getParam('_name') === 'home') ? 'home' : 'inner-page' ?>">
<?= get_option('after_body_tag_code'); ?>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top modern-nav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"><?= __('Toggle navigation') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?php
            $logo = get_logo();
            $class = '';
            if ($logo['type'] == 'image') {
                $class = 'logo-image';
            }
            ?>
            <a class="navbar-brand <?= $class ?>" href="<?= build_main_domain_url('/'); ?>"><?= $logo['content'] ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?=
            menu_display('menu_main', [
                'ul_class' => 'nav navbar-nav navbar-right',
                'li_class' => '',
                'a_class' => '',
            ], true);
            ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<footer class="modern-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 footer-section">
                <h5 class="footer-title"><?= h(get_option('site_name')) ?></h5>
                <p class="footer-description"><?= __('Shorten URLs and earn money with our professional link shortener platform.') ?></p>
                <div class="social-links">
                    <?php if (get_option('facebook_url')) : ?>
                        <a href="<?= h(get_option('facebook_url')) ?>" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_option('twitter_url')) : ?>
                        <a href="<?= h(get_option('twitter_url')) ?>" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 footer-section">
                <h5 class="footer-title"><?= __('Quick Links') ?></h5>
                <?=
                menu_display('menu_footer', [
                    'ul_class' => 'footer-links',
                    'li_class' => '',
                    'a_class' => '',
                ]);
                ?>
            </div>
            <div class="col-md-4 col-sm-6 footer-section">
                <h5 class="footer-title"><?= __('Contact') ?></h5>
                <p class="footer-info"><?= __('Need help? Contact our support team.') ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="footer-bottom">
                    <p class="copyright"><?= __('Copyright &copy;') ?> <?= date("Y") ?> <?= h(get_option('site_name')) ?>. <?= __('All rights reserved.') ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script data-cfasync="false" src="<?= $this->Assets->url('/js/ads.js?ver=' . APP_VERSION) ?>"></script>

<?= $this->Assets->script('/vendor/jquery.min.js?ver=' . APP_VERSION); ?>
<?= $this->Assets->script('/vendor/bootstrap/js/bootstrap.min.js?ver=' . APP_VERSION); ?>
<?= $this->Assets->script('/vendor/wow.min.js?ver=' . APP_VERSION); ?>
<?= $this->Assets->script('/vendor/clipboard.min.js?ver=' . APP_VERSION); ?>

<?= $this->element('js_vars'); ?>

<!-- Custom Theme JavaScript -->
<?= $this->Assets->script('front'); ?>
<?= $this->Assets->script('app.js?ver=' . APP_VERSION); ?>

<?= $this->fetch('scriptBottom') ?>
<?= get_option('footer_code'); ?>

</body>
</html>
