<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
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
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $meeting_create = [
        'user_id'             => 'required',
        'category_id'         => 'required|is_not_unique[categories.category_id]',
        'meeting_title'       => 'required',
        'meeting_description' => 'required'
    ];

    public $meeting_create_errors = [
        'username' => [
            'required'    => 'You must choose a username.',
        ],
        'email'    => [
            'valid_email' => 'Please check the Email field. It does not appear to be valid.',
        ]
    ];

    public $register = [
        'user_name'        => 'required|alpha_numeric',
        'user_email'       => 'required|valid_email|is_unique[users.user_email]',
        'user_password'    => 'required|min_length[4]|max_length[12]|matches[password_confirm]',
        'password_confirm' => 'required'
    ];

    public $comment = [
        'user_id'             => 'required',
        'meeting_id'          => 'required',
        'comment_description' => 'required'
    ];

    public $sale = [
        'user_id'             => 'required|is_not_unique[users.user_id]',
        'category_id'         => 'required|is_not_unique[categories.category_id]',
        'sale_title'          => 'required',
        'sale_description'    => 'required',
        'sale_state'          => 'required|in_list[b,m,w]',
        'sale_price'          => 'required|integer'
    ];
}
