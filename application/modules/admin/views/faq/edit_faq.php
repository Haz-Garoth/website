<?php
if (isset($_POST['button_updateFaq'])):
  $title = $_POST['faq_title'];
  $type = $_POST['faq_type'];
  $description  = $_POST['faq_description'];

  $this->admin_model->updateSpecifyFaq($idlink, $title, $type, $description);
endif; ?>

    <?= $tiny ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('card_title_edit_faq'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/faq'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_faq_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="faq_title" type="text" value="<?= $this->admin_model->getFaqSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_faq_title'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_type'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="faq_type">
                    <?php foreach ($this->admin_model->getFaqTypeList()->result() as $faqType): ?>
                    <?php if ($faqType->id == $this->admin_model->getFaqSpecifyType($idlink)): ?>
                    <option value="<?= $faqType->id ?>" selected><?= $faqType->title ?></option>
                    <?php else: ?>
                    <option value="<?= $faqType->id ?>"><?= $faqType->title ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="faq_description" rows="10" cols="80"><?= $this->admin_model->getFaqSpecifyDesc($idlink); ?></textarea>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_updateFaq" type="submit"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>