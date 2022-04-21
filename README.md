# Import Contact Subtype

Provides feature to _append_ the Contact Subtypes for a Contact when providing CSV text in the format of:
1. Contact ID, Contact Subtypes, and/or
2. Contact External ID, Contact Subtypes

Any existing Contact Subtypes are _retained and not replaced_. Allowing this import to be executed multiple times for the same Contact, if required.

# Installation

1. Install and enable this CiviCRM extension.
2. Go to the **Import Contact Subtype
   Settings** page, `civicrm/admin/setting/importcontactsubtype`
3. Create CSV delimited text with two columns: `Contact ID` and `Contact Subtype`, separated by semi-colon (;)
4. Paste the CSV text into the `CSV text with Contact ID` field
5. Create CSV delimited text with two columns: `External ID` and `Contact Subtype`, separated by semi-colon (;)
6. Paste the CSV text into the `CSV text with External ID` field
7. _Note_: Only one CSV text field needs to be provided.
8. Click the `Import Contacts` button to update the Contacts

# About the Authors

This CiviCRM extension was developed by the team at [Agileware](https://agileware.com.au).

[Agileware](https://agileware.com.au) provide a range of CiviCRM services including:

* CiviCRM migration
* CiviCRM integration
* CiviCRM extension development
* CiviCRM support
* CiviCRM hosting
* CiviCRM remote training services

Support your Australian [CiviCRM](https://civicrm.org) developers, [contact Agileware](https://agileware.com.au/contact) today!

![Agileware](images/agileware-logo.png)