<div class="panel-heading closed" data-parent="#checkout-options" data-target="#anchor-reorder" data-toggle="collapse">
  <h4 class="panel-title" id="title-reorder">
    <a href="#a">
      <span class="fa fa-magnet"></span>
        <?= Yii::t('main', 'Дозаказ') ?>
        <?
        if (isset($this->post['easyCheckout']['reorder']) && $this->post['easyCheckout']['reorder']) {
            echo ': ' . Yii::app()->user->id . '-' . $this->post['easyCheckout']['reorder'];
        }
        ?>
    </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
  </h4>
</div>
<div class="panel-collapse collapse" id="anchor-reorder">
  <div class="panel-body">
    <div class="row co-row">
      <!------------------------------------->
      <div style="display: none;">
        <input type="radio" name="easyCheckout[reorder]" value="0" onclick="extSubmit('anchor-reorder');"
               <? if (empty($this->post) || !isset($this->post['easyCheckout']['reorder']) ||
               $this->post['easyCheckout']['reorder'] == 0) { ?>checked<? } ?> />
      </div>
      <!------------------------------------->

        <? $this->widget(
          'booster.widgets.TbGridView',
          [
            'id'            => 'orders-grid',
            'dataProvider'  => $this->ordersForReorder,
            'enableSorting' => false,
            'pager'         => [
              'header'         => '',
              'firstPageLabel' => '&lt;&lt;',
              'prevPageLabel'  => '&lt;',
              'nextPageLabel'  => '&gt;',
              'lastPageLabel'  => '&gt;&gt;',
            ],
            'template'      => '{summary}{items}{pager}',
            'summaryText'   => Yii::t('main', 'Заказы') . ' {start}-{end} ' .
              Yii::t('main', 'из') . ' {count}',
            'columns'       => [
              [
                'name'  => 'id',
                'type'  => 'raw', //$model->id
                'value' => function ($data) use (&$post) {
                    $checked = '';
                    if ($post &&
                      isset($post['easyCheckout']['reorder']) &&
                      $post['easyCheckout']['reorder'] == $data->id) {
                        $checked = ' checked';
                    }
                    echo '<input type="radio" name="easyCheckout[reorder]" onclick="extSubmit(\'anchor-reorder\');" value="' .
                      $data->id .
                      '"' .
                      $checked .
                      '/>' .
                      $data->uid .
                      '-' .
                      $data->id;
                },
              ],
              [
                'header'      => Yii::t('main', 'Товары'),
                'type'        => 'raw',
                'value'       => 'Order::getOrderItemsPreview($data->id,"_60x60.jpg")',
                'htmlOptions' => ['style' => 'min-width:110px;height:60px;padding:3px;'],
              ],
              [
                'name'  => 'date',
                'type'  => 'raw',
                'value' => 'date("d.m.Y H:i",$data->date)',
              ],
              [
                'name'  => 'sum',
                'type'  => 'raw',
                'value' => 'Formulas::priceWrapper(Formulas::convertCurrency($data->sum,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
              ],
              [
                'name'  => 'weight',
                'type'  => 'raw',
                'value' => '$data->weight',
              ],
              [
                'name'  => 'delivery_id',
                'type'  => 'raw',
                'value' => '$data->delivery_id',
              ],
              [
                'name'  => 'delivery',
                'type'  => 'raw',
                'value' => 'Formulas::priceWrapper(Formulas::convertCurrency($data->delivery,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
              ],
              [
                'header' => Yii::t('main', 'Итого'),
                'type'   => 'raw',
                'value'  => 'Formulas::priceWrapper(Formulas::convertCurrency($data->sum+$data->delivery,DSConfig::getSiteCurrency(),DSConfig::getCurrency()))',
              ],
            ],
          ]
        ); ?>
    </div>
  </div>
</div>