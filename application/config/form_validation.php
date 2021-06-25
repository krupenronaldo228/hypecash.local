<?php defined('BASEPATH') OR exit('No direct script access allowed');

# ADMIN SETTINGS
#============================================================================
$config['admin_settings'] = [
	[
		'field' => 'title',
		'label' => 'Название сайта',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'description',
		'label' => 'Описание сайта',
		'rules' => 'trim|max_length[255]'
	],
	[
		'field' => 'owner',
		'label' => 'Владелец сайта',
		'rules' => 'trim'
	],
	[
		'field' => 'details',
		'label' => 'Реквизиты',
		'rules' => 'trim'
	],
	[
		'field' => 'copyright',
		'label' => 'Копирайт',
		'rules' => 'trim'
	],
	[
		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'trim|required|max_length[255]|valid_email'
	],
	[
		'field' => 'email_sender',
		'label' => 'E-mail отправителя',
		'rules' => 'trim|required|max_length[255]|valid_email'
	],
	[
		'field' => 'email_recipient',
		'label' => 'E-mail получателя',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'phone',
		'label' => 'Телефон (основной)',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'phone_extra',
		'label' => 'Телефон (дополнительный)',
		'rules' => 'trim|max_length[255]'
	],
	[
		'field' => 'phone_city',
		'label' => 'Телефон (городской)',
		'rules' => 'trim|max_length[255]'
	],
	[
		'field' => 'address',
		'label' => 'Адрес',
		'rules' => 'trim|max_length[255]'
	],
	[
		'field' => 'enable',
		'label' => 'Включить сайт',
		'rules' => ''
	],
	[
		'field' => 'cap_title',
		'label' => 'Заголовок для заглушки',
		'rules' => 'trim|max_length[255]'
	],
	[
		'field' => 'cap_description',
		'label' => 'Описание для заглушки',
		'rules' => 'trim'
	],
	[
		'field' => 'mask_phone',
		'label' => 'Маска телефона',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'mask_phone_extra',
		'label' => 'Маска телефона 2',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'mask_phone_city',
		'label' => 'Маска телефона 3',
		'rules' => 'trim|required|max_length[255]'
	],
    [
        'field' => 'price',
        'label' => 'Цена',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'num',
        'label' => 'Преоритет',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'brand',
        'label' => 'Бренд',
        'rules' => 'trim|required|max_length[255]'
    ],
    [
        'field' => 'code',
        'label' => 'Код товара',
        'rules' => 'trim|required|max_length[255]'
    ],
    [
        'field' => 'material',
        'label' => 'Материал',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'color',
        'label' => 'Цвет',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'Страна',
        'label' => 'Преоритет',
        'rules' => 'trim|required|max_length[255]',
    ],
];

$config['admin_settings_template'] = [
	[
		'field' => 'template_color',
		'label' => 'Цвет вкладки (HEX-code)',
		'rules' => 'trim|max_length[6]'
	],
	[
		'field' => 'template_alt',
		'label' => 'Alt изображений',
		'rules' => 'trim|max_length[255]'
	],
];


# ADMIN PAGEINFO
#============================================================================
$config['admin_pageinfo'] = [
	[
		'field' => 'name',
		'label' => 'Название',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'title',
		'label' => 'Заголовок',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'text',
		'label' => 'Описание страницы',
		'rules' => 'trim',
	],
	[
		'field' => 'meta_title',
		'label' => 'Meta Title',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'meta_description',
		'label' => 'Meta Description',
		'rules' => 'trim'
	],
	[
		'field' => 'thumb_x',
		'label' => 'Ширина эскизов (px)',
		'rules' => 'trim|integer',
	],
	[
		'field' => 'thumb_y',
		'label' => 'Высота эскизов (px)',
		'rules' => 'trim|integer',
	],
];


# ADMIN NEWS
#============================================================================
$config['admin_news'] = [
	[
		'field' => 'title',
		'label' => 'Заголовок',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'brief',
		'label' => 'Краткое описание',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'text',
		'label' => 'Текст',
		'rules' => 'trim',
	],
	[
		'field' => 'alias',
		'label' => 'Ссылка (ЧПУ)',
		'rules' => 'trim|required|max_length[255]|alpha_dash|callback_check_alias['.uri(4).']',
	],
	[
		'field' => 'meta_title',
		'label' => 'Meta Title',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'meta_description',
		'label' => 'Meta Description',
		'rules' => 'trim'
	],
	[
		'field' => 'img_alt',
		'label' => 'Alt изображения',
		'rules' => 'trim|max_length[255]'
	],
    [
        'field' => 'category',
        'label' => 'Заголовок',
        'rules' => 'trim|required|max_length[255]',
    ],
];


# ADMIN ARTICLES
#============================================================================
$config['admin_articles'] = [
	[
		'field' => 'title',
		'label' => 'Заголовок',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'brief',
		'label' => 'Краткое описание',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'text',
		'label' => 'Текст',
		'rules' => 'trim',
	],
	[
		'field' => 'alias',
		'label' => 'Ссылка (ЧПУ)',
		'rules' => 'trim|required|max_length[255]|alpha_dash|callback_check_alias['.uri(4).']',
	],
	[
		'field' => 'meta_title',
		'label' => 'Meta Title',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'meta_description',
		'label' => 'Meta Description',
		'rules' => 'trim'
	],
	[
		'field' => 'img_alt',
		'label' => 'Alt изображения',
		'rules' => 'trim|max_length[255]'
	],
];


# ADMIN PACKAGES
#============================================================================
$config['admin_packages'] = [
    [
        'field' => 'title',
        'label' => 'Заголовок',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'brief',
        'label' => 'Краткое описание',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'text',
        'label' => 'Текст',
        'rules' => 'trim',
    ],
    [
        'field' => 'price',
        'label' => 'Цена',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'alias',
        'label' => 'Ссылка (ЧПУ)',
        'rules' => 'trim|required|max_length[255]|alpha_dash|callback_check_alias['.uri(4).']',
    ],
    [
        'field' => 'meta_title',
        'label' => 'Meta Title',
        'rules' => 'trim|required|max_length[255]'
    ],
    [
        'field' => 'meta_description',
        'label' => 'Meta Description',
        'rules' => 'trim'
    ],
    [
        'field' => 'img_alt',
        'label' => 'Alt изображения',
        'rules' => 'trim|max_length[255]'
    ],
];

# ADMIN CATEGORY
#============================================================================
$config['admin_shop-categories'] = [
    [
        'field' => 'title',
        'label' => 'Заголовок',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'brief',
        'label' => 'Краткое описание',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'text',
        'label' => 'Текст',
        'rules' => 'trim',
    ],
    [
        'field' => 'name',
        'label' => 'Название',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'alias',
        'label' => 'Ссылка (ЧПУ)',
        'rules' => 'trim|required|max_length[255]|alpha_dash|callback_check_alias['.uri(4).']',
    ],
    [
        'field' => 'num',
        'label' => 'Преоритет',
        'rules' => 'trim|required|max_length[255]',
    ],
    ];

# ADMIN SHOP
#============================================================================
$config['admin_shop-products'] = [
    [
        'field' => 'title',
        'label' => 'Заголовок',
        'rules' => 'trim|required|max_length[255]',
    ],
       [
        'field' => 'brief',
        'label' => 'Краткое описание',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'text',
        'label' => 'Текст',
        'rules' => 'trim',
    ],
    [
        'field' => 'price',
        'label' => 'Цена',
        'rules' => 'trim|required|max_length[255]',
    ],
    [
        'field' => 'alias',
        'label' => 'Ссылка (ЧПУ)',
        'rules' => 'trim|required|max_length[255]|alpha_dash|callback_check_alias['.uri(4).']',
    ],
    [
        'field' => 'meta_title',
        'label' => 'Meta Title',
        'rules' => 'trim|required|max_length[255]'
    ],
    [
        'field' => 'meta_description',
        'label' => 'Meta Description',
        'rules' => 'trim'
    ],
    [
        'field' => 'img_alt',
        'label' => 'Alt изображения',
        'rules' => 'trim|max_length[255]'
    ],

    [
        'field' => 'code',
        'label' => 'Код товара',
        'rules' => 'trim|is_unique[shop-products]'
    ],
    [
        'field' => 'material',
        'label' => 'Материал',
        'rules' => 'trim',
    ],
    [
        'field' => 'color',
        'label' => 'Цвет',
        'rules' => 'trim',
    ],
    [
        'field' => 'num',
        'label' => 'Преоритет',
        'rules' => 'trim',
    ],
];

# ADMIN PAGES
#============================================================================
$config['admin_pages'] = [
	[
		'field' => 'title',
		'label' => 'Заголовок',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'brief',
		'label' => 'Краткое описание',
		'rules' => 'trim|max_length[255]',
	],
	[
		'field' => 'text',
		'label' => 'Текст',
		'rules' => 'trim',
	],
	[
		'field' => 'alias',
		'label' => 'Ссылка (ЧПУ)',
		'rules' => 'trim|required|max_length[255]|alpha_dash|callback_check_alias['.uri(4).']',
	],
	[
		'field' => 'meta_title',
		'label' => 'Meta Title',
		'rules' => 'trim|required|max_length[255]'
	],
	[
		'field' => 'meta_description',
		'label' => 'Meta Description',
		'rules' => 'trim'
	],
];


# ADMIN SLIDER
#============================================================================
$config['admin_slider'] = [
	[
		'field' => 'title',
		'label' => 'Заголовок',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'link',
		'label' => 'Ссылка',
		'rules' => 'trim',
	],
	[
		'field' => 'text',
		'label' => 'Текст',
		'rules' => 'trim',
	],
	[
		'field' => 'num',
		'label' => 'Приоритет',
		'rules' => 'trim|integer',
	],
];


# ADMIN NAVIGATION
#============================================================================
$config['admin_navigation'] = [
	[
		'field' => 'title',
		'label' => 'Заголовок',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'link',
		'label' => 'Ссылка',
		'rules' => 'trim|required',
	],
	[
		'field' => 'id_parent',
		'label' => 'Категория',
		'rules' => 'trim|required|integer',
	],
	[
		'field' => 'num',
		'label' => 'Приоритет',
		'rules' => 'trim|required|integer',
	],
];


# ADMIN SOCIAL
#============================================================================
$config['admin_social'] = [
	[
		'field' => 'brief',
		'label' => 'Подсказка',
		'rules' => 'trim|max_length[255]',
	],
	[
		'field' => 'link',
		'label' => 'Ссылка',
		'rules' => 'trim|required',
	],
	[
		'field' => 'num',
		'label' => 'Приоритет',
		'rules' => 'trim|required|integer',
	],
];


# ADMIN REVIEWS
#============================================================================
$config['admin_reviews'] = [
	[
		'field' => 'name',
		'label' => 'Имя',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'link',
		'label' => 'Ссылка',
		'rules' => 'trim',
	],
	[
		'field' => 'text',
		'label' => 'Текст',
		'rules' => 'trim',
	],
	[
		'field' => 'video',
		'label' => 'Видео',
		'rules' => 'trim',
	],
];


# ADMIN USERS
#============================================================================
$config['admin_login'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required',
	],
	[
		'field' => 'password',
		'label' => 'Пароль',
		'rules' => 'trim|required',
	],
];

$config['admin_users_create'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required|min_length[3]|max_length[255]|callback_check_login',
	],
	[
		'field' => 'name',
		'label' => 'Имя',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'trim|required|valid_email|callback_check_email',
	],
	[
		'field' => 'phone',
		'label' => 'Телефон',
		'rules' => 'trim|max_length[255]|callback_check_phone',
	],
	[
		'field' => 'password',
		'label' => 'Пароль',
		'rules' => 'trim|required|min_length[6]|max_length[255]',
	],
];

$config['admin_users_update'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required|min_length[3]|max_length[255]|callback_check_login['.uri(4).']',
	],
	[
		'field' => 'name',
		'label' => 'Имя',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'trim|required|valid_email|callback_check_login['.uri(4).']',
	],
	[
		'field' => 'phone',
		'label' => 'Телефон',
		'rules' => 'trim|max_length[255]|callback_check_login['.uri(4).']',
	],
];

$config['admin_users_password'] = [
	[
		'field' => 'old_password',
		'label' => 'Старый пароль',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'password',
		'label' => 'Новый пароль',
		'rules' => 'trim|required|max_length[255]|min_length[6]',
	],
	[
		'field' => 'confirm_password',
		'label' => 'Подтверждение пароля',
		'rules' => 'trim|required|max_length[255]|min_length[6]|matches[password]',
	],
];

$config['admin_recovery'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required',
	],
];


# SITE USERS
#============================================================================
$config['login'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required',
	],
	[
		'field' => 'password',
		'label' => 'Пароль',
		'rules' => 'trim|required',
	],
];

$config['register'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required|min_length[3]|max_length[255]|callback_check_login',
	],
	[
		'field' => 'name',
		'label' => 'Ф.И.О.',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'trim|required|valid_email|callback_check_email',
	],
	[
		'field' => 'phone',
		'label' => 'Телефон',
		'rules' => 'trim|required|max_length[255]|callback_check_phone',
	],
	[
		'field' => 'password',
		'label' => 'Пароль',
		'rules' => 'trim|required|min_length[6]|max_length[255]',
	],
	[
		'field' => 'password_confirm',
		'label' => 'Подтверждение пароля',
		'rules' => 'trim|required|max_length[255]|min_length[6]|matches[password]',
	],
];

$config['recovery'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required',
	],
];

$config['profile'] = [
	[
		'field' => 'login',
		'label' => 'Логин',
		'rules' => 'trim|required|min_length[3]|max_length[255]|callback_check_login['.get_cookie('userid').']',
	],
	[
		'field' => 'name',
		'label' => 'Ф.И.О.',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'trim|required|valid_email|callback_check_email['.get_cookie('userid').']',
	],
	[
		'field' => 'phone',
		'label' => 'Телефон',
		'rules' => 'trim|required|max_length[255]|callback_check_phone['.get_cookie('userid').']',
	],
];

$config['password'] = [
	[
		'field' => 'old_password',
		'label' => 'Старый пароль',
		'rules' => 'trim|required|max_length[255]',
	],
	[
		'field' => 'password',
		'label' => 'Новый пароль',
		'rules' => 'trim|required|max_length[255]|min_length[6]',
	],
	[
		'field' => 'confirm_password',
		'label' => 'Подтверждение пароля',
		'rules' => 'trim|required|max_length[255]|min_length[6]|matches[password]',
	],
];


# FEEDBACK
#============================================================================

$config['feedback'] = [
	[
		'field' => 'name',
		'label' => 'Ваше имя',
		'rules' => 'trim|max_length[255]',
	],
	[
		'field' => 'phone',
		'label' => 'Телефон',
		'rules' => 'trim|required|max_length[255]',
	],
];
