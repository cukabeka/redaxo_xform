<?php
## register paths
rex_xform::addPath('manager', 'value', rex_path::plugin('xform', 'manager', 'lib/value/'));
rex_xform::addPath('manager', 'action', rex_path::plugin('xform', 'manager', 'lib/action/'));

if (rex::isBackend() && is_object(rex::getUser())) {
  $tables = new rex_xform_manager();
  $tables = $tables->getTables();

  if (is_array($tables) && !empty($tables)) {
    $pages = array();

    foreach ($tables as $table) {
      ## check addon-permission
      $table_perm = rex_xform_manager_table::getTablePermName($table['table_name']);
      rex_perm::register($table_perm);

      ## check active-state and permissions
      if ($table['status'] == 1 && $table['hidden'] != 1 && rex::getUser() && (rex::getUser()->isAdmin() || rex::getUser()->hasPerm($table_perm))) {
        $be_page = new rex_be_page('xform_table_' . $table['table_name'], $table['name']);

        $be_page->setPath($this->getBasePath('pages/data_edit.inc.php'));
        $pages[] = new rex_be_page_main('tables', $be_page);
      }
    }

    $this->setProperty('pages', $pages);
  }
}
