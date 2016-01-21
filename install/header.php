<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<style type="text/css">
  <?php include("../css/style.css"); ?>
</style>
<meta name="description" content="Espabiblio Giordano Bruno Library Automation System and Digic  Library.">
<!-- **************************************************************************************
     * jalg para ver icono en la pestaña del explorador, para personalizar cambiar el favicon.ico en la raIZ
     **************************************************************************************-->

<link href='../favicon.ico' rel='icon' type='image/x-icon'/>
<title>OpenBiblio Install</title>
</head>
<body bgcolor="#ffffff" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0" <?php
  if (isset($focus_form_name) && ($focus_form_name != "")) {
    if (preg_match('/^[a-zA-Z0-9_]+$/', $focus_form_name)
        && preg_match('/^[a-zA-Z0-9_]+$/', $focus_form_field)) {
      echo 'onLoad="self.focus();document.'.$focus_form_name.".".$focus_form_field.'.focus()"';
    }
  } ?> >
<!-- **************************************************************************************
     * OpenBiblio logo and black background with links and date
     **************************************************************************************-->
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr bgcolor="#bebdbe">
    <td align="left"><img src="../images/obiblio_logo.gif" width="170" height="35" border="0"></td>
    <td align="right" valign="top" width="100%"><font color="#ffffff">
    </td>
  </tr>
</table>

<!-- **************************************************************************************
     * beginning of main body
     **************************************************************************************-->
<font class="primary">
</font>
