<?php
    include 'top.php';
    if (!$gAuthUser)
       uni_redirect(PATH_ROOT);

    include INC_PATH . 'includes/classes/BOpt.php';
    include INC_PATH . 'includes/classes/BText.php';
    include INC_PATH . 'includes/classes/BInfo.php';
    include INC_PATH . 'includes/classes/BPhoto.php';
    include INC_PATH . 'includes/classes/BComment.php';

#*************************************************************
# For user customized modules
#*************************************************************
if (isset($_REQUEST['uid']))
{
    try
    {
        $UserInfo =& $user->Get($_REQUEST['uid']);
        $gSmarty -> assign_by_ref('UserInfo', $UserInfo);
    }
    catch (UsersException $cexc)
    {
    }
}

#*************************************************************
# Main part
#*************************************************************
try
{

    #Sort fields
    $sort_ar = array('1a', '1b', '2a', '2b', '3a', '3b');
    if (isset($_REQUEST['psort_']))
    {
        $_SESSION['psort'] = $_REQUEST['psort_'];

        if (isset($_SERVER['HTTP_REFERER']))
            $uri = $_SERVER['HTTP_REFERER'];
        else
            $uri = PATH_ROOT.'index.php';
        uni_redirect($uri);
    }
    if (isset($_SESSION['psort']) && in_array($_SESSION['psort'], $sort_ar))
    {
        $psort = $_SESSION['psort'];
    }
    else
    {
        $psort = $sort_ar[0];
        $_SESSION['psort'] = $psort;
    }
    $gSmarty -> assign('psort', $psort);


    #dir assign
    $gSmarty ->assign('cachedir', DIR_NAME_IMAGECACHE . '/');
    $gSmarty ->assign('cachedir2', DIR_NAME_IMAGECACHE2 . '/');
    $gSmarty ->assign('imagedir', DIR_NAME_IMAGE . '/');

   # Select page
    switch ($mod)
    {
        #********************All for Blog *************#
        case 'blog':

            $blog  =  new BText($gDb, TB.'blog', 'page.php?mod=blog&uid='.$UID);
            $blogc =  new BComment($gDb, TB.'blog_comment', 'page.php?mod=blog&uid='.$UID);

            // ==================== For People Module ==========================
            if ($is_user == 0)
            {
                $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                              'name' => $UserInfo['city_name']);

                $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                              'name' => 'People');

                $bc[] = array('link' => PATH_ROOT.'people/'.$UserInfo['nickname'].'/profile.html',
                              'name' => ucfirst($UserInfo['nickname']));

                $bc[] = array('link' => '',
                              'name' => 'Blog');
            }
            else
            {
                $bc[] = array('name' => 'Me', 'link' => PATH_ROOT);
                $bc[] = array('name' => 'My Blog ', 'link' => PATH_ROOT . 'page.php?mod='.$mod.'&uid='.$UID);
            }
            // ================================================================

            switch ($action)
            {
                #Add message
                case 'add':

                    if ($mid > 0)
                    {
                        $bc[] = array('name' => 'Edit message');
                        $inf =& $blog -> GetPageInfo($mid, $UID);
                        if (empty($inf))
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID);
                        }

                        if ($inf['uid'] <> $_SESSION['UserInfoId'])
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID);
                        }
                        else
                        {
                            $def['title'] = $inf['title'];
                            $def['descr'] = $inf['descr'];
                            $gSmarty -> assign('inf', $inf);
                            $gSmarty -> assign('mid', $mid);
                        }
                    }
                    else
                    {
                        $bc[] = array('name' => 'Add a blog entry');
                    }

                    $gSmarty -> assign('action', $action);
                    $form = new HTML_QuickForm('eform', 'post');
                    $form -> addElement('submit', 'btnSubmit', 'Submit');
                    $form -> addElement('hidden', 'action', $action);
                    $form -> addElement('hidden', 'mod', $mod);
                    $form -> addElement('hidden', 'uid', $_SESSION['UserInfoId']);
                    $form -> addElement('text', 'title');
                    $form -> addElement('textarea', 'descr');
                    $form -> addRule('title', $gSmarty -> _config[0]['vars']['psubject'].' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                    $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');

                    if ($mid > 0)
                    {
                        $form -> addElement('hidden', 'id', $mid);
                        $form -> setDefaults($def);
                    }

                    if ($form -> validate())
                    {
                        $form   -> freeze();
                        $ar = array('title' => $_REQUEST['title'],
                                    'descr' => $_REQUEST['descr'],
                                    'uid'   => $_SESSION['UserInfoId']
                                   );
                        if (isset($_REQUEST['id']) &&  $_REQUEST['id'] > 0)
                        {
                            $ar['id'] = $_REQUEST['id'];
                        }
                        $blog -> AddPage($ar);
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$_SESSION['UserInfoId']);
                    }
                    else
                    {
                        #render for smarty
                        $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                        $form -> accept($renderer);
                        $gSmarty -> assign('fdata', $form -> toArray());
                    }
                    #end comment form
                    if ($mid > 0)
                    {
                        $gSmarty -> assign('add_title', 'Edit message');
                    }
                    else
                    {
                        $gSmarty -> assign('add_title', $gSmarty -> get_config_vars('add_new_message'));
                    }
                    $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_blog-add.tpl'));
                break;


                #Search
                case 'search':

                    $bc[] = array('name' => 'Search Result');
                    if (!isset($_REQUEST['sstr']))
                    {
                        $sstr   = '';
                    }
                    else
                    {
                        $sstr   = trim($_REQUEST['sstr']);
                    }
                    $gSmarty -> assign('sstr', $sstr);

                    if ($sstr <> '')
                    {
                        if (!isset($_REQUEST['stype']))
                        {
                            $stype = 'or';
                        }
                        else
                        {
                            $stype = $_REQUEST['stype'];
                        }
                        $blog -> PrepSearch($sstr, $stype);

                        #pagging and output
                        include INC_PATH . 'includes/classes/Pagging.php';
                        $BlogCnt =& $blog -> SearchCnt();
                        $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['MesOnPage'],
                                                 $BlogCnt,
                                                 $page,
                                                 'page.php?mod=blog&action=search&sstr='.$sstr);
                        $range   =& $mpage->GetRange();
                        $mpage -> Make2(1);
                        $list =& $blog -> Search($range[0], $gSmarty -> _config[0]['vars']['MesOnPage']);
                        $gSmarty -> assign('list', $list);
                        if (count($list) <= 0)
                        {
                            $gSmarty -> assign('_text', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                        }
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_search.tpl'));
                    }
                    else
                    {
                        $gSmarty -> assign('_text', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_search.tpl'));
                    }

                break;

                #Edit commentary
                case 'edit_com':
                    #print_r($_REQUEST); die;
                    if ($mid > 0 && $id > 0)
                    {
                        $inf =& $blogc -> GetCommentInfo($id);
                        $pg  =& $blog  -> GetPageInfo($mid, $UID);
                    }
                    if ($mid > 0 && $id > 0 && (@$inf['uid'] == $_SESSION['UserInfoId'] || @$pg['uid'] == $_SESSION['UserInfoId']))
                    {
                        $uidx       = $inf['uid'];
                        if (isset($_REQUEST['uid']))
                        {
                            $inf['uid'] = $_REQUEST['uid'];
                        }

                        $gSmarty -> assign('add_title', 'Edit commentary');
                        $gSmarty -> assign('blink', 'page.php?mod='.$mod.'&uid='.$_SESSION['UserInfoId'].'&mid='.$mid);
                        #comment form
                        $form = new HTML_QuickForm('eform', 'post');
                        $form -> addElement('submit', 'btnSubmit', 'Submit');
                        $form -> addElement('hidden', 'action', $action);
                        $form -> addElement('hidden', 'mod', $mod);
                        $form -> addElement('hidden', 'id', $id);
                        #$form -> addElement('text', 'title');
                        $form -> addElement('hidden', 'title');
                        $form -> addElement('hidden', 'uidx', $inf['uid']);
                        $form -> addElement('hidden', 'uid');
                        $form -> addElement('hidden', 'mid', $mid);
                        $form -> addElement('textarea', 'descr');
                        $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                        $form -> setDefaults($inf);

                        if ($form -> validate())
                        {
                            $form   -> freeze();
                            $ar = array('title' => '',
                                        'descr' => $_REQUEST['descr'],
                                        'uid'   => $uidx,
                                        'mid'   => $mid,
                                        'id'    => $id
                                       ); #print_r($ar);die;
                            $blogc -> AddComment($ar);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID.'&mid='.$mid);
                        }
                        else
                        {
                        #render for smarty
                            $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                            $form -> accept($renderer);
                            $gSmarty -> assign('fdata', $form -> toArray());
                        }
                        #end comment form
                        $bc[] = array('name' => 'Edit commentary');
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_ed_comment.tpl'));
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$_SESSION['UserInfoId']);
                    }
                break;


                #Delete message
                case 'del':

                    if ($mid > 0 && $is_user == 1)
                    {
                        if (!isset($_REQUEST['do']) || $_REQUEST['do'] <> '1')
                        {
                            $inf =& $blog -> GetPageInfo($mid, $UID);
                            if (empty($inf))
                            {
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod);
                            }
                            #$gSmarty -> assign('inf', $inf);
                            $gSmarty -> assign('submit_link', 'page.php?mod='.$mod.'&mid='.$mid.'&action=del&do=1');
                            $gSmarty -> assign('cancel_link', 'page.php?mod='.$mod.'&mid='.$mid);
                            $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['delete_mes']);
                            $bc[] = array('name' => 'Delete message');
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/blog/_delete.tpl'));
                        }
                        else
                        {
                            $blog  -> DelPage($mid);
                            $blogc -> DelComment(0, $mid);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&action=mesg&mes=del");
                        }
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$_SESSION['UserInfoId']);
                    }

                break;

                #Delete commentary
                case 'del_com':

                    $inf =& $blogc -> GetCommentInfo($id);
                    if ($mid > 0 && $id > 0 && ($inf['uid'] == $_SESSION['UserInfoId'] || $is_user == 1))
                    {
                        if (!isset($_REQUEST['do']) || $_REQUEST['do'] <> '1')
                        {
                            $gSmarty -> assign('submit_link', 'page.php?mod='.$mod.'&uid='.$UID.'&mid='.$mid.'&id='.$id.'&action=del_com&do=1');
                            $gSmarty -> assign('cancel_link', 'page.php?mod='.$mod.'&uid='.$UID.'&mid='.$mid);
                            $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['delete_com']);
                            $bc[] = array('name' => 'Delete commentary');
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/blog/_delete.tpl'));
                        }
                        else
                        {
                            $blogc -> DelComment($id);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID."&mid=".$mid."&action=mesg&mes=del_com");
                        }
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID);
                    }
                break;

                #All mesages
                case 'mesg':
                    if (isset($_REQUEST['mes']))
                    {
                        switch ($_REQUEST['mes'])
                        {
                            case 'del':
                                $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['mes_del']);
                                $gSmarty -> assign('btext', $gSmarty -> _config[0]['vars']['tback'].' '.$gSmarty -> _config[0]['vars']['tblog']);
                                $gSmarty -> assign('back_link', 'page.php?mod='.$mod);
                            break;
                            case 'del_com':
                                $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['com_del']);
                                $gSmarty -> assign('btext', $gSmarty -> _config[0]['vars']['tback'].' '.$gSmarty -> _config[0]['vars']['tblog']);
                                $gSmarty -> assign('back_link', 'page.php?mod='.$mod.'&uid='.$UID.'&mid='.$mid);
                            break;
                            default:

                        }
                    }
                    $gSmarty -> assign('_content', $gSmarty -> fetch('mods/blog/_message.tpl'));
                break;

                default:
                    if ($mid > 0)
                    {
                        $blogc -> SetLink('page.php?mod=blog&uid='.$UID.'&mid='.$mid);
                        #message
                        $inf =& $blog -> GetPageInfo($mid, $UID);
                        if (empty($inf))
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID);
                        }
                        $gSmarty -> assign('inf', $inf);
                        $ua =  $user -> Get($inf['uid']);
                        $gSmarty -> assign('author', $ua);
                        $bc[] = array('name' => $ua['nickname'].' wrote');
                        $gSmarty -> assign('author_pic', $user -> GetUserPic($inf['uid']));
                        $gSmarty -> assign('add_title', $gSmarty -> _config[0]['vars']['add_comment']);
                        #comments
                        include INC_PATH . 'includes/classes/Pagging.php';
                        $MesCnt =& $blogc -> GetCommentCount($mid);
                        $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['ComOnPage'],
                                                 $MesCnt,
                                                 $page,
                                                 'page.php?mod=blog&uid='.$UID.'&mid='.$mid);
                        $range   =& $mpage->GetRange();
                        $mpage -> Make2();

                        $list =& $blogc -> GetCommentList($mid, 1, '', $range[0], $gSmarty -> _config[0]['vars']['ComOnPage']);
                        for ($i = 0; $i < count($list); $i++)
                        {
                            $list[$i]['user'] =& $user -> Get($list[$i]['uid']);
                            $list[$i]['user_pic'] =& $user -> GetUserPic($list[$i]['uid']);
                        }
                        $gSmarty -> assign('list', $list);

                        #comment form
                        $form = new HTML_QuickForm('eform', 'post');
                        $form -> addElement('submit', 'btnSubmit', 'Submit');
                        $form -> addElement('hidden', 'action', $action);
                        $form -> addElement('hidden', 'mod', $mod);
                        $form -> addElement('hidden', 'uid', $UID);
                        $form -> addElement('hidden', 'mid', $mid);
                        #$form -> addElement('text', 'title');
                        $form -> addElement('hidden', 'title');
                        $form -> addElement('textarea', 'descr');
                        #$form -> addRule('title', $gSmarty -> _config[0]['vars']['psubject'].' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                        $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');

                        if ($form -> validate())
                        {
                            $form   -> freeze();
                            $ar = array('title' => $_REQUEST['title'],
                                        'descr' => $_REQUEST['descr'],
                                        'uid'   => $_SESSION['UserInfoId'],
                                        'mid'   => $mid
                                       );
                            $blogc -> AddComment($ar);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID.'&mid='.$mid);
                        }
                        else
                        {
                            #render for smarty
                            $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                            $form -> accept($renderer);
                            $gSmarty -> assign('fdata', $form -> toArray());
                        }
                        #end comment form
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_blog-entry.tpl'));
                    }
                    else
                    {
                        #pagging and output
                        include INC_PATH . 'includes/classes/Pagging.php';
                        $BlogCnt =& $blog -> GetPageCount($UID);
                        $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['MesOnPage'],
                                                 $BlogCnt,
                                                 $page,
                                                 'page.php?mod=blog&uid='.$UID);
                        $range   =& $mpage->GetRange();
                        $mpage -> Make2(2);

                        $list =& $blog -> GetPageList($UID, 1, '', $range[0], $gSmarty -> _config[0]['vars']['MesOnPage']);
                        for ($i = 0; $i < count($list); $i++)
                            $list[$i]['pcnt'] =& $blogc -> GetCommentCount($list[$i]['id']);
                        $gSmarty -> assign('list', $list);

                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_blog.tpl'));
                    }
            }
        break;

        #********************All for User Photo*************#
        case 'photo':
            $photo  =  new BPhoto($gDb, TB.'photo', 'page.php?mod=photo&uid='.$UID);
            $photoc  =  new BComment($gDb, TB.'photo_comment', 'page.php?mod=photo&uid='.$UID);


            // ================= For People Module ==============================
            if ($is_user == 0)
            {
                $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                              'name' => $UserInfo['city_name']);

                $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                              'name' => 'People');

                $bc[] = array('link' => PATH_ROOT.'people/'.$UserInfo['nickname'].'/profile.html',
                              'name' => ucfirst($UserInfo['nickname']));

                $bc[] = array('link' => '',
                              'name' => 'All Photos');
            }
            else
            {
                $bc[] = array('name' => 'Me', 'link' => PATH_ROOT);
                $bc[] = array('name' => 'My Photos', 'link' => PATH_ROOT . 'page.php?mod='.$mod.'&uid='.$UID);
            }
            // ==================================================================

            switch ($action)
            {
                case 'upload':

                    $bc[] = array('name' => 'Upload photo');
                    $form = new HTML_QuickForm('eform', 'post');
                    $form -> addElement('submit', 'btnSubmit', 'Submit');
                    $form -> addElement('hidden', 'action', $action);
                    $form -> addElement('hidden', 'mod', $mod);
                    $form -> addElement('hidden', 'uid', $_SESSION['UserInfoId']);
                    $form -> addElement('text', 'title', '', 'style="width:382px;margin-top:5px;"');
                    $form -> addElement('hidden', 'path', DIR_WS_IMAGE);
                    $file =& $form -> addElement('file', 'image', '', 'style="width:270px;margin-top:5px;"');
                    if ($form -> validate() && !$file -> isUploadedFile())
                    $form -> _errors['image'] = $gSmarty -> _config[0]['vars']['image'].' '.$gSmarty -> _config[0]['vars']['isreq'];
                    #validate
                    if ($form -> validate() && $file -> isUploadedFile())
                    {
                        $form -> freeze();

                        #check originality
                        $i    = explode('.', $file -> _value['name']);
                        $ic   = $i[0];
                        $k    = 0;
                        while (file_exists(DIR_WS_IMAGE . '/' . $ic.'.'.$i[1]))
                        {
                            $ic = $i[0] . $k;
                            $k ++;
                        }
                        $file -> _value['name'] = $ic.'.'.$i[1];

                        #upload
                        $file -> moveUploadedFile($form -> _submitValues['path']);
                        $img_name = $file -> _value['name'];

                        #create thumbnail
                        include INC_PATH . 'includes/classes/Image.php';
                        $thumb    = new ThumbImage($img_name);
                        $cached   =& $thumb -> CreateThumbImage(124, 108);
                        $cached   =  $cached[0];
                        #echo $cached;die;
                        $thumb -> SetBPath();
                        $cachedb  =& $thumb -> CreateThumbImage(510, 1000);

                        $ar = array('image'  => $img_name,
                                    'cached' => $cached,
                                    'title'  => $form -> _submitValues['title'],
                                    'uid'    => $_SESSION['UserInfoId']
                               );
                        $photo -> Add($ar);
                        uni_redirect(PATH_ROOT."page.php?mod=photo&uid=".$_SESSION['UserInfoId']);
                    }
                    else
                    {
                        #render for smarty
                        $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                        $form -> accept($renderer);
                        $gSmarty -> assign('fdata', $form -> toArray());
                    }


                    $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_photo-upload.tpl'));
                break;


                #Search
                case 'search':

                    $bc[] = array('name' => 'Search result');

                    if (!isset($_REQUEST['sstr']))
                    {
                        $sstr   = '';
                    }
                    else
                    {
                        $sstr   = trim($_REQUEST['sstr']);
                    }
                    $gSmarty -> assign('sstr', $sstr);

                    if ($sstr <> '')
                    {

                        if (!isset($_REQUEST['stype']))
                        {
                            $stype = 'or';
                        }
                        else
                        {
                            $stype = $_REQUEST['stype'];
                        }
                        $photo -> PrepSearch($sstr, $stype);

                        #pagging and output
                        include INC_PATH . 'includes/classes/Pagging.php';
                        $PhotoCnt =& $photo -> SearchCnt();
                        $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['PhotoOnPage'],
                                                 $PhotoCnt,
                                                 $page,
                                                 'page.php?mod='.$mod.'&action=search&sstr='.$sstr);
                        $range   =& $mpage -> GetRange();
                        $mpage -> Make2(1);
                        $list =& $photo -> Search($range[0], $gSmarty -> _config[0]['vars']['PhotoOnPage']);
                        $gSmarty -> assign('list', $list);
                        if (count($list) <= 0)
                        {
                            $gSmarty -> assign('_text', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                        }
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_search.tpl'));
                    }
                    else
                    {
                        $gSmarty -> assign('_text', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_search.tpl'));
                    }

                break;

                #Delete photo
                case 'del':

                    if ($mid > 0 && $is_user == 1)
                    {
                        if (!isset($_REQUEST['do']) || $_REQUEST['do'] <> '1')
                        {
                            $inf =& $photo -> GetInfo($mid, $UID);
                            if (empty($inf))
                            {
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod);
                            }
                            #$gSmarty -> assign('inf', $inf);
                            $gSmarty -> assign('submit_link', 'page.php?mod='.$mod.'&mid='.$mid.'&action=del&do=1');
                            $gSmarty -> assign('cancel_link', 'page.php?mod='.$mod.'&mid='.$mid);
                            $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['delete_img']);
                            $bc[] = array('name' => 'Delete Image');
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/photo/_delete.tpl'));
                        }
                        else
                        {
                            $photo  -> Del($mid);
                            $photoc -> DelComment(0, $mid);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&action=mesg&mes=del");
                        }
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID);
                    }

                break;

                #Edit commentary
                case 'edit_com':
                    #print_r($_REQUEST); die;
                    if ($mid > 0 && $id > 0)
                    {
                        $inf =& $photoc -> GetCommentInfo($id);
                        $pg  =& $photo  -> GetInfo($mid, $UID);
                    }
                    if ($mid > 0 && $id > 0 && (@$inf['uid'] == $_SESSION['UserInfoId'] || @$pg['uid'] == $_SESSION['UserInfoId']))
                    {
                        $uidx       = $inf['uid'];
                        if (isset($_REQUEST['uid']))
                        {
                            $inf['uid'] = $_REQUEST['uid'];
                        }

                        $gSmarty -> assign('add_title', 'Edit commentary');
                        $gSmarty -> assign('blink', 'page.php?mod='.$mod.'&uid='.$_SESSION['UserInfoId'].'&mid='.$mid);
                        #comment form
                        $form = new HTML_QuickForm('eform', 'post');
                        $form -> addElement('submit', 'btnSubmit', 'Submit');
                        $form -> addElement('hidden', 'action', $action);
                        $form -> addElement('hidden', 'mod', $mod);
                        $form -> addElement('hidden', 'id', $id);
                        #$form -> addElement('text', 'title');
                        $form -> addElement('hidden', 'title');
                        $form -> addElement('hidden', 'uidx', $inf['uid']);
                        $form -> addElement('hidden', 'uid');
                        $form -> addElement('hidden', 'mid', $mid);
                        $form -> addElement('textarea', 'descr');
                        $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                        $form -> setDefaults($inf);

                        if ($form -> validate())
                        {
                            $form   -> freeze();
                            $ar = array('title' => '',
                                        'descr' => $_REQUEST['descr'],
                                        'uid'   => $uidx,
                                        'mid'   => $mid,
                                        'id'    => $id
                                       ); #print_r($ar);die;
                            $photoc -> AddComment($ar);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID.'&mid='.$mid);
                        }
                        else
                        {
                        #render for smarty
                            $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                            $form -> accept($renderer);
                            $gSmarty -> assign('fdata', $form -> toArray());
                        }
                        #end comment form
                        $bc[] = array('name' => 'Edit commentary');
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_ed_comment.tpl'));
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$_SESSION['UserInfoId']);
                    }
                break;

                #Delete commentary for photo
                case 'del_com':

                    $inf =& $photoc -> GetCommentInfo($id);
                    if ($mid > 0 && $id > 0 && ($inf['uid'] == $_SESSION['UserInfoId'] || $is_user == 1))
                    {
                        if (!isset($_REQUEST['do']) || $_REQUEST['do'] <> '1')
                        {
                            $gSmarty -> assign('submit_link', 'page.php?mod='.$mod.'&uid='.$UID.'&mid='.$mid.'&id='.$id.'&action=del_com&do=1');
                            $gSmarty -> assign('cancel_link', 'page.php?mod='.$mod.'&uid='.$UID.'&mid='.$mid);
                            $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['delete_com']);
                            $bc[] = array('name' => 'Delete commentary');
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/photo/_delete.tpl'));
                        }
                        else
                        {
                            $photoc -> DelComment($id);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID."&mid=".$mid."&action=mesg&mes=del_com");
                        }
                    }
                    else
                    {
                        uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID);
                    }
                break;

                #All messages
                case 'mesg':
                    if (isset($_REQUEST['mes']))
                    {
                        switch ($_REQUEST['mes'])
                        {
                            case 'del':
                                $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['img_del']);
                                $gSmarty -> assign('btext', $gSmarty -> _config[0]['vars']['tback'].' '.$gSmarty -> _config[0]['vars']['my_photo']);
                                $gSmarty -> assign('back_link', 'page.php?mod='.$mod);
                            break;
                             case 'del_com':
                                $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['com_del']);
                                $gSmarty -> assign('btext', $gSmarty -> _config[0]['vars']['tback'].' '.$gSmarty -> _config[0]['vars']['my_photo']);
                                $gSmarty -> assign('back_link', 'page.php?mod='.$mod.'&uid='.$UID.'&mid='.$mid);
                            break;
                            default:

                        }
                    }
                    $gSmarty -> assign('_content', $gSmarty -> fetch('mods/photo/_message.tpl'));
                break;

                default:
                    if ($mid > 0)
                    {
                        $photoc -> SetLink('page.php?mod=photo&uid='.$UID.'&mid='.$mid);
                        #message
                        $inf =& $photo -> GetInfo($mid, $UID);
                        if (empty($inf))
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod);
                        }
                        $gSmarty -> assign('inf', $inf);
                        $gSmarty -> assign('author', $user -> Get($inf['uid']));
                        $gSmarty -> assign('author_pic', $user -> GetUserPic($inf['uid']));
                        $gSmarty -> assign('add_title', $gSmarty -> _config[0]['vars']['add_comment']);
                        #comments
                        include INC_PATH . 'includes/classes/Pagging.php';
                        $MesCnt =& $photoc -> GetCommentCount($mid);
                        $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['ComOnPage'],
                                                 $MesCnt,
                                                 $page,
                                                 'page.php?mod=photo&uid='.$UID.'&mid='.$mid);
                        $range   =& $mpage->GetRange();
                        $mpage -> Make2();

                        $list =& $photoc -> GetCommentList($mid, 1, '', $range[0], $gSmarty -> _config[0]['vars']['ComOnPage']);
                        for ($i = 0; $i < count($list); $i++)
                        {
                            $list[$i]['user'] =& $user -> Get($list[$i]['uid']);
                            $list[$i]['user_pic'] =& $user -> GetUserPic($list[$i]['uid']);
                        }
                        $gSmarty -> assign('list', $list);

                        #comment form
                        $form = new HTML_QuickForm('eform', 'post');
                        $form -> addElement('submit', 'btnSubmit', 'Submit');
                        $form -> addElement('hidden', 'action', $action);
                        $form -> addElement('hidden', 'mod', $mod);
                        $form -> addElement('hidden', 'uid', $UID);
                        $form -> addElement('hidden', 'mid', $mid);
                        #$form -> addElement('text', 'title');
                        $form -> addElement('hidden', 'title');

                        $form -> addElement('textarea', 'descr');
                        #$form -> addRule('title', $gSmarty -> _config[0]['vars']['psubject'].' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                        $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');

                        if ($form -> validate())
                        {
                            $form   -> freeze();
                            $ar = array('title' => $_REQUEST['title'],
                                        'descr' => $_REQUEST['descr'],
                                        'uid'   => $_SESSION['UserInfoId'],
                                        'mid'   => $mid
                                       );
                            $photoc -> AddComment($ar);
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&uid=".$UID.'&mid='.$mid);
                        }
                        else
                        {
                            #render for smarty
                            $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                            $form -> accept($renderer);
                            $gSmarty -> assign('fdata', $form -> toArray());
                        }
                        #end comment form
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_photo-entry.tpl'));
                    }
                    else
                    {
                        #pagging and output
                        include INC_PATH . 'includes/classes/Pagging.php';
                        $PhotoCnt =& $photo -> GetCount($UID);
                        $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['PhotoOnPage'],
                                                 $PhotoCnt,
                                                 $page,
                                                 'page.php?mod=photo&uid='.$UID);
                        $range   =& $mpage->GetRange();
                        $mpage -> Make2();

                        $list =& $photo -> GetList($UID, 1, '', $range[0], $gSmarty -> _config[0]['vars']['PhotoOnPage']);
                        for ($i = 0; $i < count($list); $i++)
                            $list[$i]['pcnt'] =& $photoc -> GetCommentCount($list[$i]['id']);
                        $gSmarty -> assign('list', $list);

                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_photo.tpl'));
                    }
            }

        break;


        #********************Nightlife Food*************#
        case 'nightlife':
        case 'culture':
        case 'food':
        case 'lodging':
        case 'necessities':

            #block list
            switch ($mod)
            {
                case 'nightlife':
                    $ptypes = array(
                                    'bars'     => array('id' => 0, 'c1'  => 'Bars', 'c2' => 'bar'),
                                    'clubs'    => array('id' => 1, 'c1'  => 'Clubs/Discos', 'c2' => 'club/disco')
                                   );
                break;
                case 'culture':
                    $ptypes = array(
                                    'museums'  => array('id' => 0, 'c1'  => 'Museums', 'c2' => 'museum'),
                                    'parks'    => array('id' => 1, 'c1'  => 'Parks', 'c2' => 'park'),
                                    'fests'    => array('id' => 2, 'c1'  => 'Festivals', 'c2' => 'festival'),
                                    'trips'    => array('id' => 3, 'c1'  => 'Day Trips', 'c2' => 'day trip'),
                                    'live'     => array('id' => 4, 'c1'  => 'Live Performances', 'c2' => 'live performance'),
                                    'churches' => array('id' => 5, 'c1'  => 'Churches', 'c2' => 'church'),
                                    'interest' => array('id' => 6, 'c1'  => 'Places of Interest', 'c2' => 'place of interest'),
                                    'shops'    => array('id' => 7, 'c1'  => 'Shops', 'c2' => 'shop')
                                   );
                break;
                case 'food':
                    $ptypes = array(
                                    'quick'   => array('id' => 0, 'c1'  => 'Quick Eats', 'c2' => 'quick eat place'),
                                    'sitdown' => array('id' => 1, 'c1'  => 'Sit Down Places', 'c2' => 'sit down place'),
                                    'coffe'   => array('id' => 2, 'c1'  => 'Coffee Shops', 'c2' => 'coffee shop'),
                                    'pubs'    => array('id' => 3, 'c1'  => 'Pubs', 'c2' => 'pub')
                                   );
                break;
                case 'lodging':
                    $ptypes = array(
                                    'hostels'    => array('id' => 0, 'c1'  => 'Hostels', 'c2' => 'hostel'),
                                    'hotels'     => array('id' => 1, 'c1'  => 'Hotels', 'c2' => 'hotel'),
                                    'apartments' => array('id' => 2, 'c1'  => 'Apartments', 'c2' => 'apartment'),
                                    'campings'   => array('id' => 3, 'c1'  => 'Campings', 'c2' => 'camping')
                                   );
                break;
                case 'necessities':
                    $ptypes = array(
                                    'money'   => array('id' => 0, 'c1'  => 'Money', 'c2' => 'money'),
                                    'health'  => array('id' => 1, 'c1'  => 'Health and Safety', 'c2' => 'health and safety'),
                                    'around'  => array('id' => 2, 'c1'  => 'Getting Around', 'c2' => 'getting around'),
                                    'lingo'   => array('id' => 3, 'c1'  => 'Local Lingo', 'c2' => 'local lingo'),
                                    'random'  => array('id' => 4, 'c1'  => 'Random', 'c2' => 'random'),
                                   );
                break;
            }

            $bx    = $mod;
            $bx[0] = strtoupper($bx[0]);
            $bc[]  = array('name' => $bx, 'link' => PATH_ROOT . 'page.php?mod='.$mod.'&uid='.$UID);

            $bl_def = 'all';

            if (isset($_REQUEST['block']) && $_REQUEST['block'] <> '')
            {
                if (isset($ptypes[$_REQUEST['block']]))
                {
                    $block  = $_REQUEST['block'];
                    $bl_inf = $ptypes[$_REQUEST['block']];
                    $gSmarty -> assign('block', $block);
                    $gSmarty -> assign('bl_inf', $bl_inf);
                }
                else
                {
                    $block  = $bl_def;
                }
            }
            else
            {
                $block  = $bl_def;
            }


            if ($block <> $bl_def)
            {
                $bc[] = array('name' => $ptypes[$block]['c1'], 'link' => PATH_ROOT.'page.php?mod='.$mod.'&block='.$block);


                $nl  =  new BInfo($gDb, TB.$mod, 'page.php?mod='.$mod.'&block='.$block, TB.$mod.'_adi');
                $nlc =  new BComment($gDb, TB.$mod.'_comment', 'page.php?mod='.$mod.'&block='.$block);
                $nl -> SetPageBlock($bl_inf['id']);

                $opt = new BOpt($gDb, TB . 'optcat', TB . 'optel', $block);
                $adi =& $opt -> GetBlock();

                /*
                $adi = array(
                             array('id' => 0, 'name' => 'Price', 'ctype' => 'select', 'vals' => '',
                                   'vals' => array('x1' => 'x1', 'x2' => 'x2', 'x3' => 'x3')),

                             array('id' => 1, 'name' => 'Music', 'ctype' => 'select',
                                   'vals' => array('x1' => 'x1', 'x2' => 'x2', 'x3' => 'x3')),

                             array('id' => 2, 'name' => 'Scene', 'ctype' => 'select',
                                   'vals' => array('x1' => 'x1', 'x2' => 'x2', 'x3' => 'x3'))
                            );
                */

                $nl -> SetAdi($adi);

                switch ($action)
                {
                    case 'add':
                        if ($mid > 0 && !$uadmin)
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block);
                        }
                        elseif ($mid > 0 && $uadmin)
                        {
                            $inf =& $nl -> GetPageInfo($mid, $_SESSION['UserInfoCurrentCity']);
                            $def['title'] = $inf['title'];
                            $def['descr'] = $inf['descr'];
                            $gSmarty -> assign('inf', $inf);
                            $gSmarty -> assign('mid', $mid);
                            $bc[] = array('name' => 'Edit post', 'link' => PATH_ROOT);

                            if (isset($_REQUEST['delimg']) && $_REQUEST['delimg'] == 1)
                            {
                                $nl -> DelImage($mid);
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block.'&action=add&mid='.$mid);
                            }
                        }
                        else
                        {
                            $bc[] = array('name' => 'Add post', 'link' => PATH_ROOT);
                        }
                        $form = new HTML_QuickForm('eform', 'post');
                        $form -> addElement('submit', 'btnSubmit', 'Submit');
                        $form -> addElement('hidden', 'action', $action);
                        $form -> addElement('hidden', 'block', $block);
                        $form -> addElement('hidden', 'mod', $mod);
                        $form -> addElement('hidden', 'uid', $_SESSION['UserInfoId']);
                        $form -> addElement('hidden', 'cityid', $_SESSION['UserInfoCurrentCity']);
                        $form -> addElement('text', 'title');
                        $form -> addElement('text', 'descr');

                        if ($mid == 0)
                        {
                            $form -> addElement('textarea', 'comment', '', 'class="big"');
                        }
                        $form -> addElement('hidden', 'path', DIR_WS_IMAGE);
                        $file =& $form -> addElement('file', 'image', '', 'style="width:270px;margin-top:5px;"');
                        #print_r($inf['adi']);print_r($adi);
                        for ($i = 0; $i < count($adi); $i++)
                        {
                            $form -> addElement($adi[$i]['ctype'], 'fld'.$adi[$i]['id'], $adi[$i]['name'], $adi[$i]['vals']);
                            if ($mid > 0 && $uadmin)
                            {
                                for ($j = 0; $j < count($inf['adi']); $j++)
                                {
                                    if ($inf['adi'][$j]['id'] == $adi[$i]['id'])
                                    {
                                        $def['fld'.$adi[$i]['id']] = $inf['adi'][$j]['val'];
                                        break;
                                    }
                                }
                            }
                        }
                        $form -> addRule('title', 'Name '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                        $form -> addRule('descr', 'Address '. $gSmarty -> _config[0]['vars']['isreq'], 'required');

                        if ($mid == 0)
                        {
                            $form -> addRule('comment', 'Description '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                        }
                        if ($mid > 0 && $uadmin)
                        {
                            if ($inf['image'] <> '')
                            {
                                $form -> addElement('static','imgdel', '', '<a href="'.PATH_ROOT.DIR_NAME_IMAGE.'/'
                                .$inf['image'].'" target="_blank">'.$inf['image'].'</a> [<a href="page.php?mod='.$mod.'&block='.$block.'&mid='.$mid.'&action=add&delimg=1"  onClick="return confirmLink(this, ' . "'" . $gSmarty -> _config[0]['vars']['delimage'] . "?'" . ');">'.$gSmarty -> _config[0]['vars']['delete'].'</a>]');
                            }
                            $form -> addElement('hidden', 'id', $inf['id']);
                            $form -> addElement('hidden', 'mid', $inf['id']);
                            $form -> setDefaults($def);
                        }

                        if ($form -> validate())
                        {
                            $form   -> freeze();

                            if ($file -> isUploadedFile())
                            {
                                #check originality
                                $i    = explode('.', $file -> _value['name']);
                                $ic   = $i[0];
                                $k    = 0;
                                while (file_exists(DIR_WS_IMAGE . '/' . $ic.'.'.$i[1]))
                                {
                                    $ic = $i[0] . $k;
                                    $k ++;
                                }
                                $file -> _value['name'] = $ic.'.'.$i[1];

                                #upload
                                $file -> moveUploadedFile($form -> _submitValues['path']);
                                $img_name = $file -> _value['name'];

                                #create thumbnail
                                include INC_PATH . 'includes/classes/Image.php';
                                $thumb    = new ThumbImage($img_name);
                                $cached   =& $thumb -> CreateThumbImage(124, 108);
                                $cached   =  $cached[0];
                            }
                            else
                            {
                                $img_name = '';
                                $cached     = 0;
                            }
                            #end upload

                            $mid = $nl -> AddPage($_REQUEST, $img_name, $cached);
                            if (!isset($_REQUEST['id']) || $_REQUEST['id'] == 0)
                            {
                                $ar = array('title' => '',
                                            'descr' => $_REQUEST['comment'],
                                            'uid'   => $_SESSION['UserInfoId'],
                                            'mid'   => $mid,
                                            'rate'  => $_REQUEST['rate']
                                           );
                                $nlc -> AddComment($ar);
                            }
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod.'&block='.$block);
                        }
                        else
                        {
                            #render for smarty
                            $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                            $form -> accept($renderer);

                            $fd = $form -> toArray();
                            for ($i = 0; $i < count($fd['elements']); $i++)
                                $fd['el'][$fd['elements'][$i]['name']] = $fd['elements'][$i];
                            $gSmarty -> assign('fdata', $fd);
                        }
                        #end comment form
                        $gSmarty -> assign('add_title', $gSmarty -> get_config_vars('add_new_message'));
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_'.$mod.'-add.tpl'));

                    break;


                    #Edit commentary
                    case 'edit_com':

                        $inf =& $nlc -> GetCommentInfo($id);
                        if ($mid > 0 && $id > 0 && ($inf['uid'] == $_SESSION['UserInfoId'] || $uadmin))
                        {
                            $gSmarty -> assign('add_title', 'Edit commentary');
                            $gSmarty -> assign('blink', 'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid);
                            #comment form
                            $form = new HTML_QuickForm('eform', 'post');
                            $form -> addElement('submit', 'btnSubmit', 'Submit');
                            $form -> addElement('hidden', 'action', $action);
                            $form -> addElement('hidden', 'mod', $mod);
                            $form -> addElement('hidden', 'block', $block);
                            $form -> addElement('hidden', 'id', $id);
                            $form -> addElement('hidden', 'uid', $inf['uid']);
                            $form -> addElement('hidden', 'mid', $mid);
                            $form -> addElement('textarea', 'descr');
                            $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');
                            $form -> setDefaults($inf);
                            if ($form -> validate())
                            {
                                $form   -> freeze();
                                $ar = array('title' => '',
                                            'descr' => $_REQUEST['descr'],
                                            'uid'   => $_REQUEST['uid'],
                                            'mid'   => $mid,
                                            'id'    => $id
                                           );
                                $nlc -> AddComment($ar);
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block.'&mid='.$mid);
                            }
                            else
                            {
                                #render for smarty
                                $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                                $form -> accept($renderer);
                                $gSmarty -> assign('fdata', $form -> toArray());
                            }
                            #end comment form
                            $bc[] = array('name' => 'Edit commentary', 'link' => PATH_ROOT);
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_ed_comment.tpl'));
                        }
                        else
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block);
                        }
                    break;

                    #Delete commentary
                    case 'del_com':

                        $inf =& $nlc -> GetCommentInfo($id);
                        if ($mid > 0 && $id > 0 && ($inf['uid'] == $_SESSION['UserInfoId'] || $uadmin))
                        {
                            if (!isset($_REQUEST['do']) || $_REQUEST['do'] <> '1')
                            {
                                $gSmarty -> assign('submit_link', 'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid.'&id='.$id.'&action=del_com&do=1');
                                $gSmarty -> assign('cancel_link', 'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid);
                                $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['delete_com']);
                                $bc[] = array('name' => 'Delete commentary', 'link' => PATH_ROOT);
                                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_delete.tpl'));
                            }
                            else
                            {
                                $nlc -> DelComment($id);
                                $nl  -> UpdRate($mid, $inf['rate'], 1);
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block."&mid=".$mid."&action=mesg&mes=del_com");
                            }
                        }
                        else
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block);
                        }
                    break;

                    #All mesages
                    case 'mesg':
                        if (isset($_REQUEST['mes']))
                        {
                            switch ($_REQUEST['mes'])
                            {
                                case 'del':
                                    $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['mes_del']);
                                    $gSmarty -> assign('btext', $gSmarty -> _config[0]['vars']['tback'].' '.$gSmarty -> _config[0]['vars']['t'.$mod]);
                                    $gSmarty -> assign('back_link', 'page.php?mod='.$mod);
                                break;
                                case 'del_com':
                                    $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['com_del']);
                                    $gSmarty -> assign('btext', $gSmarty -> _config[0]['vars']['tback'].' '.$ptypes[$block]['c1']);
                                    $gSmarty -> assign('back_link', 'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid);
                                break;
                                default:

                           }
                        }
                        $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_message.tpl'));
                    break;

                    #Delete (only for admin)
                    case 'del':

                        if ($mid > 0 && $uadmin)
                        {
                            if (!isset($_REQUEST['do']) || $_REQUEST['do'] <> '1')
                            {
                                $gSmarty -> assign('submit_link', 'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid.'&action=del&do=1');
                                $gSmarty -> assign('cancel_link', 'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid);
                                $gSmarty -> assign('dtext', $gSmarty -> _config[0]['vars']['delete_mes']);
                                $bc[] = array('name' => 'Delete post', 'link' => PATH_ROOT);
                                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_delete.tpl'));
                            }
                            else
                            {
                                $nl  -> DelPage($mid);
                                $nlc -> DelComment(0, $mid);
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block."&action=mesg&mes=del");
                            }
                        }
                        else
                        {
                            uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block);
                        }
                    break;


                    default:
                        if ($mid == 0 || !is_numeric($mid))
                        {
                            #Order links
                            $st = 'page.php?mod='.$mod.'&block='.$block.'&psort_=';
                            $gSmarty -> assign('lsort',
                                      array(
                                        ($psort == '1a') ? $st . '1b' : $st . '1a',
                                        ($psort == '2a') ? $st . '2b' : $st . '2a',
                                        ($psort == '3a') ? $st . '3b' : $st . '3a'
                                       ));

                            #pagging and output
                            include INC_PATH . 'includes/classes/Pagging.php';
                            $textCnt =& $nl -> GetPageCount($_SESSION['UserInfoCurrentCity']);
                            $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['NLOnPage'],
                                                     $textCnt,
                                                     $page,
                                                     'page.php?mod='.$mod.'&block='.$block);
                            $range   =& $mpage -> GetRange();
                            $mpage -> Make2(1);
                            $list =& $nl -> GetPageList($_SESSION['UserInfoCurrentCity'], 1, '', $range[0], $gSmarty -> _config[0]['vars']['NLOnPage'], $psort);
                            for ($i = 0; $i < count($list); $i++)
                                 $list[$i]['pcnt'] =& $nlc -> GetCommentCount($list[$i]['id']);
                            $gSmarty -> assign('list', $list);
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_'.$mod.'.tpl'));
                        }
                        else
                        {
                            $nlc -> SetLink('page.php?mod='.$mod.'&block='.$block.'&mid='.$mid);
                            #message
                            $inf =& $nl -> GetPageInfo($mid, $_SESSION['UserInfoCurrentCity']);

                            if (empty($inf))
                            {
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block);
                            }

                            $gSmarty -> assign('inf', $inf);
                            $gSmarty -> assign('author', $user -> Get($inf['uid']));#print_r($user -> Get($inf['uid']));
                            $gSmarty -> assign('author_pic', $user -> GetUserPic($inf['uid']));
                            $gSmarty -> assign('add_title', @$gSmarty -> _config[0]['vars']['new_review']);
                            #comments
                            include INC_PATH . 'includes/classes/Pagging.php';
                            $MesCnt =& $nlc -> GetCommentCount($mid);
                            $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['ComOnPage'],
                                                     $MesCnt,
                                                     $page,
                                                     'page.php?mod='.$mod.'&block='.$block.'&mid='.$mid);
                            $range   =& $mpage->GetRange();
                            $mpage -> Make2();

                            $list =& $nlc -> GetCommentList($mid, 1, '', $range[0], $gSmarty -> _config[0]['vars']['ComOnPage']);
                            for ($i = 0; $i < count($list); $i++)
                            {
                                $list[$i]['user']     =& $user -> Get($list[$i]['uid']);
                                $list[$i]['user_pic'] =& $user -> GetUserPic($list[$i]['uid']);
                            }
                            #print_r($list);
                            $gSmarty -> assign('list', $list);

                            #comment form
                            $form = new HTML_QuickForm('eform', 'post');
                            $form -> addElement('submit', 'btnSubmit', 'Submit');
                            $form -> addElement('hidden', 'action', $action);
                            $form -> addElement('hidden', 'mod', $mod);
                            $form -> addElement('hidden', 'block', $block);
                            $form -> addElement('hidden', 'uid', $UID);
                            $form -> addElement('hidden', 'mid', $mid);
                            $form -> addElement('textarea', 'descr');
                            $form -> addRule('descr',  $gSmarty -> _config[0]['vars']['pmessage'] .' '. $gSmarty -> _config[0]['vars']['isreq'], 'required');

                            if ($form -> validate())
                            {
                                $form   -> freeze();
                                $ar = array('title' => '',
                                            'descr' => $_REQUEST['descr'],
                                            'uid'   => $_SESSION['UserInfoId'],
                                            'mid'   => $mid,
                                            'rate'  => $_REQUEST['rate']
                                           );
                                $nlc -> AddComment($ar);
                                $nl  -> UpdRate($mid, $_REQUEST['rate']);
                                uni_redirect(PATH_ROOT."page.php?mod=".$mod."&block=".$block.'&mid='.$mid);
                            }
                            else
                            {
                                #render for smarty
                                $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                                $form -> accept($renderer);
                                $gSmarty -> assign('fdata', $form -> toArray());
                            }
                            #end comment form

                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_'.$mod.'-review.tpl'));
                        }
                }
            }
            else#Overview
            {

                $nl  = new BInfo($gDb, TB.$mod, 'page.php?mod='.$mod, TB.$mod.'_adi');
                $nlc = new BComment($gDb, TB.$mod.'_comment', 'page.php?mod='.$mod);

                #Search
                if ($action == 'search')
                {

                        if (!isset($_REQUEST['sstr']))
                        {
                            $sstr   = '';
                        }
                        else
                        {
                            $sstr   = trim($_REQUEST['sstr']);
                        }
                        $gSmarty -> assign('sstr', $sstr);

                        if ($sstr <> '')
                        {
                            if (!isset($_REQUEST['stype']))
                            {
                                $stype = 'or';
                            }
                            else
                            {
                                $stype = $_REQUEST['stype'];
                            }
                            $nl -> PrepSearch($sstr, $stype);

                            #pagging and output
                            include INC_PATH . 'includes/classes/Pagging.php';
                            $NLCnt =& $nl -> SearchCnt();
                            $mpage   =   new Pagging($gSmarty -> _config[0]['vars']['NLOnPage'],
                                                     $NLCnt,
                                                     $page,
                                                     'page.php?mod='.$mod.'&block='.$block.'&action=search&sstr='.$sstr);
                            $range   =& $mpage -> GetRange();
                            $mpage -> Make2(1);
                            $list =& $nl -> Search($range[0], $gSmarty -> _config[0]['vars']['NLOnPage']);
                            $gSmarty -> assign('list', $list);
                            if (count($list) <= 0)
                            {
                                $gSmarty -> assign('_text', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                            }
                            $bc[] = array('name' => 'Search result', 'link' => PATH_ROOT);
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_searchres.tpl'));
                        }
                        else
                        {
                            $gSmarty -> assign('_text', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                            #echo $mod;
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.$mod.'/_searchres.tpl'));
                        }

                }
                else
                {
                    $res = array();
                    $k   = 0;
                    while (list($key, $val) = each($ptypes))
                    {
                        $nl  -> SetPageBlock($val['id']);
                        $nl  -> SetLink('page.php?mod='.$mod.'&block='.$key);
                        $nlc -> SetLink('page.php?mod='.$mod.'&block='.$key);

                        $list =& $nl -> GetPageList($_SESSION['UserInfoCurrentCity'], 1, '', 0, @$gSmarty -> _config[0]['vars']['NLOverview']);
                        for ($i = 0; $i < count($list); $i++)
                            $list[$i]['pcnt'] =& $nlc -> GetCommentCount($list[$i]['id']);

                        $res[$k]['title'] =  $val['c2'];
                        $res[$k]['cnt']   =& $nl -> GetPageCount($_SESSION['UserInfoCurrentCity']);
                        $res[$k]['link']  =  'page.php?mod='.$mod.'&block='.$key;
                        $res[$k]['pd']    =  $list;
                        $k ++;
                    }
                    $gSmarty -> assign('list', $res);
                    $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_'.$mod.'_overview.tpl'));
                }
            }
        break;

        #Advanced search
        case 'search':
            $bc[] = array('name' => 'Search');
            if (isset($_REQUEST['sstr']) && trim($_REQUEST['sstr']) <> '')
            {
                switch (@$_REQUEST['where'])
                {
                    case 'all':

                        if (!isset($_REQUEST['sstr']))
                        {
                            $sstr   = '';
                        }
                        else
                        {
                            $sstr   = trim($_REQUEST['sstr']);
                        }
                        $gSmarty -> assign('sstr', $sstr);

                        if (!isset($_REQUEST['stype']))
                        {
                            $stype = 'or';
                        }
                        else
                        {
                            $stype = $_REQUEST['stype'];
                        }
                        $gSmarty -> assign('stype', $stype);

                        $list = array();

                        if ($sstr <> '')
                        {
                            #Text blocks
                            $bla = array('nightlife', 'culture', 'food', 'lodging', 'necessities');
                            for ($i = 0; $i < count($bla); $i++)
                            {
                                switch ($bla[$i])
                                {
                                    case 'nightlife':
                                        $ptypes = array(
                                                       'bars'     => array('id' => 0, 'c1'  => 'Bars', 'c2' => 'bar'),
                                                       'clubs'    => array('id' => 1, 'c1'  => 'Clubs/Discos', 'c2' => 'club/disco')
                                                        );
                                    break;
                                    case 'culture':
                                        $ptypes = array(
                                                       'museums'  => array('id' => 0, 'c1'  => 'Museums', 'c2' => 'museum'),
                                                       'parks'    => array('id' => 1, 'c1'  => 'Parks', 'c2' => 'park'),
                                                       'fests'    => array('id' => 2, 'c1'  => 'Festivals', 'c2' => 'festival'),
                                                       'trips'    => array('id' => 3, 'c1'  => 'Day Trips', 'c2' => 'day trip'),
                                                       'live'     => array('id' => 4, 'c1'  => 'Live Performances', 'c2' => 'live performance'),
                                                       'churches' => array('id' => 5, 'c1'  => 'Churches', 'c2' => 'church'),
                                                       'interest' => array('id' => 6, 'c1'  => 'Places of Interest', 'c2' => 'place of interest'),
                                                       'shops'    => array('id' => 7, 'c1'  => 'Shops', 'c2' => 'shop')
                                                       );
                                    break;
                                    case 'food':
                                        $ptypes = array(
                                                       'quick'   => array('id' => 0, 'c1'  => 'Quick Eats', 'c2' => 'quick eat place'),
                                                       'sitdown' => array('id' => 1, 'c1'  => 'Sit Down Places', 'c2' => 'sit down place'),
                                                       'coffe'   => array('id' => 2, 'c1'  => 'Coffee Shops', 'c2' => 'coffee shop'),
                                                       'pubs'    => array('id' => 3, 'c1'  => 'Pubs', 'c2' => 'pub')
                                                       );
                                    break;
                                    case 'lodging':
                                        $ptypes = array(
                                                       'hostels'    => array('id' => 0, 'c1'  => 'Hostels', 'c2' => 'hostel'),
                                                       'hotels'     => array('id' => 1, 'c1'  => 'Hotels', 'c2' => 'hotel'),
                                                       'apartments' => array('id' => 2, 'c1'  => 'Apartments', 'c2' => 'apartment'),
                                                       'campings'   => array('id' => 3, 'c1'  => 'Campings', 'c2' => 'camping')
                                                       );
                                    break;
                                    case 'necessities':
                                        $ptypes = array(
                                                       'money'   => array('id' => 0, 'c1'  => 'Money', 'c2' => 'money'),
                                                       'health'  => array('id' => 1, 'c1'  => 'Health and Safety', 'c2' => 'health and safety'),
                                                       'around'  => array('id' => 2, 'c1'  => 'Getting Around', 'c2' => 'getting around'),
                                                       'lingo'   => array('id' => 3, 'c1'  => 'Local Lingo', 'c2' => 'local lingo'),
                                                       'random'  => array('id' => 4, 'c1'  => 'Random', 'c2' => 'random'),
                                                       );
                                    break;
                                }
                                $nl  = new BInfo($gDb, TB.$bla[$i], 'page.php?mod='.$bla[$i], TB.$bla[$i].'_adi');
                                $nl -> PrepSearch($sstr, $stype);
                                $list[$bla[$i]] =& $nl -> Search(0, 5);
                            }

                            #People

                            $srh = $sstr;
                            $srh = StrToLower(preg_replace('/[^ @\.,a-z_0123456789-]/i', '', $srh));
                            $user -> SetResOnPage(4);
                            $users =& $user -> Search($srh,  0, 'nickname', 'asc', 0, 1);
                            $gSmarty -> assign('users', $users[0]);

                            #assign all
                            #print_r($list['nightlife']);
                            $gSmarty -> assign('list', $list);
                            $gSmarty -> assign('_nftext', '<br />&nbsp;'.$gSmarty -> _config[0]['vars']['errnfound'].'<br /><br />');
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_search_res.tpl'));
                        }
                        else
                        {
                            #Nothing found
                            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_search.tpl'));
                        }
                    break;
                    // ============= People Search ======================
                    case 'people':
                        $uri = PATH_ROOT."people/search/?do=1&srh=" . $_REQUEST['sstr'] . "&stype=".$_REQUEST['stype'];
                        uni_redirect($uri);
                    break;
                    // ===================================================

                    case 'nightlife':
                    case 'culture':
                    case 'food':
                    case 'lodging':
                    case 'necessities':
                        $uri = PATH_ROOT."page.php?mod=" . $_REQUEST['where'] . "&action=search&sstr=" . $_REQUEST['sstr'] . "&stype=".$_REQUEST['stype'];
                        uni_redirect($uri);
                    break;
                }


            }
            else
            {
                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_search.tpl'));
            }

        break;

    }
    $gSmarty -> assign('bc', $bc);
    $gSmarty -> display('index.tpl');
}
catch (Exception $exc)
{
    sc_error($exc);
}

#*************************************************************
# End part
#*************************************************************
    $gDb -> disconnect();
?>