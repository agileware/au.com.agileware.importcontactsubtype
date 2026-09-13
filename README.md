# Import Contact Subtype (au.com.agileware.importcontactsubtype)

This [CiviCRM](https://civicrm.org) extension provides a bulk import tool for **adding Contact
Subtypes to existing Individual Contacts** from pasted CSV text. It solves the problem of assigning
Contact Subtypes to a large number of Contacts at once — for example after a data migration, or
when subtypes need to be applied based on an external list — without having to edit each Contact
record individually.

Contacts can be matched by either their CiviCRM **Contact ID** or their **External ID**. Any Contact
Subtypes the Contact already has are *retained, not replaced* — the subtypes provided in the CSV are
merged with the existing ones. This means the same CSV (or an updated version of it) can be
imported more than once without losing previously assigned subtypes.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

Installing and enabling the extension adds a new **Import Contact Subtype Settings** page under
**Administer**, at `civicrm/admin/setting/importcontactsubtype`. Access to this page requires the
`administer CiviCRM` permission.

To import Contact Subtypes:

1. Go to **Administer > Import Contact Subtype Settings**
   (`civicrm/admin/setting/importcontactsubtype`).
2. Prepare CSV text with two columns, separated by a comma, using one of the following identifiers
   in the first column:
   * `Contact ID, Contact Subtype(s)`, or
   * `Contact External ID, Contact Subtype(s)`
   Multiple Contact Subtypes for the same Contact are separated with a semi-colon (`;`), e.g.
   `123,Staff;Board Member`.
3. Paste the CSV text into the **CSV text with Contact ID** field and/or the **CSV text with
   External ID** field. Only one of the two fields needs to be filled in — if both are filled in,
   both are processed.
4. Click **Import Contacts**.
5. A status message reports how many Contacts were updated, and lists any rows that could not be
   imported (e.g. because no matching Contact was found).

Notes on behaviour, based on the current implementation:

* Only Contacts with Contact Type **Individual** are matched and updated; rows for other Contact
  Types are silently skipped.
* Rows must be separated with a Windows-style line ending (`\r\n`). If you compose the CSV text on
  a Mac or Linux system, make sure your editor/clipboard preserves `\r\n` line endings, or the rows
  may not be recognised.
* The CSV text fields are plain [CiviCRM Settings](https://docs.civicrm.org/dev/en/latest/framework/setting/)
  (not treated as a persistent import log) — the text remains in the field between imports and is
  re-processed each time the form is submitted, so you may wish to clear it once an import is
  successful.
* There is no CSV header row support — every line is treated as a data row.

## Special Configuration Requirements

None. The extension does not require any API keys, OAuth credentials, or dependent extensions. The
only requirement is that the user importing Contacts holds the CiviCRM `administer CiviCRM`
permission, which controls access to the settings/import page.

## Requirements

* CiviCRM 5.51+

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin
Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

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
