<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $logged_user
 * @var \App\Model\Entity\Plan $logged_user_plan
 * @var \App\Model\Entity\Link $link
 * @var \App\Model\Entity\Announcement[]|\Cake\Collection\CollectionInterface $announcements
 * @var mixed $CurrentMonthDays
 * @var mixed $referral_earnings
 * @var mixed $total_earnings
 * @var mixed $total_views
 * @var mixed $year_month
 */
?>
<?php
$this->assign('title', __('Dashboard'));
$this->assign('description', '');
$this->assign('content_title', __('Dashboard'));
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary modern-filter-box">
                <div class="box-body text-center">
                    <?=
                    $this->Form->create(null, [
                        'type' => 'get',
                        'url' => ['controller' => 'Users', 'action' => 'dashboard'],
                        'class' => 'form-inline',
                        'style' => 'display: inline-block;',
                    ]);
                    ?>

                    <div class="form-group">
                        <label for="month" class="control-label" style="margin-right: 10px; font-weight: 500;"><?= __('Select Month:') ?></label>
                        <?=
                        $this->Form->control('month', [
                            'label' => false,
                            'options' => $year_month,
                            'value' => ($this->request->getQuery('month')) ? h($this->request->getQuery('month')) : '',
                            'class' => 'form-control input-lg',
                            'onchange' => 'this.form.submit();',
                            'style' => 'width: 300px; display: inline-block;',
                        ]);
                        ?>
                    </div>

                    <?= $this->Form->button(__('Submit'), ['class' => 'hidden']); ?>

                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row modern-stats-row">
        <div class="col-lg-3 col-md-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= number_format($total_views) ?></h3>
                    <p><?= __('Total Views') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= display_price_currency($total_earnings); ?></h3>
                    <p><?= __('Total Earnings') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar"></i>
                </div>
            </div>
        </div>

        <?php if ((bool)get_option('enable_referrals', 1)) : ?>
            <div class="col-lg-3 col-md-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= display_price_currency($referral_earnings); ?></h3>
                        <p><?= __('Referral Earnings') ?></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?= (!empty($total_views)) ? display_price_currency($total_earnings / $total_views * 1000) : 0 ?>
                    </h3>
                    <p><?= __('Average CPM') ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-line-chart"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>

<?php if (count($announcements) > 0) : ?>
    <div class="box box-primary modern-announcements-box">
        <div class="box-header with-border">
            <i class="fa fa-bullhorn"></i>
            <h3 class="box-title"><?= __("Announcements") ?></h3>
        </div>
        <div class="box-body modern-announcements-body">
            <?php foreach ($announcements as $announcement) : ?>
                <div class="announcement-item">
                    <div class="announcement-header">
                        <h5 class="announcement-title">
                            <i class="fa fa-info-circle"></i> <?= h($announcement->title); ?>
                        </h5>
                        <small class="announcement-date">
                            <i class="fa fa-clock-o"></i> <?= h($announcement->created); ?>
                        </small>
                    </div>
                    <div class="announcement-content">
                        <?= $announcement->content; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php unset($announcement) ?>
        </div>
    </div>
<?php endif; ?>

    <div class="box box-primary modern-stats-box">
        <div class="box-header with-border">
            <i class="fa fa-line-chart"></i>
            <h3 class="box-title"><?= __('Statistics') ?></h3>
        </div>
        <div class="box-body">
            <div id="chart_div" class="modern-chart-container"></div>
            <div class="chart-timezone-note">
                <small class="text-muted">
                    <i class="fa fa-info-circle"></i> <?= __('Data is reported in {0} timezone', get_option('timezone', 'UTC')) ?>
                </small>
            </div>
            <div class="table-responsive modern-stats-table-wrapper">
                <table class="table table-hover table-striped modern-stats-table">
                    <thead>
                    <tr>
                        <th><?= __('Date') ?></th>
                        <th class="text-right"><?= __('Views') ?></th>
                        <th class="text-right"><?= __('Link Earnings') ?></th>
                        <th class="text-right"><?= __('Daily CPM') ?></th>
                        <th class="text-right"><?= __('Referral Earnings') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($CurrentMonthDays as $key => $value) : ?>
                        <tr>
                            <td><strong><?= $key ?></strong></td>
                            <td class="text-right"><?= number_format($value['view']) ?></td>
                            <td class="text-right text-success"><strong><?= display_price_currency($value['publisher_earnings']); ?></strong></td>
                            <td class="text-right"><?= (!empty($value['view'])) ? display_price_currency(($value['publisher_earnings'] / $value['view']) * 1000) : 0 ?></td>
                            <td class="text-right text-info"><?= display_price_currency($value['referral_earnings']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
/*
    <div class="box box-success">
        <div class="box-header with-border">
            <i class="fa fa-fire"></i>
            <h3 class="box-title"><?= __("Top 10 Links") ?></h3>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th><?= __('Alias') ?></th>
                    <th><?= __('Views') ?></th>
                    <th><?= __('Link Earnings') ?></th>
                </tr>
                </thead>
                <?php foreach ($popularLinks as $link) : ?>
                    <?php
                    if (!$link->views) {
                        continue;
                    }
                    ?>
                    <?php
                    $short_url = get_short_url($link->link->alias, $link->link->domain);

                    $title = $link->link->alias;
                    if (!empty($link->link->title)) {
                        $title = $link->link->title;
                    }
                    ?>
                    <tr>
                        <td><a href="<?= $short_url ?>" target="_blank" rel="nofollow noopener noreferrer">
                                <span class="glyphicon glyphicon-link"></span> <?= h($title) ?></a></td>
                        <td><?= $link->views ?></td>
                        <td><?= display_price_currency($link->publisher_earnings); ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php unset($link) ?>
            </table>
        </div>
    </div>
*/
?>

<?php $this->start('scriptBottom'); ?>

    <link rel="stylesheet" href="https://fastly.jsdelivr.net/gh/almasaeed2010/AdminLTE@v2.3.11/plugins/morris/morris.css">
    <script src="https://fastly.jsdelivr.net/gh/DmitryBaranovskiy/raphael@v2.1.0/raphael-min.js"></script>
    <script src="https://fastly.jsdelivr.net/gh/almasaeed2010/AdminLTE@v2.3.11/plugins/morris/morris.min.js"
            type="text/javascript"></script>

    <script>
      jQuery(document).ready(function() {
        new Morris.Line({
          element: 'chart_div',
          resize: true,
          data: [
              <?php
              foreach ($CurrentMonthDays as $key => $value) {
                  echo '{date: "' . $key . '", views: ' . $value['view'] . '},';
              }
              ?>
          ],
          xkey: 'date',
          xLabels: 'day',
          ykeys: ['views'],
          labels: ['<?= __('Views') ?>'],
          lineColors: ['#3c8dbc'],
          lineWidth: 2,
          hideHover: 'auto',
          smooth: false,
        });
      });
    </script>

<?php $this->end();
