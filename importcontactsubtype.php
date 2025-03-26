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
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function importcontactsubtype_civicrm_install() {
  _importcontactsubtype_civix_civicrm_install();
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
