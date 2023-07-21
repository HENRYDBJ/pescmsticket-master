<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include $tool_column; ?>

<?php if (empty($list)): ?>
    <div class="am-alert am-alert-secondary am-margin-top am-margin-bottom am-text-center" data-am-alert>
        <p>本页面没有数据 :-(</p>
    </div>
<?php else: ?>
    <form class="am-form ajax-submit" action="<?= $label->url(GROUP . '-' . MODULE . '-listsort'); ?>" method="POST">
        <input type="hidden" name="method" value="PUT"/>
        <table class="am-table am-table-bordered am-table-striped am-table-hover am-text-sm">
            <tr>
                <?php if ($listsort): ?>
                    <th class="table-sort">排序</th>
                <?php endif; ?>
                <th class="table-set">ID</th>
                <?php foreach ($field as $value) : ?>
                    <?php if ($value['field_name'] == 'status'): ?>
                        <?php $class = 'table-set'; ?>
                    <?php else: ?>
                        <?php $class = 'table-title'; ?>
                    <?php endif; ?>
                    <th class="<?= $class ?>"><?= $value['field_display_name']; ?></th>
                <?php endforeach; ?>
                <th class="table-set">操作</th>
            </tr>
            <?php foreach ($list as $key => $value) : ?>
                <tr>
                    <?php if ($listsort): ?>
                        <td class="am-text-middle">
                            <input type="text" class="am-input-sm" name="id[<?= $value["{$fieldPrefix}id"]; ?>]"
                                   value="<?= $value["{$fieldPrefix}listsort"]; ?>">
                        </td>
                    <?php endif; ?>
                    <td class="am-text-middle"><?= $value["{$fieldPrefix}id"]; ?></td>
                    <?php foreach ($field as $fv) : ?>
                        <td class="am-text-middle">
                            <?= $label->valueTheme($fv, $fieldPrefix, $value); ?>
                            <?php if($fv['field_name'] == 'cid'): ?>
                                - <?= $value["{$fieldPrefix}name"] ?>
                            <?php elseif($fv['field_name'] == 'number'): ?>
                                <a href="<?= $label->url('Category-ticket', ['number' => $value["{$fieldPrefix}number"]]) ?>" target="_blank"><i class="am-icon-external-link"></i></a>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>


                    <td class="am-text-middle">
                        <?php /* 若要实现自定义的操作按钮，请更改本变量 */ ?>
                        <?php $operate = empty($operate) ? '/Content/Content_index_operate.php' : $operate;  ?>
                        <?php include THEME_PATH . $operate; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="am-g am-g-collapse">
            <div class="am-u-sm-12 am-u-lg-6">
                <?php if ($listsort): ?>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm am-radius">排序</button>
                <?php endif; ?>
            </div>
            <div class="am-u-sm-12 am-u-lg-6">
                <ul class="am-pagination am-pagination-right am-text-sm am-margin-0">
                    <?= $page; ?>
                </ul>
            </div>
        </div>
    </form>
<?php endif; ?>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>