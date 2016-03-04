<?php use \helpers\form; ?>
<!-- TITLE -->
<div class="form-group <?= $errors->has('title') ? 'has-error' : '' ?>">
  <label class="col-sm-2 control-label" for="news_title">Title <span class="required">*</span></label>
  <div class="col-sm-10">
      <?= Form::input([
          'type'    => 'text',
           'name'   => 'title',
           'value'  => $input->get('title'),
           'class'  => 'form-control',
            'id'    => 'news_title'
      ]) ?>
      <!-- {!! Form::text('title', isset($news) ? $news->title : '', [
            'class' => 'form-control',
            'id' => 'news_title'
      ]) !!} -->
  </div>
</div>

<!-- CONTENT -->
<div class="form-group <?= $errors->has('content') ? 'has-error' : '' ?>">
    <label class="control-label col-lg-2" for="content_news">Content <span class="required">*</span></label>
    <div class="col-lg-10">
        <?= Form::textBox([
             'name'   => 'content',
             'value'  => $input->get('content'),
             'id'     => "content_news",
             'class'  => "form-control ckeditor",
              'rows'  => "6"
        ]) ?>
        <!-- {!! Form::textarea('content', isset($news) ? $news->content : '', [
            'id' => "description_partners",
            'class'=> "form-control ckeditor",
            'rows' => "6"
        ]) !!} -->
    </div>
</div>