<?php

namespace Rakoitde\Ci4bs4table\Config;

class TemplateBS4
{

	public string $table_open         = '<table %s>';

	public string $table_form		  = '<form id="form_%s" class="px-4 py-3" method="get" action="%s"></form>';

	public string $thead_open         = '<thead>';
	public string $thead_close        = '</thead>';
	public string $heading_row_start  = '<tr %s>';
	public string $heading_row_end    = '</tr>';
	public string $heading_cell_start = '<th %s>';
	public string $heading_cell_end   = '</th>';
    public array  $heading_cell_sorted_icon = [
                ''=>'', 
                'asc'=>'<i class="bi bi-sort-down-alt"></i>', 
                'desc'=>'<i class="bi bi-sort-up"></i>'
        ];
	public string $heading_cell_sorted_start = '<a class="text-reset" href="%s">';
	public string $heading_cell_sorted_end   = '</a>';

	public array $heading_cell_filtered_icon = [
				true => 'class="bi bi-funnel-fill"',
				false => 'class="bi bi-funnel"'];
	public string $heading_cell_filter_dropdown_icon_filtered = '<i class="bi bi-funnel-fill" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
	public string $heading_cell_filter_dropdown_icon_notfiltered = '<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
	public string $heading_cell_filter_dropdown_start = '<div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton" x-placement="bottom-end" style="position: absolute; transform: translate3d(182px, 1074px, 0px); top: 0px; left: 0px; will-change: transform;">';
	public string $heading_cell_filter_dropdown_end = '</div>';
	// heading_cell_filter_text
	// $template = $t->heading_cell_filter_text;
	// $template = str_replace("{filtervar}", $this->config->filtervar, $$template);
	// $template = str_replace("{fieldname}", $this->fieldname, $$template);
	// $template = str_replace("{value}", $value, $$template);
	public string $heading_cell_filter_text = '<div class="form-group">
                <input type="search" class="form-control" name="{filtervar}[{fieldname}]" id="filter_{fieldname}" value="{value}" form="form_{id}">
            </div>
            <button type="submit" class="btn" form="form_{id}"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest(\'.dropdown-menu\').find(\'._filter_options input:checkbox\').remove();
            $(\'#filter_{fieldname}\').val(\'\'); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>';

	public string $tfoot_open         = '<tfoot>';
	public string $tfoot_close        = '</tfoot>';
	public string $footing_row_start  = '<tr>';
	public string $footing_row_end    = '</tr>';
	public string $footing_cell_start = '<td>';
	public string $footing_cell_end   = '</td>';

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

	public string $table_close        = '</table>';

}

