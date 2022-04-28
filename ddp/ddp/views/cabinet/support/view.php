<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="view.php">
 * </description>
 **********************************************************************************************************************/
?>

<div class="container">
  <div class="row f-space10"></div>
  <div class="row">
    <div class="col-md-6">
      <div class="box-heading">
                <span><?= Yii::t('main', 'Номер вопроса') ?>:
                Q0000<?= CHtml::encode($question->id) ?></span>
      </div>
    </div><!--End:Col-->
    <div class="col-md-6">
      <!--<div class="row f-space10"></div>-->
      <div class="query-btn">
        <a href="<?= Yii::app()->createUrl('/tools/question') ?>"
           class="btn btn-danger pull-right" style="color:white;padding: 15px 10px;">
          <span><?= Yii::t('main', 'Новое обращение') ?></span>
        </a>
        <a href="<?= Yii::app()->createUrl('/cabinet/support/history') ?>"
           class="btn btn-primary pull-right" style="color: white; padding: 15px 10px; margin: 0 10px;">
          <span><?= Yii::t('main', 'История обращений') ?></span>
        </a>
      </div>
    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row f-space10"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="cabinet-content">
          <? /*
    <p>
        <b><?= Yii::t('main', 'Номер вопроса') ?>:</b>
        Q0000<?= CHtml::encode($question->id) ?>
    </p>
    <br/>
    */ ?>
        <div class="row">
          <div class="col-md-6" style="padding-left: 0">
            <p class="box-heading">
                <span>
                    <b><?= Yii::t('main', 'Тема') ?>:</b>
                    <?= $question->theme ?>
                </span>
            </p>
            <p class="box-heading">
                <span>
                    <b><?= Yii::t('main', 'Категория') ?>:</b>
                    <?= CHtml::encode($category_values[$question->category]) ?>
                </span>
            </p>
            <p class="box-heading">
                <span>
                    <b><?= Yii::t('main', 'Дата обращения') ?>:</b>
                    <?= CHtml::encode(date("d.m.Y H:i:s", $question->date)) ?>
                </span>
            </p>
              <? if (!empty($question->order_id)) { ?>
                <p><b><?= Yii::t('main', 'Номер заказа') ?>:</b> <?= $question->order_id ?></p>
              <? } ?>
              <? if (!empty($question->file)) { ?>
                <p>
                  <b><?= Yii::t('main', 'Файл') ?>:</b>
                  <a href="/upload/<?= $question->file ?>">
                      <?= $question->file ?>
                    <br/>
                    <img src="/upload/<?= $question->file ?>" style="width:260px">
                  </a>
                </p>
              <? } ?>

            <br/>
          </div><!--End:Col-->
          <div class="col-md-6" style="padding-right: 0">
              <? if (isset($messages) && is_array($messages)) { ?>
              <? foreach ($messages as $message) { ?>
                <div class="view">

                    <? if ($message->uid == Yii::app()->user->id): ?>
                      <div class="alert alert-warning">
                        <b>
                            <?= isset(Yii::app()->user->fullname) ? Yii::app()->user->fullname : '' ?>
                        </b>
                        <span class="pull-right">
                            <? //= Yii::t('main', 'Дата обращения') ?>
                            <?= date("d.m.Y H:i:s", $message->date) ?>
                        </span>
                      </div>
                    <? else: ?>
                      <div class="alert alert-info"><b><?= Yii::t('main', 'Служба поддержки') ?>&nbsp;</b>
                        <span class="pull-right">
                            <? //= Yii::t('main', 'Дата обращения') ?>
                            <?= date("d.m.Y H:i:s", $message->date) ?>
                        </span>
                      </div>
                    <? endif ?>
                  <!--<hr/>-->
                  <strong><?= $message->question ?></strong>
                  <div class="row f-space10"></div>
                </div>
                  <? if ((0 == ($message->status % 2)) && !empty($answers[$message->id])) { ?>
                      <? $answer = $answers[$message->id]; ?>
                  <div class="view answer <?= ($message->status == 2) ? 'new' : ''; ?>">
                    <b><?= $answer->user->email . ' (ID: ' . $answer->user->uid . ')'; ?></b> -
                      <?= Yii::t('main', 'Дата ответа') ?>: <?= date("d.m.Y H:i:s", $answer->date) ?>
                    <!--<hr/>-->
                    <striong><?= $answer->question ?></striong>
                  </div>
                  <? } ?>
              <? } ?>
          </div><!--End:Col-->
        </div>

      <? if (isset($message->uid) && $message->uid !== false) { ?>

        <script>
            $(function () {
                $('#send_mess_a').click(function () {
                    $('#colose_question').hide();
                    $('#send_mess').show();
                    return false;
                });
                $('#cansel_mess_a').click(function () {
                    $('#colose_question').show();
                    $('#send_mess').hide();
                    return false;
                });
            });
        </script>

        <div class="form">
            <? if ($question->status != 3) { ?>
              <form id="colose_question" action="<?= $this->createUrl('/cabinet/support/save') ?>" method="post">
                  <?= CHtml::hiddenField('Message[colose_question]', 1) ?>
                  <?= CHtml::hiddenField('Message[qid]', $question->id) ?>
                <div class="row buttons">
                    <?= CHtml::submitButton(
                      Yii::t('main', 'Закрыть обращение'),
                      ['class' => 'btn btn-danger pull-right']
                    ) ?>
                    <?= CHtml::htmlButton(
                      Yii::t('main', 'Задать вопрос'),
                      [
                        'id' => 'send_mess_a',
                        'class' => 'btn btn-primary pull-right',
                        'style' => 'padding: 9.5px 15px;margin:0 10px;',
                      ]
                    ) ?>
                  <!--                    <a href="javascript:void(0);" style="float:right; text-decoration: none;text-align: center;color: white;" class="blue-btn bigger" id="send_mess_a">Задать вопрос</a>-->
                </div>
              </form>
            <? } else { ?>
              <div id="colose_question">
                <div class="alert alert-danger"><b><?= Yii::t('main', 'Обращение закрыто') ?></b></div>
                <!--                <div class="row buttons">
                                     <a href="javascript:void(0);" id="send_mess_a">Открыть повторно</a>
                                </div>-->
              </div>
            <? } ?>
          <form style="display:none" id="send_mess" action="<?= $this->createUrl('/cabinet/support/save') ?>"
                method="post">
            <div class="row">
              <label><?= Yii::t('main', 'Вопрос') ?>:</label>
                <?= CHtml::textArea('Message[question]') ?>
                <?= CHtml::hiddenField('Message[email]', Yii::app()->user->email) ?>
                <?= CHtml::hiddenField('Message[uid]', Yii::app()->user->id) ?>
                <?= CHtml::hiddenField('Message[qid]', $question->id) ?>
                <?= CHtml::hiddenField('Message[date]', time()) ?>
            </div>
            <div class="row buttons">
                <?= CHtml::submitButton(Yii::t('main', 'Отправить'), ['class' => 'blue-btn bigger btn btn-danger']) ?>
                <?= CHtml::htmlButton(
                  Yii::t('main', 'Отмена'),
                  ['class' => 'blue-btn bigger btn btn-primary', 'id' => 'cansel_mess_a']
                ) ?>
              <!--                <a href="javascript:void(0);" id="cansel_mess_a">Отмена</a>-->
            </div>
          </form>
        </div>

      <? } ?>
      <? } ?>

      </div>

    </div><!--End:Col-->
  </div><!--End:Row-->
  <div class="row f-space10"></div>
</div><!--End:Container-->