<?php

use Civi\Api4\Contact;
use CRM_Importcontactsubtype_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Importcontactsubtype_Form_Settings extends CRM_Core_Form {

  private $_settingFilter = ['group' => 'importcontactsubtype'];

  private $_submittedValues = [];

  private $_settings = [];

  /**
   * CiviCRM function to build the form.
   *
   * @throws CRM_Core_Exception
   */
  public function buildQuickForm() {
    $this->addFormElements();
    parent::buildQuickForm();
  }

  /**
   * Validates the form submission.
   *
   * @return bool
   */
  public function validate() {

    $submittedValues = $this->exportValues();

    if (trim($submittedValues['import_csv_contactid']) == '' && trim($submittedValues['import_csv_externalid']) == '') {
      $this->_errors['import_csv_contactid']  = 'Both fields cannot be empty.';
      $this->_errors['import_csv_externalid'] = 'Both fields cannot be empty.';
    }

    return parent::validate();

  }

  /**
   * Get Redirect URL
   *
   * @return mixed|string
   */
  public static function getRedirectURL() {
    $redirectUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $redirectUrl .= CRM_Utils_System::url('civicrm/admin/setting/importcontactsubtype');
    $redirectUrl = str_replace("%2F", "/", $redirectUrl);
    $redirectUrl = str_replace("amp;", "", $redirectUrl);
    return $redirectUrl;
  }

  /**
   * Get formatted redirect URL for request.
   *
   * @param $redirectUrl
   *
   * @return mixed
   */
  public static function getFormattedRedirectUriForRequest($redirectUrl) {
    $redirectUrl = str_replace("&", "%26", $redirectUrl);
    return $redirectUrl;
  }

  public function importCSV($csv, $identifier = 'id') {
    $import_rows      = explode("\r\n", $csv);
    $contacts_updated = 0;
    $contactsubtypes = [];
    foreach ($import_rows as $import_row) {
      $row = explode(',', $import_row);

      if (!empty($row[0])) {
        // Load the existing Contact and any existing Contact Subtypes so they are not overwritten
        $results = Contact::get()
                                     ->addSelect('contact_sub_type')
                                     ->addWhere($identifier, '=', $row[0])
                                     ->addWhere('contact_type', '=', 'Individual')
                                     ->setLimit(1)
                                     ->execute()->first();

        if (isset($results)) {
          if (!empty($row[1])) {
            $contactsubtypes = explode(';', $row[1]);

            if (!empty($results['contact_sub_type'])) {
              $existing_contactsubtypes = $results['contact_sub_type'];
            }


            if (isset($existing_contactsubtypes)) {
              $contactsubtypes = array_unique(array_merge($existing_contactsubtypes, $contactsubtypes));
            }

            // Remove any empty array values
            $contactsubtypes = array_filter($contactsubtypes, 'strlen');

            // Update the Contact Type for the Contact
            try {
              Contact::update()
                                ->addValue('contact_sub_type', $contactsubtypes)
                                ->addWhere($identifier, '=', $row[0])
                                ->addWhere('contact_type', '=', 'Individual')
                                ->execute();
              $contacts_updated++;


            }
            catch (Exception $e) {
              // Catch any error and log it instead of throwing a typical CiviCRM wobbly
              $error_message         = $e->getMessage();
              $contact_update_errors .= $contact_update_errors . "\r\n" . $row[0] . ' - ' . $error_message;
              continue;
            }
          }
        }
      }
    }
    $identifier_string = 'CSV text with Contact ' . (($identifier == 'id') ? 'ID' : 'External ID');

    if ($contacts_updated > 0) {
      CRM_Core_Session::setStatus(E::ts('<br/>' . $contacts_updated . ' Contact(s) have been updated using ') . $identifier_string, $identifier_string, 'no-popup');
    }
    if (isset($contact_update_errors)) {
      CRM_Core_Session::setStatus(E::ts('<br/>The following rows could not be imported:') . '<br/>' . $contact_update_errors, $identifier_string, 'no-popup');
    }
  }

  /**
   * Handles the form submission.
   */
  public function postProcess() {
    $this->_submittedValues = $this->exportValues();
    $this->saveSettings();

    $csv = $this->_submittedValues['import_csv_contactid'];
    if (!empty($csv)) {
      $this->importCSV($csv, 'id');
    }

    $csv = $this->_submittedValues['import_csv_externalid'];
    if (!empty($csv)) {
      $this->importCSV($csv, 'external_identifier');
    }

    CRM_Utils_System::redirect($_SERVER['REQUEST_URI']);

    parent::postProcess();
  }

  /**
   * Add form elements
   */
  public function addFormElements() {
    $settings = $this->getFormSettings();
    foreach ($settings as $name => $setting) {
      if (isset($setting['quick_form_type'])) {
        $add = 'add' . $setting['quick_form_type'];
        if ($add == 'addElement') {
          $this->$add($setting['html_type'], $name, $setting['title'], CRM_Utils_Array::value('html_attributes', $setting, []));
        }
        elseif ($setting['html_type'] == 'Select') {
          $optionValues = [];
          if (!empty($setting['pseudoconstant']) && !empty($setting['pseudoconstant']['optionGroupName'])) {
            $optionValues = CRM_Core_OptionGroup::values($setting['pseudoconstant']['optionGroupName'], FALSE, FALSE, FALSE, NULL, 'name');
          }
          elseif (!empty($setting['pseudoconstant']) && !empty($setting['pseudoconstant']['callback'])) {
            $callBack     = Civi\Core\Resolver::singleton()
                                              ->get($setting['pseudoconstant']['callback']);
            $optionValues = call_user_func_array($callBack, $optionValues);
          }
          $this->add('select', $setting['name'], $setting['title'], $optionValues, FALSE, $setting['html_attributes']);
        }
        else {
          $this->$add($name, $setting['title']);
        }
      }
    }

    $this->assign('elementNames', $this->getRenderableElementNames());
    $this->addButtons([
      [
        'type'      => 'submit',
        'name'      => ts('Import Contacts'),
        'isDefault' => TRUE,
      ],
    ]);
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    $elementNames = [];
    foreach ($this->_elements as $element) {
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = [
          "name"        => $element->getName(),
          "description" => (isset($this->_settings[$element->getName()]["description"])) ? $this->_settings[$element->getName()]["description"] : '',
        ];
      }
    }
    return $elementNames;
  }

  /**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  public function getFormSettings() {
    if (empty($this->_settings)) {
      $settings        = civicrm_api3('setting', 'getfields', ['filters' => $this->_settingFilter]);
      $settings        = $settings['values'];
      $this->_settings = $settings;
    }
    return $this->_settings;
  }

  /**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  public function saveSettings() {
    $settings = $this->getFormSettings();
    $values   = array_intersect_key($this->_submittedValues, $settings);
    civicrm_api3('setting', 'create', $values);
    return $settings;
  }

  /**
   * Set defaults for form.
   *
   * @see CRM_Core_Form::setDefaultValues()
   */
  public function setDefaultValues() {
    $existing = civicrm_api3('setting', 'get', ['return' => array_keys($this->getFormSettings())]);
    $defaults = [];
    $domainID = CRM_Core_Config::domainID();
    foreach ($existing['values'][$domainID] as $name => $value) {
      $defaults[$name] = $value;
    }
    return $defaults;
  }

}
