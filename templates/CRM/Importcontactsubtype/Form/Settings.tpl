<p>Use the fields below to provide CSV text with Contact ID and Contact Subtypes or CSV text with External ID and Contact Subtypes.<br/>Use ; to separate multiple Contact Subtypes.</p>
<table class="form-layout">
  {foreach from=$elementNames item=element}
    {assign var="elementName" value=$element.name}
    <tr>
      <td class="label">{$form.$elementName.label}</td>
      <td>
          {$form.$elementName.html}
        <br />
        <span class="description">{ $element.description }</span>
      </td>
    </tr>
  {/foreach}
</table>
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>