<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $create_category = [
		'name' => [
			'rules' => 'required|max_length[100]',	
		],
		'description' => [
			'rules' => 'required',
        ],
        'status' => [
			'rules' => 'required',
        ],
	];

    public $update_category = [
        'id' => [
			'rules' => 'required',
        ],
		'name' => [
			'rules' => 'required|max_length[100]',	
		],
		'description' => [
			'rules' => 'required',
        ],
        'status' => [
			'rules' => 'required',
        ],
	];

    public $create_writer = [
		'name' => [
			'rules' => 'required|max_length[100]',	
		],
		'slug' => [
			'rules' => 'required',
        ],
        'status' => [
			'rules' => 'required',
        ],
	];

    public $update_writer = [
        'id' => [
			'rules' => 'required',
        ],
		'name' => [
			'rules' => 'required|max_length[100]',	
		],
		'slug' => [
			'rules' => 'required',
        ],
        'status' => [
			'rules' => 'required',
        ],
	];

    public $create_artikel = [
		'title' => [
			'rules' => 'required|max_length[100]',	
		],
		'slug' => [
			'rules' => 'required',
        ],
        'writer' => [
			'rules' => 'required',
        ],
        'content' => [
			'rules' => 'required',
        ],
        'category' => [
			'rules' => 'required',
        ],
        'published_at' => [
			'rules' => 'required',
        ],
        'status' => [
			'rules' => 'required',
        ],
	];

    public $update_artikel = [
		'id' => [
			'rules' => 'required',
        ],
		'slug' => [
			'rules' => 'required',
        ],
        'writer' => [
			'rules' => 'required',
        ],
        'content' => [
			'rules' => 'required',
        ],
        'category' => [
			'rules' => 'required',
        ],
        'published_at' => [
			'rules' => 'required',
        ],
        'status' => [
			'rules' => 'required',
        ],
	];
}
