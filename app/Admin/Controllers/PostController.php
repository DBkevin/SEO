<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

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
            ->header('Index')
            ->description('description')
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

        $grid->id('Id');
        $grid->user_id('User id');
        $grid->category_id('Category id');
        $grid->title('Title');
        $grid->slug('Slug');
        $grid->description('Description');
        $grid->meta_image('Meta image');
        $grid->body('Body');
        $grid->view_count('View count');
        $grid->praise_count('Praise count');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(Post::findOrFail($id));

        $show->id('Id');
        $show->user_id('User id');
        $show->category_id('Category id');
        $show->title('Title');
        $show->slug('Slug');
        $show->description('Description');
        $show->meta_image('Meta image');
        $show->body('Body');
        $show->view_count('View count');
        $show->praise_count('Praise count');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post);

        $form->number('user_id', 'User id')->default(1);
        $form->number('category_id', 'Category id')->default(1);
        $form->text('title', 'Title');
        $form->text('slug', 'Slug');
        $form->text('description', 'Description');
        $form->text('meta_image', 'Meta image');
        $form->textarea('body', 'Body');
        $form->number('view_count', 'View count');
        $form->number('praise_count', 'Praise count');

        return $form;
    }
}
