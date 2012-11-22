<?php

$table_name = substr(rex_be_controller::getCurrentPage(), 12);

if (
  $table_name != ''
  && rex::getUser()
  && (rex::getUser()->isAdmin() || rex::getUser()->hasPerm(rex_xform_manager_table::getTablePermName($table_name)) )
  ) {

  $page = new rex_xform_manager();
  $page->setFilterTable($table_name);
  $page->setLinkVars(  array('page' => rex_be_controller::getCurrentPage())  );
  echo $page->getDataPage();

}
