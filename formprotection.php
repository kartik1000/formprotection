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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function formprotection_civicrm_xmlMenu(&$files) {
  _formprotection_civix_civicrm_xmlMenu($files);
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
function formprotection_civicrm_disable() {
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
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function formprotection_civicrm_managed(&$entities) {
  _formprotection_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function formprotection_civicrm_caseTypes(&$caseTypes) {
  _formprotection_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function formprotection_civicrm_angularModules(&$angularModules) {
  _formprotection_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function formprotection_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _formprotection_civix_civicrm_alterSettingsFolders($metaDataFolders);
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
 * Implements hook_civicrm_themes().
 */
function formprotection_civicrm_themes(&$themes) {
  _formprotection_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function formprotection_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 */
function formprotection_civicrm_navigationMenu(&$menu) {
  _formprotection_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('reCAPTCHA v3 Settings'),
    'name' => 'recaptcha_settings',
    'url' => 'civicrm/admin/setting/recaptcha',
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

      $helpText = E::ts(
          'reCAPTCHA is a free service that helps prevent automated abuse of your site. To use it on public-facing CiviCRM forms: sign up at <a href="%1" target="_blank">Google\'s reCaptcha site</a>; enter the provided public and private keys here; then enable reCAPTCHA under Advanced Settings in any Profile.',
          [
            1 => 'https://www.google.com/recaptcha',
          ]
        )
        . '<br/><strong>' . E::ts('Only the reCAPTCHA v3 is supported.') . '</strong>';
      \Civi::resources()
        ->addMarkup('<div class="help">' . $helpText . '</div>', [
          'weight' => -1,
          'region' => 'page-body',
        ]);
  }
}
