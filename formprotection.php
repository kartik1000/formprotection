<?php

require_once 'formprotection.civix.php';
// phpcs:disable
use CRM_Formprotection_ExtensionUtil as E;
// phpcs:enable
/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function formprotection_civicrm_config(&$config) {
  _formprotection_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function formprotection_civicrm_install() {
  _formprotection_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function formprotection_civicrm_postInstall() {
  _formprotection_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function formprotection_civicrm_uninstall() {
  _formprotection_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function formprotection_civicrm_enable() {
  _formprotection_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function formprotectioncivicrm_disable() {
  _formprotection_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function formprotection_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _formprotection_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function formprotection_civicrm_entityTypes(&$entityTypes) {
  _formprotection_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 */
function formprotection_civicrm_navigationMenu(&$menu) {
  _formprotection_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('reCAPTCHA Settings (formprotection)'),
    'name' => 'formprotection_kartik_settings',
    'url' => 'civicrm/admin/setting/formprotection-kartik',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _formprotection_civix_navigationMenu($menu);
}

/**
 * Intercept form functions
 */
function formprotection_civicrm_buildForm($formName, &$form) {
  switch ($formName) {
    case 'CRM_Admin_Form_Generic':
      if ($form->getSettingPageFilter() !== 'recaptcha') {
        return;
      }

      $helpText = E::ts(
          'reCAPTCHA is a free service that helps prevent automated abuse of your site. To use it on public-facing CiviCRM forms: sign up at <a href="%1" target="_blank">Google\'s reCaptcha site</a>; enter the provided public and private keys here; then enable reCAPTCHA under Advanced Settings in any Profile.',
          [
            1 => 'https://www.google.com/recaptcha',
          ]
        )
        . '<br/><strong>' . E::ts('Only the reCAPTCHA v2 checkbox type is supported.') . '</strong>';
      \Civi::resources()
        ->addMarkup('<div class="help">' . $helpText . '</div>', [
          'weight' => -1,
          'region' => 'page-body',
        ]);
  }
}

function formprotection_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
	require_once E::path('lib/recaptcha/recaptchalib.php');
	echo '<script>alert(' . $_POST['g-recaptcha-token'] . ')</script>';
	print_r($fields);
	$resp = recaptcha_check_answer(
    \Civi::settings()->get('formprotection_recaptchaPrivateKey'),
    $_SERVER['REMOTE_ADDR'],
    $_POST['g-recaptcha-token']
  );
	//$resp->is_valid = FALSE;
	if(!$resp->is_valid) {
		$errors['recaptcha'] = E::ts('ReCAPTCHA v3 token not generated or invalid score');
	}
}
