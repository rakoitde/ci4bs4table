<table id="<?= $tableid ?>" class="<?= $tableclasses ?>">
<?php if ($caption != '') : ?><caption><?= $caption ?></caption><?php endif ?>
    <form class="px-4 py-3" method="<?= $method ?>" action="<?= $baseurl ?>"></form>		
    <thead>
<?php d($thead->getAllFilterQueries()) ?>
        <tr>
<?php foreach ($thead->cols as $col) : ?>
        <th class="<?= $col->getAllClasses() ?>" <?= $col->colspan ?>>
            <?php ($col->sortable ? '<a class="text-reset" href="'.$col->getHref().'">' : ''); ?>
            <?= $col->getAllHtml() ?>
            <?php ($col->sortable ? ' '.$col->direction.'</a>' : ''); ?>
        </th>
<?php endforeach ?>
        </tr>


        <tr>
            <th class="">#</th>
            <th class="">
                <a class="text-reset" href="table?&amp;_sort[username]=asc">Benutzername </a> 
                <i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
                    <div class="form-group">
                        <input type="text" class="form-control" name="sort[username]" id="sortusername" value="">
                    </div>
                    <div class="form-group">
                        <input type="search" class="form-control" name="_filter[username]" id="filter_username" value="">
                    </div>
                    <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
                    <button type="button" class="btn" onclick="
                        $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
                        $('#filterusername').val(''); 
                        $(this.form).submit();
                        "><i class="bi bi-x-lg"> filter löschen</i></button>
                </div>
            </th>
			<th class="">
                <a class="text-reset" href="table?&amp;_sort[surname]=asc">Vorname </a> 
                <i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[surname]" id="sortsurname" value="">
            </div>
        <!-- DEBUG-VIEW START 4 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->
            <div class="form-group">
                <input type="search" class="form-control" name="_filter[surname]" id="filter_surname" value="">
            </div>'
<!-- DEBUG-VIEW ENDED 4 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filtersurname').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
			<th class=""><a class="text-reset" href="table?&amp;_sort[lastname]=asc">Nachname </a> 
<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[lastname]" id="sortlastname" value="">
            </div>
        <!-- DEBUG-VIEW START 5 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->
            <div class="form-group">
                <input type="search" class="form-control" name="_filter[lastname]" id="filter_lastname" value="">
            </div>'
<!-- DEBUG-VIEW ENDED 5 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filterlastname').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
			<th class=""><a class="text-reset" href="table?&amp;_sort[password]=asc">Password </a> 
<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[password]" id="sortpassword" value="">
            </div>
        <!-- DEBUG-VIEW START 6 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->
            <div class="form-group">
                <input type="search" class="form-control" name="_filter[password]" id="filter_password" value="">
            </div>'
<!-- DEBUG-VIEW ENDED 6 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filterpassword').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
			<th class=""><a class="text-reset" href="table?&amp;_sort[sid]=asc">SID </a> 
<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[sid]" id="sortsid" value="">
            </div>
        <!-- DEBUG-VIEW START 7 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->
            <div class="form-group">
                <input type="search" class="form-control" name="_filter[sid]" id="filter_sid" value="">
            </div>'
<!-- DEBUG-VIEW ENDED 7 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filtersid').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
			<th class=""><a class="text-reset" href="table?&amp;_sort[enabled]=asc">Enabled </a> 
<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[enabled]" id="sortenabled" value="">
            </div>
        <!-- DEBUG-VIEW START 8 /Applications/MAMP/htdocs/ci4bs4table/src/Views/CheckBox.php -->
<div class="px-2 pb-1">
    <div class="form-check pl-4 pb-1">
        <input class="form-check-input checkall" type="checkbox" id="checkall_enabled">
        <label class="form-check-label font-weight-normal checklabel" for="checkall_enabled"> Check all</label></div>

        <hr class="dropdown-divider">

 



    <div class="_filter_options">
        <div class="form-check pl-4 pb-1">
          <input class="form-check-input" type="checkbox" value="1" name="_filter[enabled][1]" id="enabled_1_id">
          <label class="form-check-label font-weight-normal" for="enabled_1_id">
            Aktiviert          </label>
        </div>
    </div>

 



    <div class="_filter_options">
        <div class="form-check pl-4 pb-1">
          <input class="form-check-input" type="checkbox" value="1" name="_filter[enabled][0]" id="enabled_0_id">
          <label class="form-check-label font-weight-normal" for="enabled_0_id">
            Deaktiviert          </label>
        </div>
    </div>


</div>

<!-- DEBUG-VIEW ENDED 8 /Applications/MAMP/htdocs/ci4bs4table/src/Views/CheckBox.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filterenabled').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
			<th class=""><a class="text-reset" href="table?&amp;_sort[testdate]=asc">Test Datum </a> 
<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[testdate]" id="sorttestdate" value="">
            </div>
        <!-- DEBUG-VIEW START 9 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->
            <div class="form-group">
                <input type="search" class="form-control" name="_filter[testdate]" id="filter_testdate" value="">
            </div>'
<!-- DEBUG-VIEW ENDED 9 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filtertestdate').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
			<th class=""><a class="text-reset" href="table?&amp;_sort[testjson]=asc">Test JSON </a> 
<i class="bi bi-funnel" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="dropdownMenuButton">
            <div class="form-group">
                <input type="text" class="form-control" name="sort[testjson]" id="sorttestjson" value="">
            </div>
        <!-- DEBUG-VIEW START 10 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->
            <div class="form-group">
                <input type="search" class="form-control" name="_filter[testjson]" id="filter_testjson" value="">
            </div>'
<!-- DEBUG-VIEW ENDED 10 /Applications/MAMP/htdocs/ci4bs4table/src/Views/TextField.php -->

            <button type="submit" class="btn"><i class="bi bi-check-lg"></i>&nbsp;&nbsp;filtern</button>
            <button type="button" class="btn" onclick="
            $(this).closest('.dropdown-menu').find('._filter_options input:checkbox').remove();
            $('#filtertestjson').val(''); 
            $(this.form).submit();
            "><i class="bi bi-x-lg"> filter löschen</i></button>
        </div></th>
<!-- DEBUG-VIEW START 11 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
</th>

<!-- DEBUG-VIEW ENDED 11 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
	
	</thead><tbody>
		<tr class="">
<!-- DEBUG-VIEW START 12 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
2</th>

<!-- DEBUG-VIEW ENDED 12 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 13 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
marie</td>

<!-- DEBUG-VIEW ENDED 13 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 14 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 14 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 15 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 15 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 16 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Geheim2</td>

<!-- DEBUG-VIEW ENDED 16 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 17 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
nööö</td>

<!-- DEBUG-VIEW ENDED 17 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 18 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 18 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 19 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
<i class="bi bi-file-earmark-person "></i></td>

<!-- DEBUG-VIEW ENDED 19 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 20 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 20 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 21 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 2</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 21 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 22 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
3</th>

<!-- DEBUG-VIEW ENDED 22 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 23 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
silvia</td>

<!-- DEBUG-VIEW ENDED 23 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 24 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 24 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 25 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 25 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 26 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Gehiem</td>

<!-- DEBUG-VIEW ENDED 26 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 27 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
lskdf</td>

<!-- DEBUG-VIEW ENDED 27 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 28 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 28 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 29 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
<i class="bi bi-file-earmark-person "></i></td>

<!-- DEBUG-VIEW ENDED 29 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 30 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 30 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 31 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 3</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 31 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 32 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
4</th>

<!-- DEBUG-VIEW ENDED 32 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 33 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
k98kornr</td>

<!-- DEBUG-VIEW ENDED 33 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 34 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="table-success">
Ralf</td>

<!-- DEBUG-VIEW ENDED 34 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 35 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 35 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 36 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
rakobo</td>

<!-- DEBUG-VIEW ENDED 36 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 37 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
horst</td>

<!-- DEBUG-VIEW ENDED 37 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 38 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center table-warning">
0<i class="bi bi-file-earmark-person text-danger"></i> Deaktiviert</td>

<!-- DEBUG-VIEW ENDED 38 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 39 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
<i class="bi bi-file-earmark-person "></i></td>

<!-- DEBUG-VIEW ENDED 39 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 40 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 40 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 41 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 4</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 41 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 42 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
5</th>

<!-- DEBUG-VIEW ENDED 42 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 43 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
horst</td>

<!-- DEBUG-VIEW ENDED 43 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 44 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 44 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 45 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 45 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 46 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Geheim2</td>

<!-- DEBUG-VIEW ENDED 46 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 47 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
nööö</td>

<!-- DEBUG-VIEW ENDED 47 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 48 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 48 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 49 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
<i class="bi bi-file-earmark-person "></i></td>

<!-- DEBUG-VIEW ENDED 49 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 50 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 50 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 51 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 5</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 51 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 52 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
6</th>

<!-- DEBUG-VIEW ENDED 52 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 53 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
heidi</td>

<!-- DEBUG-VIEW ENDED 53 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 54 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 54 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 55 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 55 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 56 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Gehiem</td>

<!-- DEBUG-VIEW ENDED 56 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 57 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
lskdf</td>

<!-- DEBUG-VIEW ENDED 57 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 58 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center table-warning">
0<i class="bi bi-file-earmark-person text-danger"></i> Deaktiviert</td>

<!-- DEBUG-VIEW ENDED 58 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 59 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
<i class="bi bi-file-earmark-person "></i></td>

<!-- DEBUG-VIEW ENDED 59 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 60 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 60 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 61 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 6</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 61 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 62 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
7</th>

<!-- DEBUG-VIEW ENDED 62 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 63 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
klaus</td>

<!-- DEBUG-VIEW ENDED 63 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 64 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 64 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 65 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 65 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 66 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
rakobo</td>

<!-- DEBUG-VIEW ENDED 66 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 67 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
horst</td>

<!-- DEBUG-VIEW ENDED 67 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 68 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 68 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 69 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
<i class="bi bi-file-earmark-person "></i></td>

<!-- DEBUG-VIEW ENDED 69 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 70 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 70 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 71 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 7</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 71 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 72 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
8</th>

<!-- DEBUG-VIEW ENDED 72 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 73 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
marie</td>

<!-- DEBUG-VIEW ENDED 73 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 74 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 74 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 75 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 75 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 76 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Geheim2</td>

<!-- DEBUG-VIEW ENDED 76 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 77 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
nööö</td>

<!-- DEBUG-VIEW ENDED 77 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 78 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 78 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 79 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
2021-05-25</td>

<!-- DEBUG-VIEW ENDED 79 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 80 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
{"id": "4", "name": "Betty"}</td>

<!-- DEBUG-VIEW ENDED 80 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 81 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 8</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 81 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 82 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
9</th>

<!-- DEBUG-VIEW ENDED 82 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 83 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
silvia</td>

<!-- DEBUG-VIEW ENDED 83 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 84 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 84 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 85 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 85 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 86 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Gehiem</td>

<!-- DEBUG-VIEW ENDED 86 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 87 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
lskdf</td>

<!-- DEBUG-VIEW ENDED 87 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 88 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 88 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 89 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
2021-05-26</td>

<!-- DEBUG-VIEW ENDED 89 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 90 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 90 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 91 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 9</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 91 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 92 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
10</th>

<!-- DEBUG-VIEW ENDED 92 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 93 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
k98kornr</td>

<!-- DEBUG-VIEW ENDED 93 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 94 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="table-success">
Ralf</td>

<!-- DEBUG-VIEW ENDED 94 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 95 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 95 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 96 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
rakobo</td>

<!-- DEBUG-VIEW ENDED 96 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 97 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
horst</td>

<!-- DEBUG-VIEW ENDED 97 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 98 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center table-warning">
0<i class="bi bi-file-earmark-person text-danger"></i> Deaktiviert</td>

<!-- DEBUG-VIEW ENDED 98 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 99 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
2021-05-27</td>

<!-- DEBUG-VIEW ENDED 99 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 100 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 100 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 101 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 10</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 101 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
		<tr class="">
<!-- DEBUG-VIEW START 102 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<th class="">
11</th>

<!-- DEBUG-VIEW ENDED 102 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 103 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
horst</td>

<!-- DEBUG-VIEW ENDED 103 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 104 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 104 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 105 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Kornberger</td>

<!-- DEBUG-VIEW ENDED 105 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 106 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
Geheim2</td>

<!-- DEBUG-VIEW ENDED 106 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 107 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
nööö</td>

<!-- DEBUG-VIEW ENDED 107 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 108 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="text-center">
1<i class="bi bi-file-earmark-person text-success"></i> Aktiviert</td>

<!-- DEBUG-VIEW ENDED 108 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 109 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
2021-05-28</td>

<!-- DEBUG-VIEW ENDED 109 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 110 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="">
</td>

<!-- DEBUG-VIEW ENDED 110 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<!-- DEBUG-VIEW START 111 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
<td class="py-1 text-right">
<div class="btn-group" role="group">
  <button type="button" class="btn btn-sm btn-outline-secondary">Left 11</button>
  <button type="button" class="btn btn-sm btn-outline-primary">Middle</button>
  <button type="button" class="btn btn-sm btn-outline-danger">Right</button>
</div></td>

<!-- DEBUG-VIEW ENDED 111 /Applications/MAMP/htdocs/ci4bs4table/src/Views/Cell.php -->
		</tr>
	</tbody>
</table>