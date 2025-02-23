<?php

use App\Admin\Extensions\WangEditor;
use Encore\Admin\Form;
use App\Admin\Extensions\Column\UrlWrapper;
use Encore\Admin\Grid\Column;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);
Form::extend('editor', WangEditor::class);

Admin::js('/packages/admin/clipboard/dist/clipboard.min.js');

Column::extend('urlwrapper', UrlWrapper::class);
