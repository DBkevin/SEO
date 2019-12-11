<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use App\Models\Category;
use App\Handlers\SlugHandler;

class PostController extends Controller
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
            ->header('文章列表')
            ->body($this->grid());
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
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
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
            ->header('Create')
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
        $grid = new Grid(new Post);
        $grid->actions(function ($actions) {
            $actions->disableView();
            // append一个操作
            $actions->append('<a href="' . route("posts.show", $actions->getKey()) . '"><i class="fa fa-eye"></i></a>');
            // prepend一个操作
        });
        $grid->id('Id');
        $grid->title('标题');
        $grid->column('Category.name', '栏目名称');
        $grid->description('文章描述')->display(function ($text) {
            return str_limit($text, 30);
        });
        $grid->tags()->display(function ($tags) {
            $res = array_map(function ($tag) {
                return "<span class='label label-success'>{$tag['name']}</span>";
            }, $tags);
            return join('', $res);
        });
        $grid->meta_image('文章缩略图')->display(function ($meta_image) {
            return '<img src="/storage/' . $meta_image . '" style="width=30px; height:30px;" />';
        });
        $grid->body('文章内容')->display(function ($body) {
            return str_limit($body, 30);
        });
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post);
        $form->select('category_id', '栏目')->options(function () {
            $categorys = Category::all();
            $data = [];
            foreach ($categorys as $category) {
                $data[$category->id] = $category->name;
            }
            return $data;
        })->rules('required');
        $form->text('title', '标题')->rules('required|min:3')->creationRules( "unique:posts");
        $form->text('description', '文章描述')->rules('required');
        $form->multipleSelect('tags')->options(function($ids){
            if(!$ids==''){
                return Tag::find($ids)->pluck('name','id');
            }
        })->ajax('/admin/api/tags');
        $form->hidden('slug');
        $form->image('meta_image', '文章缩率图')->creationRules('required');
        $form->UEditor('body', '文章内容')->rules('required');
        $form->hidden('view_count');
        $form->hidden('praise_count');
        // 在表单提交前调用
        // 在表单提交前调用
        $form->saving(function (Form $form) {
            $form->slug = app(SlugHandler::class)->pinyin($form->title);
            $form->view_count = random_int(100, 199);
            $form->praise_count = random_int(5, 199);
        });
        return $form;
    }
}
