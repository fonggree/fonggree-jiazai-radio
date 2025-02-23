<?php

namespace App\Admin\Controllers\AppletHd\Radio;

use App\Models\AppletHd\Radio\Radio;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FoundController extends Controller
{
    use ModelForm;
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加电台');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Radio::class, function (Grid $grid) {
			
            $grid->id('ID')->sortable();
            $grid->radio_name('电台名称');
            $grid->created_at('创建时间');
            $grid->updated_at('修改时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Radio::class, function (Form $form) {
        	$form->tab('Radio', function($form){
        		//$form->display('id', 'ID');
        		$form->text("radio_name","电台名称")->placeholder("请输入电台名称");
        	})->tab('Radio Picture', function($form){
        		$form->hasMany('pictures', function(Form\NestedForm $form){
        			$form->image("radio_picture","电台轮播图")->move('image/radio')->uniqueName();
        		});
        	});
        	
        	$form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At'); 
        });
    }
}
