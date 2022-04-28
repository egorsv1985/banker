<div class="panel-heading closed" data-parent="#checkout-options" data-target="#anchor-comment"
     data-toggle="collapse">
  <h4 class="panel-title" id="title-comment"><a href="#a"> <span class="fa fa-comment"></span>
          <?= Yii::t('main', 'Коментарий к заказу') ?>
    </a><span class="op-number" style="float: right;"><i class="fa fa-arrow-right"
                                                         aria-hidden="true"></i></span>
  </h4>
</div>
<div class="panel-collapse collapse" id="anchor-comment">
  <div class="panel-body">
    <div class="row co-row">
      <div class="box-content form-box">
                            <textarea id="easyCheckout[comment]"
                                      name="easyCheckout[comment]" style="position: relative; left: 20px;width:95%;"
                                      rows="4"
                                      placeholder="Введите коментарий к заказу"><? if (isset($this->post['easyCheckout']['comment'])) {
                                    echo $this->post['easyCheckout']['comment'];
                                } ?></textarea>

      </div>
    </div>
  </div>
</div>