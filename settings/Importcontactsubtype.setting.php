<?php

return [
  'import_csv_contactid'  => [
    'group_name'      => 'Import Contact Subtypes',
    'group'           => 'importcontactsubtype',
    'name'            => 'import_csv_contactid',
    'type'            => 'Text',
    'is_domain'       => 1,
    'is_contact'      => 0,
    'default'         => '',
    'description'     => 'Enter CSV with two columns: Contact ID and Contact Subtype, separated by semi-colon (;)',
    'title'           => 'CSV text with Contact ID',
    'help_text'       => '',
    'html_type'       => 'textarea',
    'html_attributes' => [
      'size' => 200,
    ],
    'quick_form_type' => 'Element',
  ],
  'import_csv_externalid' => [
    'group_name'      => 'Import Contact Subtypes',
    'group'           => 'importcontactsubtype',
    'name'            => 'import_csv_externalid',
    'type'            => 'Text',
    'is_domain'       => 1,
    'is_contact'      => 0,
    'default'         => '',
    'description'     => 'Enter CSV with two columns: External ID and Contact Subtype, separated by semi-colon (;)',
    'title'           => 'CSV text with External ID',
    'help_text'       => '',
    'html_type'       => 'textarea',
    'html_attributes' => [
      'size' => 200,
    ],
    'quick_form_type' => 'Element',
  ],
];
