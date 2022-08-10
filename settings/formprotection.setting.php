<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

use CRM_Formprotection_ExtensionUtil as E;

/**
 * Settings metadata file
 */
return [
  'formprotection_recaptchaPublicKey' => [
    'group_name' => 'CiviCRM Preferences',
    'group' => 'core',
    'name' => 'formprotection_recaptchaPublicKey',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_attributes' => [
      'size' => 64,
      'maxlength' => 64,
    ],
    'html_type' => 'text',
    'default' => NULL,
    'add' => '4.3',
    'title' => E::ts('reCAPTCHA Site Key'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'settings_pages' => [
      'formprotection-kartik' => [
        'weight' => 10,
      ],
    ],
  ],
  'formprotection_recaptchaPrivateKey' => [
    'group_name' => 'CiviCRM Preferences',
    'group' => 'core',
    'name' => 'formprotection_recaptchaPrivateKey',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_attributes' => [
      'size' => 64,
      'maxlength' => 64,
    ],
    'html_type' => 'text',
    'default' => NULL,
    'add' => '4.3',
    'title' => E::ts('reCAPTCHA Secret Key'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'settings_pages' => [
      'formprotection-kartik' => [
        'weight' => 10,
      ],
    ],
  ],
  'formprotection_forceRecaptcha' => [
    'add' => '4.7',
    'help_text' => NULL,
    'is_domain' => 1,
    'is_contact' => 0,
    'group_name' => 'CiviCRM Preferences',
    'group' => 'core',
    'name' => 'formprotection_forceRecaptcha',
    'type' => 'Boolean',
    'quick_form_type' => 'YesNo',
    'html_type' => '',
    'default' => '0',
    'title' => E::ts('Force reCAPTCHA on Contribution pages'),
    'description' => E::ts('If enabled, reCAPTCHA will show on all contribution pages.'),
    'settings_pages' => [
      'formprotection-kartik' => [
        'weight' => 10,
      ],
    ],
  ],
  'formprotection_recaptchaOptions' => [
    'group_name' => 'CiviCRM Preferences',
    'group' => 'core',
    'name' => 'formprotection_recaptchaOptions',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_attributes' => [
      'size' => 64,
      'maxlength' => 64,
    ],
    'html_type' => 'text',
    'default' => NULL,
    'add' => '4.3',
    'title' => E::ts('reCAPTCHA Options'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => E::ts('You can specify the reCAPTCHA theme options as comma separated data.(eg: theme:\'blackglass\', lang : \'fr\' ). Check the available options at <a href="https://developers.google.com/recaptcha/docs/display#config">Customizing the Look and Feel of reCAPTCHA</a>.'),
    'help_text' => NULL,
    'settings_pages' => [
      'formprotection-kartik' => [
        'weight' => 10,
      ],
    ],
  ],
  'formprotection_recaptchaversion' => [
    'default' => 'v3',
    'html_type' => 'select',
    'name' => 'formprotection_recaptchaversion',
    'title' => ts('reCAPTCHA version'),
    'type' => CRM_Utils_Type::T_STRING,
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Select the reCAPTCHA version'),
    'options' => [
      'v3' => ts('reCAPTCHA v3'),
      'v2checkbox' => ts('reCAPTCHA v2 ("I\'m not a robot" Checkbox)'),
    ],
    'settings_pages' => [
      'formprotection-kartik' => [
        'weight' => 1,
      ]
    ],
  ],
];
