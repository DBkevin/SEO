<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class CategoryController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('网站栏目')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑栏目')
            ->body($this->form(true)->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新建')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->id('栏目ID');
        $grid->name('栏目名称');
        $grid->description('栏目描述')->display(function ($description) {
            return str_limit($description, 10, '...');
        });
        $grid->column('key_words', '关键词')->display(function () {
            return $this->key_words ? str_limit($this->key_words, 10, '...') : '无';
        });
        $grid->type('栏目类型')->using([1 => '栏目封面', 2 => "栏目列表"]);
        $grid->meta_image('栏目缩略图')->display(function ($meta_image) {
            return $meta_image ? '<img width="30px;height:30px;" src="/storage/' . $meta_image . '"/>' : '无';
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->description('Description');
        $show->meta_image('Meta image');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($isEdit = false)
    {
        $form = new Form(new Category);
        $form->tab('基础设置', function ($form) use ($isEdit) {
            $form->text('name', '栏目名称')->rules('required|min:3');
            $form->textarea('description', '栏目描述');
            $form->text('key_words', '关键词(key_word)')->creationRules('required|min:3');
            $form->text('dir_name','栏目目录')->rules(function($form){
                if(!$id=$form->model()->id){
                   return  'unique:categories,dir_name|required|min:3';
                }
                return 'required|min:3';
            });
            
            $form->image('meta_image', '栏目缩略图');
            if ($isEdit) {
                $form->display('type', '类型')->with(function ($value) {
                    return $value == 1 ? '栏目封面' : '栏目列表';
                });
            } else {
                $form->radio('type', '栏目类型')
                    ->options([1 => '栏目封面', 2 => '栏目列表'])
                    ->default(2);
            }
        })->tab('高级设置', function ($form) {
            $form->text('layout', '栏目样式模板');
        });
        return $form;
    }
}
