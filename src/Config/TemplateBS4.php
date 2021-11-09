<?php

namespace Rakoitde\Ci4bs4table\Config;

class TemplateBS4
{

	// per page select
	public string $perpage_select_start = '<select name="{perpagevar}" class="custom-select custom-select-sm w-auto" form="{formid}">';
	public string $perpage_select_option = '<option value="{value}" {selected}>{value}</option>';
	public string $perpage_select_end = '</select>';

	// search field and buttons
	public string $search_field       = '<input type="search" name="{searchvar}" class="form-control form-control-sm w-auto" value="{value}" form="{formid}">';
	public string $submit_button      = '<button class="btn btn-outline-secondary" type="submit" form="{formid}">Suchen</button>';
	public string $reset_button       = '<a role="button" class="btn btn-outline-secondary" href="{uri}">Filter löschen</a>';

	// inline form with page select, search field and buttons
	public string $inline_form_start  = '<form class="form-inline">{pagerlinks}
	<div class="input-group input-group-sm pl-3">';
	public string $inline_form_elements = '{perpageselect}{searchfield}<div class="input-group-append">{submitbutton}{resetbutton}</div>';
	public string $inline_form_end   =  '</div></form>';

	// table
	public string $table_open         = '<table %s>';
	public string $table_form		  = '<form id="form_%s" class="px-4 py-3" method="get" action="%s"></form>';
	public string $caption  		  = '<caption>%s</caption>';
	public string $pager_caption      = 'Datensatz {from} bis {to} von {total}';
	public string $table_close        = '</table>';

	// thead
	public string $thead_open         = '<thead>';
	public string $thead_close        = '</thead>';
	public string $heading_row_start  = '<tr %s>';
	public string $heading_row_end    = '</tr>';
	public string $heading_cell_start = '<th %s>';
	public string $heading_cell_end   = '</th>';
	public array  $heading_cell_sorted_icon = [
		''=>'', 
		'asc'=>'<i class="bi bi-sort-down-alt pl-1"></i>', 
		'desc'=>'<i class="bi bi-sort-up pl-1"></i>'
	];

	public string $heading_cell_sorted_start = '<a class="text-reset" href="%s">';
	public string $heading_cell_sorted_end   = '</a>';

	public array $heading_cell_filtered_icon = [
		true => 'class="bi bi-funnel-fill"',
		false => 'class="bi bi-funnel"'
	];
	public string $heading_cell_filter_dropdown_icon_filtered = '<i class="bi bi-funnel-fill pl-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
	public string $heading_cell_filter_dropdown_icon_notfiltered = '<i class="bi bi-funnel pl-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
	public string $heading_cell_filter_dropdown_start = '<div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton" x-placement="bottom-end" style="position: absolute; transform: translate3d(182px, 1074px, 0px); top: 0px; left: 0px; will-change: transform;">';
	public string $heading_cell_filter_dropdown_end = '</div>';

	public string $heading_cell_filter_text = '<div class="form-group">
	<input type="search" class="form-control" name="{filtervar}[{fieldname}]" id="filter_{fieldname}" value="{value}" form="form_{id}">
	</div>
	<button type="submit" class="btn" form="form_{id}"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
	<button type="button" class="btn" onclick="
	$(this).closest(\'.dropdown-menu\').find(\'._filter_options input:checkbox\').remove();
	$(\'#filter_{fieldname}\').val(\'\'); 
	$(this.form).submit();
	"><i class="bi bi-x-lg"> filter löschen</i></button>';
	public string $heading_cell_filter_checkbox_start = '
	<div class="px-2 pb-1">
	<div class="form-check pl-4 pb-1">
	<input class="form-check-input checkall" type="checkbox" id="checkall_{fieldname}">
	<label class="form-check-label font-weight-normal checklabel" for="checkall_{fieldname}"> Check all</label>
	</div>
	<hr class="dropdown-divider">';
	public string $heading_cell_filter_checkbox = '
	<div class="_filter_options">
	<div class="form-check pl-4 pb-1">
	<input class="form-check-input" type="checkbox" value="1" name="{filtervar}[{fieldname}][{key}]" id="{fieldname}_{key}_id" form="form_{id}" {checked}>
	<label class="form-check-label font-weight-normal" for="{fieldname}_{key}_id">{value}</label>
	</div>
	</div>';
	public string $heading_cell_filter_checkbox_end = '
	<button type="submit" class="btn" form="form_{id}"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
	<button type="button" class="btn" onclick="
	$(this).closest(\'.dropdown-menu\').find(\'._filter_options input:checkbox\').remove();
	$(\'#filter_{fieldname}\').val(\'\'); 
	$(\'#form_{id}\').submit();
	"><i class="bi bi-x-lg"> filter löschen</i></button>';

		// tfoot
	public string $tfoot_open         = '<tfoot>';
	public string $tfoot_close        = '</tfoot>';
	public string $footing_row_start  = '<tr>';
	public string $footing_row_end    = '</tr>';
	public string $footing_cell_start = '<td>';
	public string $footing_cell_end   = '</td>';

		// tbody
	public string $tbody_open         = '<tbody>';
	public string $tbody_close        = '</tbody>';
	public string $row_start          = '<tr %s>';
	public string $row_end            = '</tr>';
	public string $cell_start         = '<td %s>';
	public string $cell_end           = '</td>';
	public string $row_alt_start      = '<tr>';
	public string $row_alt_end        = '</tr>';
	public string $cell_alt_start     = '<td>';
	public string $cell_alt_end       = '</td>';


		// depricated => template
	public string $icontag = '<i class="bi bi-{icon}{class}"></i>';

}

