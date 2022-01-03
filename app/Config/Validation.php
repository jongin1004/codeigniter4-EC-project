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
        'user_id'              => 'required',
        'category_id'          => 'required|is_not_unique[categories.category_id]',
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
}
