<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Shop
 * @property Shop_products_model products
 * @property Shop_categories_model categories
 */

class Shop extends SITE_Controller {
	
	public	$page = 'shop';
	
	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('Shop_products_model', 'products');
        $this->load->model('Shop_categories_model', 'categories');
		
		$this->init($this->page);
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);
	}

    public function index()
    {
        $params = ['visibility' => 1, 'display' => 1, 'id_parent' => 0];

        $count = $this->categories->getCount($params);
        $pagination = site_pagination($this->page, $count, 10);

        $this->data['items'] = $items = $this->categories->getItems($params, 'num DESC', $pagination['per_page'], $pagination['offset']);
        $this->data['products'] = $products = $this->products->getItems([]);
        $pagination = site_pagination($this->page, $count, 10, 2);

        $this->load->library('pagination');
        $this->pagination->initialize($pagination);


        $this->load->library('pagination');
        $this->pagination->initialize($pagination);

       /* foreach ($products['breadcrumbs'] as $breadcrumb)
            $this->breadcrumbs->add($breadcrumb['title'], 'catalog/' . $breadcrumb['alias']);*/

        $this->add_script([
            PATH_SITE.'/js/catalog.js',
            PATH_PLUGINS.'/owl.carousel/owl.carousel.min.js',
            PATH_PLUGINS.'/jquery-ui/jquery-ui.min.js',
            PATH_PLUGINS.'/jquery-ui/jquery.ui.touch-punch.js',
        ]);
        $this->data['canonical'] = $this->page;

        $this->output('pages/shop-list');
    }

    public function category()
    {
        $this->data['item'] = $item = $this->categories->getItem([
            'visibility' => 1,
            'display' => 1,
            'alias' => uri(2)
        ]);

        if(empty($item)) show_404();

        # catalog

        $categories = $this->categories->getItemsTree(['visibility' => 1, 'display' => 1], 'num DESC', $item['id']);

        $this->data['nav'] = $categories['tree'];


        # products

        $params = ['shop_products.visibility' => 1, 'shop_products.display' => 1];
        $this->data['count'] = $count = $this->products
         #   ->setFilter()
            ->setCurrentsCategories($categories['current_child'])
            ->getCount($params);

        $pagination = site_pagination($this->page.'/'.$item['alias'], $count, 10, 3);

        $get_sort = $this->input->get('sort');
        $this->data['sort'] = !empty($get_sort) ? $get_sort : 'num DESC';

        $this->data['products'] = $this->products
           # ->setFilter()
            ->setCurrentsCategories($categories['current_child'])
            ->getItemsFront($params, 'shop_products.'.$this->data['sort'], $pagination['per_page'], $pagination['offset']);

        # output

        $this->load->library('pagination');
        $this->pagination->initialize($pagination);

        foreach ($categories['breadcrumbs'] as $breadcrumb)
            $this->breadcrumbs->add($breadcrumb['title'], 'catalog/' . $breadcrumb['alias']);

        $this->add_script([
            PATH_SITE.'/js/catalog.js',
            PATH_PLUGINS.'/owl.carousel/owl.carousel.min.js',
            PATH_PLUGINS.'/jquery-ui/jquery-ui.min.js',
            PATH_PLUGINS.'/jquery-ui/jquery.ui.touch-punch.js',
        ]);


        $this->data['canonical'] = $this->page.'/'.$item['alias'];

        $this->output('pages/categories-shop-list');
    }

    public function view()
    {
        $this->data['item'] = $item = $this->products->getItem([
            'visibility' => 1,
            'display' => 1,
            'alias' => uri(3),
        ]);
        if (empty($item)) show_404();

        # get extra

       $similar = ['id !=' => $item['id'], 'visibility' => 1];
        $this->data['similar'] = $this->products->getItems($similar, 'RANDOM', 3);

        # output

        $this->data['og_image'] = PATH_UPLOADS.'/'.$this->page.'/'.$item['img'];

        $this->breadcrumbs->add($item['title'], $this->page.'/'.$item['alias']);

        $this->add_script('assets/plugins/share42/share.js');

        $this->output('pages/shop-view');
    }

    public function product()
    {
        $this->data['item'] = $item = $this->products->getItem([
            'visibility' => 1,
            'display' => 1,
            'alias' => uri(3),
        ]);
        if (empty($item)) show_404();

        $this->data['parent'] = $parent = $this->categories->getItem([
            'id' => $item['id_parent'],
            'alias' => uri(2),
            'visibility' => 1,
            'display' => 1,
        ]);

        if (empty($parent)) show_404();


        # extra

        $categories = $this->categories->getItemsTree(['visibility' => 1, 'display' => 1], 'num DESC', $parent['id']);

        $this->data['nav'] = $categories['tree'];

        $this->data['products'] = $this->products->getItemsFront([
            'shop_products.id_parent' => $parent['id'],
            'shop_products.id !=' => $item['id']
        ], 'RANDOM', 10);


        # output

        $this->add_script([
            PATH_PLUGINS . '/vix-gallery/js/jquery.vix-gallery.js',
            PATH_PLUGINS . '/owl.carousel/owl.carousel.min.js',
            PATH_PLUGINS . '/slick/slick.min.js',
            PATH_PLUGINS . '/share42/share.js',
            PATH_SITE . '/js/product.js',
        ]);

        $this->add_style([
            PATH_PLUGINS . '/slick/slick.css'
        ]);

        $this->data['og_image'] = PATH_UPLOADS . '/products/' . $item['img'];

        $this->data['canonical'] = $this->page . '/' . $parent['alias'] . '/' . $item['alias'];

        foreach ($categories['breadcrumbs'] as $breadcrumb)
            $this->breadcrumbs->add($breadcrumb['title'], 'categories/' . $breadcrumb['alias']);
        $this->breadcrumbs->add($item['title'], '');

        $this->output('pages/shop-view');
    }

}
