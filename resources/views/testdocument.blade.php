<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Document sans titre</title>
    <link href="app/public/css/document.css" rel="stylesheet" type="text/css" />
    <script language="Javascript" type="text/javascript" src="../script/visible.js"></script>
</head>

<body>
    <?php foreach ($users as $user) {
    echo $user->name;
};
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" valign="top"><table width="98%" height="680" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="18%" align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left"><span class="title_1"><span class="big_3">Documents</span></span></td>
                            </tr>
                        </table>
                        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="30" align="left" class="txt_4">Common tasks </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="16%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Add new..." width="18" height="18" /></span></td>
                                <td width="84%" align="left" class="subtitle_3"><a href="./?page_id=document&amp;show=list">List of Documents </a> </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="16%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Add new..." width="18" height="18" /></span></td>
                                <td width="84%" align="left" class="subtitle_3"> <a href="./?page_id=document&amp;show=add">Add New Document </a> </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="16%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Add new..." width="18" height="18" /></span></td>
                                <td width="84%" align="left" class="subtitle_3"><a href="./?page_id=document&amp;show=folder">List of Folders </a> </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="30" align="left" class="txt_2">&nbsp;</td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="30" align="left" class="txt_4">Related links </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="17%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Add new..." width="18" height="18" /></span></td>
                                <td width="83%" align="left" class="subtitle_3"><a href="#" onclick="window.open('./doctype_management.php','List','width=800,height=580,scrollbars=1').focus();">Doc Type </a> </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="17%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Add new..." width="18" height="18" /></span></td>
                                <td width="83%" align="left" class="subtitle_3"><a href="#" onclick="window.open('./folder_management.php','List','width=800,height=580,scrollbars=1').focus();">Folder</a> </td>
                            </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="30" align="left" class="txt_4">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td width="82%" align="left" valign="top">

                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left" class="title_1"><span  class="important_2"><span class="txt_4">Manage Documents | </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=document&amp;show=list"> List of Documents</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=document&amp;show=add"> Add New  Document</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=document&amp;show=folder"> List of Folders </a></span></td>
                            </tr>
                        </table>
                        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                            <tr>
                                <td></td>
                            </tr>
                        </table>


                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="51%" align="left" class="big_3">Add New  Document</td>
                                            <td width="49%" align="right" class="txt_1g">&nbsp;</td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <form id="form_add" name="form_add" method="post" action="" enctype="multipart/form-data">
                                            <tr>
                                                <td align="left" valign="top"><table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td width="14%" align="left">&nbsp;</td>
                                                            <td width="86%" align="left">
                                                                <input name="htxt_op" type="hidden" id="htxt_op" value=""/>
                                                                <input name="htxt_id" type="hidden" id="htxt_id" value=""/></td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Doc Type  </td>
                                                            <td align="left">
                                                                <label></label>               </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="14%" height="30" align="left" class="txt_1">Title </td>
                                                            <td width="86%" align="left"><label>
                                                                    <input name="txt_title" type="text" class="line_3" id="txt_title" size="45"  value=""/>
                                                                </label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="61" align="left" class="txt_1">Description </td>
                                                            <td align="left"><label>
                                  <textarea name="txt_descript" cols="45" rows="3" class="line_4" id="txt_descript">
                                                                </label></td>
                                                        </tr>

                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Key Word </td>
                                                            <td align="left"><label>
                                </label></td>
                              </tr>
                            </table>
                          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td width="14%" align="left">&nbsp;</td>
                                                            <td width="86%" align="left">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td width="14%" height="30" align="left" class="txt_1">Owner </td>
                                                            <td width="86%" align="left"><label>
                                                                    <input name="txt_owner" type="text" class="line_4" id="txt_owner" size="45"  value=""/>
                                                                </label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Prepared By  </td>
                                                            <td align="left"><label>
                                                                    <input name="txt_preparedby" type="text" class="line_4" id="txt_preparedby" size="35" value=""/>
                                                                </label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Reviewed By  </td>
                                                            <td align="left"><label>
                                                                    <input name="txt_reviewedby" type="text" class="line_4" id="txt_reviewedby" size="35" value=""/>
                                                                </label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Approved By </td>
                                                            <td align="left"><label>
                                                                    <input name="txt_approvedby" type="text" class="line_4" id="txt_approvedby" size="35"  value=""/>
                                                                </label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Date of Creation </td>
                                                            <td align="left"><label>
                                                                    <input name="txt_datecreat" type="text" class="line_4" id="txt_datecreat"  readonly="readonly"/>
                                                                    <a href="#" onclick=" window.open('../lib/calendar/calendar.php?frm=form_add&amp;ch=txt_datecreat','calendrier','width=350,height=160,scrollbars=0').focus();"> <img src="../image/icon/date.png" width="22" height="22" border="0" align="absmiddle" /> </a></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Date of Signature </td>
                                                            <td align="left"><input name="txt_datesign" type="text" class="line_4" id="txt_datesign"  readonly="readonly"/>
                                                                <a href="#" onclick=" window.open('../lib/calendar/calendar.php?frm=form_add&amp;ch=txt_datesign','calendrier','width=350,height=160,scrollbars=0').focus();"> <img src="../image/icon/date.png" width="22" height="22" border="0" align="absmiddle" /> </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="30" align="left" class="txt_1">Number of Page</td>
                                                            <td align="left"><input name="txt_nbr_page" type="text" class="line_4" id="txt_nbr_page" size="35" value=""/></td>
                                                        </tr>
                                                    </table>



                                                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td width="14%" align="left">&nbsp;</td>
                                                            <td width="86%" align="left">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="14%" align="left" class="txt_1">&nbsp;</td>
                                                            <td width="86%" align="left" class="txt_4">
                                                                <label><span class="txt_1"><a href="#" onclick="javascript:visibilite('attach_file');">[Folder]</a></span></label></td>
                                                        </tr>
                                                    </table>

                                                    <div id="attach_file" style="display:">

                                                        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                                            <tr>
                                                                <td></td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                            <tr>
                                                                <td width="14%" align="left">&nbsp;</td>
                                                                <td width="86%" align="left"></td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="line_2">
                                                            <tr>
                                                                <td height="31" align="left" class="txt_1">Folder </td>
                                                                <td align="left"><label></label>                              </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="31" align="left" class="txt_1">Detail</td>
                                                                <td align="left"><label>
                                                                        <input name="txt_precision" type="text" id="txt_precision" size="45" />
                                                                    </label></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="14%" height="30" align="left" class="txt_1">File Attached </td>
                                                                <td width="86%" align="left"><label>

                                                                        <input name="fichier" type="file" class="line_4" id="fichier" size="50"/>
                                                                    </label></td>
                                                            </tr>
                                                        </table>

                                                    </div>

                                                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td width="14%" align="left">&nbsp;</td>
                                                            <td width="86%" align="left" class="txt_2">Be sure that all important fields are filled before to submit </td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                                        <tr>
                                                            <td width="14%" align="left">&nbsp;</td>
                                                            <td width="86%" align="left"><label>
                                                                    <input name="sub_document" type="submit" class="btn_link_2" id="sub_document" value="Submit Document" />
                                                                </label></td>
                                                        </tr>
                                                    </table></td>
                                            </tr>
                                        </form>
                                    </table></td>
                            </tr>
                        </table>



                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="46%" align="left" class="big_3">List of  Documents</td>
                                            <td width="54%" align="right" class="title_1"><table width="99%" height="28" border="0" cellpadding="0" cellspacing="0">
                                                    <form id="form1" name="form1" method="get" action="">
                                                        <tr>
                                                            <td align="right"> Search :
                                                                <label id="search1">
                                                                    <input name="txt_search_doc" type="text" id="txt_search_doc" value="" onclick="this.value=''"/>
                                                                </label>
                                                                <label id="search2">
                                                                    <input name="sub_search_doc" type="submit" id="sub_search_doc" value="Search"/>
                                                                </label>
                                                                | <span class="txt_1g"><a href="./?page_id=document&amp;show=list">Show All  Document</a></span> &nbsp;</td>
                                                        </tr>
                                                    </form>
                                                </table></td>
                                        </tr>
                                    </table>
                                    <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                        <tr>

                                            <td width="4%" align="center">N&deg;</td>
                                            <td width="44%" align="left">Title (Description) </td>
                                            <td width="16%" align="left">Creat. Date </td>
                                            <td width="24%" align="left">

                                                <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                                                    <form id="form2" name="form2" method="post" action="">
                                                        <tr>
                                                            <td align="left"></td>
                                                        </tr>
                                                    </form>
                                                </table>                      </td>
                                            <td width="10%" align="center">Action</td>
                                        </tr>
                                    </table>
                                    <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <div id="zone_list"> </div>
                                </td>
                            </tr>
                        </table>



                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="50%" align="left" class="big_3">List of  Folders</td>
                                            <td width="50%" align="right" class="title_1"><table width="99%" height="28" border="0" cellpadding="0" cellspacing="0">
                                                    <form id="form1" name="form1" method="get" action="">
                                                        <tr>
                                                            <td align="right"> Search :
                                                                <label id="search1">
                                                                    <input name="txt_search_folder" type="text" id="txt_search_folder" value="" onclick="this.value=''"/>
                                                                </label>
                                                                <label id="search2">
                                                                    <input name="sub_search_folder" type="submit" id="sub_search_folder" value="Search"/>
                                                                </label>
                                                                <span class="txt_1g"><a href="./?page_id=document&amp;show=folder">Show All Folders </a></span> </td>
                                                        </tr>
                                                    </form>
                                                </table></td>
                                        </tr>
                                    </table>
                                    <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                                        <tr>
                                            <td width="4%" align="center">N&deg;</td>
                                            <td width="28%" align="left">Foder name </td>
                                            <td width="56%" align="left">Description</td>
                                            <td width="12%" align="center">Action</td>
                                        </tr>
                                    </table>
                                    <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <div id="zone_list"></div>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table></td>
    </tr>
</table>

</body>