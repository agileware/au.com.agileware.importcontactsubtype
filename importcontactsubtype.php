<?php

require_once 'importcontactsubtype.civix.php';

// phpcs:disable
use CRM_Importcontactsubtype_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function importcontactsubtype_civicrm_config(&$config) {
  _importcontactsubtype_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function importcontactsubtype_civicrm_xmlMenu(&$files) {
  _importcontactsubtype_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function importcontactsubtype_civicrm_install() {
  _importcontactsubtype_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function importcontactsubtype_civicrm_postInstall() {
  _importcontactsubtype_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function importcontactsubtype_civicrm_uninstall() {
  _importcontactsubtype_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function importcontactsubtype_civicrm_enable() {
  _importcontactsubtype_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function importcontactsubtype_civicrm_disable() {
  _importcontactsubtype_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function importcontactsubtype_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _importcontactsubtype_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function importcontactsubtype_civicrm_managed(&$entities) {
  _importcontactsubtype_civix_civicrm_managed($entities);
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
function importcontactsubtype_civicrm_caseTypes(&$caseTypes) {
  _importcontactsubtype_civix_civicrm_caseTypes($caseTypes);
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
function importcontactsubtype_civicrm_angularModules(&$angularModules) {
  _importcontactsubtype_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function importcontactsubtype_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _importcontactsubtype_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function importcontactsubtype_civicrm_entityTypes(&$entityTypes) {
  _importcontactsubtype_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function importcontactsubtype_civicrm_themes(&$themes) {
  _importcontactsubtype_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function importcontactsubtype_civicrm_navigationMenu(&$menu) {
  _importcontactsubtype_civix_insert_navigation_menu($menu, 'Administer', [
    'label'      => E::ts('Import Contact Subtype Settings'),
    'name'       => 'importcontactsubtype_settings',
    'url'        => 'civicrm/admin/setting/importcontactsubtype',
    'permission' => 'administer CiviCRM',
    'operator'   => 'OR',
    'separator'  => 0,
  ]);
  _importcontactsubtype_civix_navigationMenu($menu);
}