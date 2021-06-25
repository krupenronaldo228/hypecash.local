<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Category
 * @property Shop_categories_model model
 */

class Shop_categories extends ADMIN_Controller {

    public $page = 'shop-categories';
    public $page2 = 'shop-products';

    public function __construct ()
    {
        parent::__construct();

        $this->load->model('shop_categories_model');
        $this->model = $this->shop_categories_model;

        $this->init($this->page);
    }

    public function index()
    {
        $this->data['items'] = $this->model->getTreeAdmin();

        $this->output($this->page.'/index');
    }

    public function create()
    {
        $id = uri(4);

        $item = $this->model->getItem('id', $id);

        $this->load->library('upload', $this->model->file_config());

        if($_POST)
        {
            try
            {
                $this->validate($this->page);

                $insert = $this->model->post();

                $file = $this->model->file_load('img');
                if($file) $insert['img'] = $file;
                $insert['img_alt'] = $insert['title'];

                $this->model->insert($insert);

                $this->model->updateDisplay();

                set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['name'].'"</strong> успешно добавлена!', true));
                redirect('admin/'.$this->page);
            }
            catch(Exception $e)
            {
                if(!empty($file))
                    $this->model->file_delete($file);

                $this->data['error'] = $e->getMessage();
            }
        }

        $this->data['item'] = $item;

        $this->data['size'] = $this->model->thumb_size();

        $this->data['parents'] = $this->model->getTreeAdmin();

        $this->add_script([
            PATH_PLUGINS.'/ckeditor/ckeditor.js',
        ]);

        $this->breadcrumbs->add('Добавить', '');

        $this->output($this->page.'/create');
    }

    public function edit()
    {
        $id = uri(4);

        $item = $this->model->getItem('id', $id);
        if(empty($item))
        {
            set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Запись не найдена!', true));
            redirect('admin/'.$this->page);
        }

        $this->load->library('upload', $this->model->file_config());

        if($_POST)
        {
            try
            {
                $this->validate($this->page);

                $insert = $this->model->post();

                $file = $this->model->file_load('img');
                if($file) $insert['img'] = $file;
                $insert['img_alt'] = $insert['title'];

                $this->model->update($insert, $id);

                $this->model->updateDisplay();

                if($file) $this->model->file_delete($item['img']);

                set_flash('result', action_result('success', fa5s('check mr5').' Запись <strong>"'.$insert['name'].'"</strong> успешно обновлена!', true));
                redirect(uri(5) == 'close' ? '/admin/'.$this->page : current_url());
            }
            catch(Exception $e)
            {
                if(!empty($file))
                    $this->model->file_delete($file);

                $this->data['error'] = $e->getMessage();
            }
        }

        $this->data['item'] = $item;

        $this->data['size'] = $this->model->thumb_size();

        $this->data['parents'] = $this->model->getTreeAdmin();

        $this->add_script([
            PATH_PLUGINS.'/ckeditor/ckeditor.js',
        ]);

        $this->breadcrumbs->add('Редактирование', '');

        $this->output($this->page.'/edit');
    }

    public function view()
    {
        $this->data['item'] = $this->model->getItem('id', uri(4));
        if(empty($this->data['item']))
        {
            set_flash('result', action_result('error', fa5s('exclamation-triangle mr5').' Запись не найдена!', true));
            redirect('admin/'.$this->page);
        }

        $this->breadcrumbs->add('Просмотр', '');

        $this->output($this->page.'/view');
    }

    public function delete()
    {
        $id = uri(4);
        $error = fa5s('exclamation-triangle mr5').' Ошибка данных POST!';

        try
        {
            if($_POST && $this->input->post('delete') == 'delete')
            {
                $item = $this->model->getItem('id', $id);
                if(empty($item))
                    throw new Exception(fa5s('exclamation-triangle mr5').' Запись не найдена!');

                $check = $this->model->getCount(['id_parent' => $id]);
                if($check != 0)
                    throw new Exception(fa5s('exclamation-triangle mr5').' Невозможно удалить категорию, поскольку она содержит дочерние разделы <strong>('.$check.')</strong>!');

                $this->load->model('shop_products_model', 'products');
                $check = $this->products->getCount(['id_parent' => $id]);
                if($check != 0)
                    throw new Exception(fa5s('exclamation-triangle mr5').' Невозможно удалить категорию, поскольку она содержит товары <strong>('.$check.')</strong>!');

                $this->model->delete($id);
                $this->model->file_delete($item['img']);

                $error = false;
            }
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }

        if($error)
        {
            set_flash('result', action_result('error', $error, true));
        } else {
            set_flash('result', action_result('success', fa5r('trash-alt mr5').' Запись <strong>"'.$item['name'].'"</strong> успешно удалена!', true));
        }

        redirect('admin/'.$this->page);
    }
}

