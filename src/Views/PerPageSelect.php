        <select name="perpage" class="custom-select custom-select-sm w-auto">
          <option value="10"  <?= $perpage=="10"  ? "selected" : ""; ?>>10</option>
          <option value="15"  <?= $perpage=="15"  ? "selected" : ""; ?>>15</option>
          <option value="20"  <?= $perpage=="20"  ? "selected" : ""; ?>>20</option>
          <option value="25"  <?= $perpage=="25"  ? "selected" : ""; ?>>25</option>
          <option value="50"  <?= $perpage=="50"  ? "selected" : ""; ?>>50</option>
          <option value="100" <?= $perpage=="100" ? "selected" : ""; ?>>100</option>
        </select>