<?php

$content = '';

$subpage = rex_be_controller::getCurrentPagePart(2);
$func = rex_request('func', 'string', '');

if ($subpage != 'overview') {
  switch ($subpage) {
    case 'description':
      include rex_path::addon('xform', 'pages/description.inc.php');
      break;
    default:
      include rex_path::plugin('xform', $subpage, 'pages/index.inc.php');
    break;
  }
} else {
  $content .= '<h2>XFORM - ' . rex_i18n::msg('xform_overview') . '</h2>';

  ## output
  echo rex_view::title(rex_i18n::msg('xform'));
  echo rex_view::contentBlock($content, '', 'block');
}
