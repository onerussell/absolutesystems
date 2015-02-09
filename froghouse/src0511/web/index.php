<?php
    include 'top.php';

    if (MAIN_PAGE_GZ)
    {
        header('Content-Encoding: gzip');

        function callback2($buffer) 
        {
            return gzencode($buffer, 9);
        }

        ob_start('callback2');
        ob_implicit_flush(0);
    }
#*************************************************************
# Main part
#*************************************************************
try
{
    $bc = array();
    #dir assign
    $gSmarty ->assign('cachedir', DIR_NAME_IMAGECACHE . '/');
    $gSmarty ->assign('imagedir', DIR_NAME_IMAGE . '/');

    #menu

    # Select page
    switch ($mod)
    {
        #Static Pages
        case 'page':

            if (isset($_REQUEST['pn']))
            {
                $pn = $_REQUEST['pn'];
            }
            else
            {
                $pn = '';
            }
            if ($id > 0 || $pn <> '')
            {

                require INC_PATH.'includes/classes/Spages.php';
                $spage = new Spages($gDb, TB.'spagescat', TB.'spages', 'index.php?mod=page');
                $pinf  = $spage -> GetPageInfo($id, $pn);
                if (isset($pinf['cid']))
                {
                    $ctg      = $pinf['cid'];
                    $id       = $pinf['id'];
                    $gSmarty -> assign('pinf', $pinf);
                }
            }
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_pages.tpl'));
        break;

        #Invite
        case 'invite':
            if (!$gAuthUser)
                uni_redirect(PATH_ROOT);

            $gSmarty -> config_load('invite.conf');

            function a_redirect($code = 0)
            {
                global $action, $pvstart, $order;
                $code = intval($code);
                if (0 < $code)
                    uni_redirect(PATH_ROOT.'?mod=invite&code='.$code);
                elseif (0 == $code)
                    uni_redirect(PATH_ROOT.'?mod=invite&code=0');
                else
                    uni_redirect(PATH_ROOT.'?mod=invite');
            }

            $bc[] = array('link' => PATH_ROOT.'?mod=invite',
                          'name' => 'Invite');

            $do    = (isset($_REQUEST['do']))   ? $_REQUEST['do']   : 0;

            if (1 == $do)
            {
                try
                {
                    $mess  = @$_POST['mess'];
                    $gSmarty -> assign('mess', $mess);
                    $user -> InviteFriend($UserInfoId, $mess, @$_SESSION['turing_number']);
                    a_redirect(0);
                }
                catch (UsersException $cexc)
                {
                    $gSmarty -> assign('UserLastErr'  , $gSmarty -> get_config_vars('InviteMess_'.$cexc->getCode()));
                }
            }
            elseif (isset($_REQUEST['code']))
                $gSmarty -> assign('UserLastMess'  , $gSmarty -> get_config_vars('InviteMess_0'));

            $gSmarty -> assign('rand_number', mt_rand(111111,999999));
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_invite.tpl'));
            break;

        case 'friends':

            if (!$gAuthUser)
                uni_redirect(PATH_ROOT);

            $gSmarty -> config_load('friends.conf');

            function a_redirect($code = 0)
            {
                global $action, $pvstart, $order;
                $code = intval($code);
                if ($code > 0)
                    uni_redirect(PATH_ROOT.'mod=friends&pvstart='.$pvstart.'&order='.$order.'&code='.$code);
                else
                    uni_redirect(PATH_ROOT.'mod=friends&action='.$action.'&pvstart='.$pvstart.'&order='.$order);
            }

            $action     = (isset($_REQUEST['action']))     ? $_REQUEST['action']          : 'overview';

            $result     = (isset($_REQUEST['result']))     ? $_REQUEST['result']          : '';

            $add_action = (isset($_REQUEST['add_action'])) ? $_REQUEST['add_action']      : '';
            $what       = (isset($_REQUEST['what']))       ? $_REQUEST['what']            : '';
            $code       = (isset($_REQUEST['code']))       ? $_REQUEST['code']            : 0;  // - error code -
            $id         = (isset($_REQUEST['id']))         ? $_REQUEST['id']              : 0;  // - item id -

            $gSmarty -> assign('action', $action);

            $gSmarty -> assign('result', $result);

            $gSmarty -> assign('add_action', $add_action);
            $gSmarty -> assign('what'  , $what);
            $gSmarty -> assign('code'  , $gSmarty -> get_config_vars('FriendsErr_'.$code));

            $bc[] = array('link' => PATH_ROOT,
                          'name' => 'Me');

            $bc[] = array('link' => '',
                          'name' => 'My Friends');

            switch ($action)
            {
                case 'mess':
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    $gSmarty -> assign('Message', $gSmarty -> get_config_vars('PeopleMess_'.$code));
                    break;

                case 'overview':// overview
                default:
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    if (0 < $code)
                        $gSmarty -> assign('ErrMessage', $gSmarty -> get_config_vars('UserErr_'.$code));

                    $pvstart    = (isset($_REQUEST['pvstart']))    ? intval($_REQUEST['pvstart']) : 0;                 // - page displaciment -
                    $order      = (isset($_REQUEST['order']))      ? $_REQUEST['order']           : 'recently_added';  // - ordering -
                    $gSmarty -> assign('pvstart' , $pvstart);

                    $orderdesc = '';
                    if ('recently_added' != $order)
                    {
                        $order     = 'nickname';
                        $orderdesc = 'asc';
                        $gSmarty -> assign('order', 'all');
                    }
                    else
                    {
                        $order     = 'reg_date';
                        $orderdesc = 'desc';
                        $gSmarty -> assign('order', 'recently_added');
                    }

                    $users =& $user -> GetFriends($UserInfoId, $pvstart, $order, 'asc');

                    // Generate data for paginal viewing
                    if ($user -> ResOnPage() > 0 && $pvstart >= -1)
                    {
                        $pages = ceil($users[1] / $user -> FriendsOnPage());
                        $gSmarty -> assign_by_ref('pages', $pages);
                        $pgArr = array();
                        for ($i = 0; $i < $pages; $i++)
                        {
                            $pgArr[] = $i * $user -> FriendsOnPage();
                        }
                        $gSmarty -> assign_by_ref('pgArr', $pgArr);
                        $gSmarty -> assign('curPage'     , floor($pvstart / $user -> FriendsOnPage()));
                        $gSmarty -> assign('ResOnPage'   , $user -> FriendsOnPage());
                    }
                    else
                       $gSmarty -> assign('pages',1);

                    $gSmarty -> assign('users', $users[0]);
                    $gSmarty -> assign('users_cnt', $users[1]);
                    break;
            }

            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/me/_friends.tpl'));
            break;

        case 'view_other_cities':
            if (!$gAuthUser)
                uni_redirect(PATH_ROOT);

            $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities',
                          'name' => 'View Other Cities');

            $iso2_cntr  = (isset($_REQUEST['iso2_cntr'])) ? $_REQUEST['iso2_cntr']       : '';    // - country iso2 code

            if (0 < $city_id)
            {
                if ('' == $iso2_cntr)
                {
                   $arr = $geo->GetCityName($UserInfoCurrentCity);
                   $iso2_cntr = @$arr['iso2'];
                }
            }

            $gSmarty -> assign('iso2_cntr' , $iso2_cntr);

            if ('' != $iso2_cntr)
            {
                $countryName = $geo -> GetCountryName($iso2_cntr, -1, 1);
                $bc[] = array('link' => '',
                              'name' => $countryName);
                $cities =& $user -> GetCities($iso2_cntr);

                $gSmarty -> assign_by_ref('cities', $cities);
                $gSmarty -> assign('countryName', $countryName);
            }
            else
            {
               $countries =& $user -> GetCountries(-1, 1);
               $gSmarty -> assign_by_ref('countries', $countries);
            }
            if (isset($_GET['city_id']))
            {
                uni_redirect(PATH_ROOT.'people/');
            }
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_view_other_cities.tpl'));

            break;

        case 'people':

            if (!$gAuthUser)
                uni_redirect(PATH_ROOT);

            $gSmarty -> config_load('people.conf');

            function a_redirect($code = 0)
            {
                global $action, $pvstart, $order;
                $code = intval($code);
                if ($code > 0)
                    uni_redirect(PATH_ROOT.'people/?pvstart='.$pvstart.'&order='.$order.'&code='.$code);
                else
                    uni_redirect(PATH_ROOT.'people/?action='.$action.'&pvstart='.$pvstart.'&order='.$order);
            }

            $action     = (isset($_REQUEST['action']))     ? $_REQUEST['action']          : '';

            $result     = (isset($_REQUEST['result']))     ? $_REQUEST['result']          : '';

            $add_action = (isset($_REQUEST['add_action'])) ? $_REQUEST['add_action']      : '';
            $what       = (isset($_REQUEST['what']))       ? $_REQUEST['what']            : '';
            $code       = (isset($_REQUEST['code']))       ? $_REQUEST['code']            : 0;  // - error code -
            $id         = (isset($_REQUEST['id']))         ? $_REQUEST['id']              : 0;  // - item id -

            $gSmarty -> assign('action', $action);

            $gSmarty -> assign('result', $result);

            $gSmarty -> assign('add_action', $add_action);
            $gSmarty -> assign('what'  , $what);
            $gSmarty -> assign('code'  , $gSmarty -> get_config_vars('PeopleErr_'.$code));

            switch ($action)
            {
                 case 'send': // send message
                    require INC_PATH.'includes/classes/MC.php';
                    $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, $geo, 20);

                    $nickname = preg_replace('/[^a-z_0123456789-]/i', '', @$_REQUEST['whom']);

                    try
                    {
                        $UserInfo =& $user->Get($nickname, true);
                    }
                    catch (UsersException $cexc)
                    {
                    }

                    $gSmarty -> assign('whom', $nickname);

                    $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                                  'name' => $UserInfo['city_name']);

                    $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                                  'name' => 'People');

                    $bc[] = array('link' => PATH_ROOT.'people/'.$nickname.'/profile.html',
                                  'name' => ucfirst($nickname));

                    $bc[] = array('link' => '',
                                  'name' => 'Send message');

                    $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                    try
                    {
                        if (!empty($_POST['do']))
                        {
                           $mc -> Add($user -> GetUid($nickname), $UserInfoId, $_POST['mess']['subject'], $_POST['mess']['message']);
                           uni_redirect(PATH_ROOT.'people/'.$nickname.'/mess_2.html');
                        }
                    }
                    catch (UsersException $cexc)
                    {
                        a_redirect($cexc -> getCode());
                    }
                    break;

                 case 'friend': // friend request
                    $nickname = preg_replace('/[^a-z_0123456789-]/i', '', @$_REQUEST['whom']);

                    try
                    {
                        $UserInfo =& $user->Get($nickname, true);
                    }
                    catch (UsersException $cexc)
                    {
                    }

                    $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                    $gSmarty -> assign('whom', $nickname);

                    $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                                  'name' => $UserInfo['city_name']);

                    $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                                  'name' => 'People');

                    $bc[] = array('link' => PATH_ROOT.'people/'.$nickname.'/profile.html',
                                  'name' => ucfirst($nickname));

                    $bc[] = array('link' => '',
                                  'name' => 'Make Friends');

                    try
                    {
                        $res = $user -> AddFriendRequest($UserInfo['uid'] ,$UserInfoId);
                        if (2 == $res)
                            uni_redirect(PATH_ROOT.'people/'.$nickname.'/mess_3.html');
                        else
                            uni_redirect(PATH_ROOT.'people/'.$nickname.'/mess_4.html');
                    }
                    catch (UsersException $cexc)
                    {
                        a_redirect($cexc -> getCode());
                    }
                    break;

                 case 'kiss': // send kiss message
                    require INC_PATH.'includes/classes/MC.php';
                    $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, $geo, 20);

                    $nickname = preg_replace('/[^a-z_0123456789-]/i', '', @$_REQUEST['whom']);

                    try
                    {
                        $UserInfo =& $user->Get($nickname, true);
                    }
                    catch (UsersException $cexc)
                    {
                    }

                    $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                    $gSmarty -> assign('whom', $nickname);

                    $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                                  'name' => $UserInfo['city_name']);

                    $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                                  'name' => 'People');

                    $bc[] = array('link' => PATH_ROOT.'people/'.$nickname.'/profile.html',
                                  'name' => ucfirst($nickname));

                    $bc[] = array('link' => '',
                                  'name' => 'Give a Kiss');

                    try
                    {
                        /*if (!empty($_POST['do']))
                        {*/
                           $mess = str_replace('%username%', ucfirst($nickname), $gSmarty -> get_config_vars('KissMess'));
                           $mc -> Add($user -> GetUid($nickname), $UserInfoId, $mess, $mess, 0, 1);
                           uni_redirect(PATH_ROOT.'people/'.$nickname.'/mess_1.html');
                        /*}*/
                    }
                    catch (MCException $mce)
                    {
                        a_redirect($mce -> getCode());
                    }
                    break;

                 case 'view': // view user
                    $pic_id = @$_REQUEST['pic_id'];

                    $nickname = preg_replace('/[^a-z_0123456789-]/i', '', @$_REQUEST['whom']);

                    try
                    {
                        $UserInfo =& $user->Get($nickname, true);
                    }
                    catch (UsersException $cexc)
                    {
                        a_redirect($cexc -> getCode());
                    }


                    $gSmarty -> assign('whom', $nickname);
                    $UserInfo['age']     = floor((m_time()-$UserInfo['birthday']) / 31536000);
                    $UserInfo['photos'] = $user -> GetPhotos($UserInfo['uid']);
                    $cnt = count($UserInfo['photos']);

                    $temp = array();
                    for ($i = 0; $i < $cnt; $i++)
                    {
                       $temp[] = $UserInfo['photos'][$i]['name'];
                    }

                    $UserInfo['photos_list'] = join(',', $temp);

                    if (!$pic_id && $UserInfo['photos'])
                       $pic_id = $UserInfo['photos'][0]['pic_id'];

                    $pic_num = '';
                    for ($i = 0; $i < count($UserInfo['photos']); $i++)
                    {
                       if ($UserInfo['photos'][$i]['pic_id'] == $pic_id)
                          {
                           $pic_num = $UserInfo['photos'][$i];
                           break;
                          }
                    }

                    $gSmarty -> assign('pic_id', $pic_id);
                    $gSmarty -> assign('pic_num', $pic_num);

                    $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                    $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                                  'name' => $UserInfo['city_name']);

                    $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                                  'name' => 'People');

                    $bc[] = array('link' => '',
                                  'name' => ucfirst($nickname));

                    break;

                case 'mess':
                    $nickname = preg_replace('/[^a-z_0123456789-]/i', '', @$_REQUEST['whom']);

                    try
                    {
                        $UserInfo =& $user->Get($nickname, true);
                    }
                    catch (UsersException $cexc)
                    {
                        a_redirect($cexc -> getCode());
                    }

                    $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfo['abroad_city_id'],
                                  'name' => $UserInfo['city_name']);

                    $bc[] = array('link' => PATH_ROOT.'people/?city_id='.$UserInfo['abroad_city_id'],
                                  'name' => 'People');

                    $bc[] = array('link' => PATH_ROOT.'people/'.$nickname.'/profile.html',
                                  'name' => ucfirst($nickname));

                    $bc[] = array('link' => '',
                                  'name' => 'Message');

                    $gSmarty -> assign('UserInfo', $UserInfo);


                    $gSmarty -> assign('whom', $nickname);
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    $gSmarty -> assign('Message', $gSmarty -> get_config_vars('PeopleMess_'.$code));
                    break;

                case 'search': // people search
                    $stype = (isset($_REQUEST['stype'])) ? $_REQUEST['stype'] : '';
                    $gSmarty -> assign('stype', $stype);

                    /*if ('all' != $stype)
                        $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfoCurrentCity,
                                      'name' => $UserInfoCurrentCityName);*/

                    $bc[] = array('link' => PATH_ROOT.'people/',
                                  'name' => 'People');

                    if (!empty($_REQUEST['do']) )
                    {
                        if (empty($_REQUEST['srh'])
                            || (strlen($_REQUEST['srh']) < 3 && 'all' != $stype) )
                            uni_redirect(PATH_ROOT.'people/');

                        $srh = $_REQUEST['srh'];
                        $srh = StrToLower(preg_replace('/[^ @\.,a-z_0123456789-]/i', '', $srh));

                        $gSmarty -> assign('srh', $srh);

                        $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                        if (0 < $code)
                            $gSmarty -> assign('ErrMessage', $gSmarty -> get_config_vars('UserErr_'.$code));

                        $bc[] = array('link' => PATH_ROOT.'people/',
                                      'name' => 'Search results');

                        $pvstart    = (isset($_REQUEST['pvstart']))    ? intval($_REQUEST['pvstart']) : 0;                 // - page displaciment -
                        $order      = (isset($_REQUEST['order']))      ? $_REQUEST['order']           : 'nickname';  // - ordering -
                        $gSmarty -> assign('pvstart' , $pvstart);

                        $orderdesc = '';
                        if ('recently_added' != $order)
                        {
                            $order     = 'nickname';
                            $orderdesc = 'asc';
                            $gSmarty -> assign('order', 'all');
                        }
                        else
                        {
                            $order     = 'uid';
                            $orderdesc = 'desc';
                            $gSmarty -> assign('order', 'recently_added');
                        }

//                        if ('all' == $stype)
                        $users =& $user -> Search($srh, $pvstart, $order, 'asc', 0, 1);
//                         else
//                            $users =& $user -> Search($srh, $pvstart, $order, 'asc', $UserInfoCurrentCity, 1);

                        // Generate data for paginal viewing
                        if ($user -> ResOnPage() > 0 && $pvstart >= -1)
                        {
                            $pages = ceil($users[1] / $user -> ResOnPage());
                            $gSmarty -> assign_by_ref('pages', $pages);
                            $pgArr = array();
                            for ($i = 0; $i < $pages; $i++)
                            {
                                $pgArr[] = $i * $user -> ResOnPage();
                            }
                            $gSmarty -> assign_by_ref('pgArr', $pgArr);
                            $gSmarty -> assign('curPage'     , floor($pvstart / $user -> ResOnPage()));
                            $gSmarty -> assign('ResOnPage'   , $user -> ResOnPage());
                        }
                        else
                           $gSmarty -> assign('pages',1);

                        $gSmarty -> assign('users', $users[0]);
                    }
                    break;

                case 'overview':// overview
                default:
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    if (0 < $code)
                        $gSmarty -> assign('ErrMessage', $gSmarty -> get_config_vars('UserErr_'.$code));

                    $bc[] = array('link' => PATH_ROOT.'?mod=view_other_cities&city_id='.$UserInfoCurrentCity,
                                  'name' => $UserInfoCurrentCityName);

                    $bc[] = array('link' => '',
                                  'name' => 'People');

                    $pvstart    = (isset($_REQUEST['pvstart']))    ? intval($_REQUEST['pvstart']) : 0;                 // - page displaciment -
                    $order      = (isset($_REQUEST['order']))      ? $_REQUEST['order']           : 'recently_added';  // - ordering -
                    $gSmarty -> assign('pvstart' , $pvstart);

                    $orderdesc = '';
                    if ('recently_added' != $order)
                    {
                        $order     = 'nickname';
                        $orderdesc = 'asc';
                        $gSmarty -> assign('order', 'all');
                    }
                    else
                    {
                        $order     = 'reg_date';
                        $orderdesc = 'desc';
                        $gSmarty -> assign('order', 'recently_added');
                    }

                    $users =& $user -> GetAll($pvstart, $order, 'asc', $UserInfoCurrentCity, 1, $UserInfoId);

                    // Generate data for paginal viewing
                    $users_cnt = $user -> Count($UserInfoCurrentCity, 1);
                    if ($user -> ResOnPage() > 0 && $pvstart >= -1)
                    {
                        $pages = ceil($users_cnt / $user -> ResOnPage());
                        $gSmarty -> assign_by_ref('pages', $pages);
                        $pgArr = array();
                        for ($i = 0; $i < $pages; $i++)
                        {
                            $pgArr[] = $i * $user -> ResOnPage();
                        }
                        $gSmarty -> assign_by_ref('pgArr', $pgArr);
                        $gSmarty -> assign('curPage'     , floor($pvstart / $user -> ResOnPage()));
                        $gSmarty -> assign('ResOnPage'   , $user -> ResOnPage());
                    }
                    else
                       $gSmarty -> assign('pages',1);

                    $gSmarty -> assign('users', $users);
                    break;
            }

            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/people/_people.tpl'));
            break;

        #message center
        case 'mc':
            if (!$gAuthUser)
                uni_redirect(PATH_ROOT);

            require INC_PATH.'includes/classes/MC.php';

            $gSmarty -> config_load('mc.conf');

            $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, $geo, 20);

            function a_redirect($code = 0)
            {
                global $action, $pvstart, $order;
                $code = intval($code);
                if ($code > 0)
                    uni_redirect(PATH_ROOT.'?mod=mc&action='.$action.'&pvstart='.$pvstart.'&order='.$order.'&code='.$code);
                else
                    uni_redirect(PATH_ROOT.'?mod=mc&action='.$action.'&pvstart='.$pvstart.'&order='.$order);
            }

            $action     = (isset($_REQUEST['action']))     ? $_REQUEST['action']          : '';

            $add_action = (isset($_REQUEST['add_action'])) ? $_REQUEST['add_action']      : 'view';

            $what       = (isset($_REQUEST['what']))       ? $_REQUEST['what']            : '';
            $pvstart    = (isset($_REQUEST['pvstart']))    ? intval($_REQUEST['pvstart']) : 0;  // - page displaciment -
            $order      = (isset($_REQUEST['order']))      ? $_REQUEST['order']           : 4;  // - ordering -
            $code       = (isset($_REQUEST['code']))       ? $_REQUEST['code']            : 0;  // - error code -
            $id         = (isset($_REQUEST['id']))         ? $_REQUEST['id']              : 0;  // - item id -

            $gSmarty -> assign('action', $action);
            $gSmarty -> assign('add_action', $add_action);
            $gSmarty -> assign('what'  , $what);
            $gSmarty -> assign('pvstart' , $pvstart);
            $gSmarty -> assign('order' , $order);

            $bc[] = array('link' => PATH_ROOT,
                          'name' => 'Me');

            $bc[] = array('link' => PATH_ROOT.'?mod=mc&action=inbox&pvtstart=0&order=0',
                          'name' => 'My Inbox');

            switch ($action)
            {
                /*case 'mess':
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    $gSmarty -> assign('Message', $gSmarty -> get_config_vars('MCErr_'.$code));
                    break;*/

                case 'settings':
                    $bc[] = array('link' => '',
                                  'name' => 'Mail Settings');
                    switch ($add_action)
                    {
                        case 'change':
                            try
                            {
                                $user -> UpdateSettings($UserInfoId, @$_POST['Settings']);
                                a_redirect();
                            }
                            catch (UsersException $cexc)
                            {
                                a_redirect($cexc -> getCode());
                            }

                            break;

                        default:
                            try
                            {
                                $settings = $user -> GetSettings($UserInfoId);
                            }
                            catch (UsersException $cexc)
                            {
                                a_redirect($cexc -> getCode());
                            }

                            $gSmarty -> assign_by_ref('settings', $settings);

                            break;
                    }

                break;

                case 'friends_req':
                case 'pending_req':
                    $gSmarty -> assign('code'  , $gSmarty -> get_config_vars('UserErr_'.$code));

                    if ($action == 'friends_req')
                    {
                       $bc[] = array('link' => '',
                                     'name' => 'Friend Requests');
                       $status = 0;
                    }
                    elseif ($action == 'pending_req')
                    {
                       $bc[] = array('link' => '',
                                     'name' => 'Pending Requests');
                       $status = 1;
                    }

                    switch ($add_action)
                    {
                        case 'approve':
                            try
                            {
                               if ($id > 0)
                                  $user -> ApproveFriend($id, $UserInfoId);

                                a_redirect();
                            }
                            catch (UsersException $cexc)
                            {
                                a_redirect($cexc -> getCode());
                            }

                            break;


                        case 'delete':
                            try
                            {
                                if ($id > 0)
                                {
                                   if ($action == 'friends_req')
                                   {
                                       $user -> DisapproveFriend($id, $UserInfoId);
                                   }
                                   else
                                   {
                                       $user -> DeleteFriendRequest($id, $UserInfoId);
                                   }
                                }
                                elseif (!empty($_POST['check']))
                                {
                                   $checks = $_POST['check'];
                                   while (list($key, $val) = each($checks))
                                         {
                                             $id = intval($key);

                                             if ($action == 'friends_req')
                                             {
                                                 $user -> DisapproveFriend($id, $UserInfoId);
                                             }
                                             else
                                             {
                                                 $user -> DeleteFriendRequest($id, $UserInfoId);
                                             }

                                         }
                                }

                                a_redirect();
                            }
                            catch (UsersException $cexc)
                            {
                                a_redirect($cexc -> getCode());
                            }

                            break;

                        default:
                            $mess =& $user -> GetFriendRequests($UserInfoId, $status, $pvstart);

                            $mess_cnt = $mess[1];
                            // Generate data for paginal viewing
                            if ($user -> FriendRequestsOnPage() > 0 && $pvstart >= -1)
                            {
                                $pages = ceil($mess_cnt / $user -> FriendRequestsOnPage());
                                $gSmarty -> assign_by_ref('pages', $pages);
                                $pgArr = array();
                                for ($i = 0; $i < $pages; $i++)
                                {
                                    $pgArr[] = $i * $mc -> ResOnPage();
                                }
                                $gSmarty -> assign_by_ref('pgArr', $pgArr);
                                $gSmarty -> assign('curPage'     , floor($pvstart / $user -> FriendRequestsOnPage()) );
                                $gSmarty -> assign('ResOnPage'   , $user -> FriendRequestsOnPage());
                            }
                            else
                               $gSmarty -> assign('pages',1);

                            $gSmarty -> assign_by_ref('mess', $mess[0]);
                            break;
                    }


                    $gSmarty -> assign_by_ref('mess_cnt', $mess_cnt);
                    break;

                case 'inbox':
                case 'sent':
                case 'deleted':
                    $gSmarty -> assign('code'  , $gSmarty -> get_config_vars('MCErr_'.$code));

                    if ($action == 'inbox')
                    {
                       $type = 0;
                       $mess_cnt   = $mc -> CountNotReaded($UserInfoId, 0);
                    }
                    elseif ($action == 'sent')
                    {
                       $bc[] = array('link' => '',
                                     'name' => 'Sent items');
                       $type = 1;
                       $mess_cnt   = $mc -> Count($UserInfoId, $type);
                    }
                    elseif ($action == 'deleted')
                    {
                       $bc[] = array('link' => '',
                                     'name' => 'Deleted items');
                       $type = 2;
                       $mess_cnt   = $mc -> Count($UserInfoId, $type);
                    }

                    switch ($add_action)
                    {
                        case 'read':
                            try
                            {
                                $message = $mc -> Get($id, $UserInfoId);
                                $arr     = $mc -> GetNextPrevMessage($id, $UserInfoId, $type, $order);
                                $message['prev_id'] = $arr[0];
                                $message['next_id'] = $arr[1];

                                $mc -> SetReaded($id, $UserInfoId);
                                $gSmarty -> assign_by_ref('message', $message);
                            }
                            catch (MCException $mce)
                            {
                                a_redirect($mce -> getCode());
                            }
                            break;
                        case 'reply':
                            if ('inbox' == $action)
                            {
                               try
                               {
                                   $message = $mc -> Get($id, $UserInfoId);
                                   $arr     = $mc -> GetNextPrevMessage($id, $UserInfoId, $type, $order);
                                   $message['prev_id'] = $arr[0];
                                   $message['next_id'] = $arr[1];
                                   $gSmarty -> assign_by_ref('message', $message);

                                   if (!empty($_POST['do']))
                                   {
                                      $action = 'sent';
                                      $order  = 4;

                                      $mc -> Add($message['fromid'],$UserInfoId,$_POST['mess']['subject'], $_POST['mess']['message']);
                                      $mc -> SetReaded($id, $UserInfoId);

                                      a_redirect();
                                   }
                               }
                               catch (MCException $mce)
                               {
                                   a_redirect($mce -> getCode());
                               }
                            }
                            else
                                a_redirect(2);
                            break;
                        case 'delete':
                            try
                            {
                                if ($id > 0)
                                   $mc -> Delete($id, $UserInfoId);
                                elseif (!empty($_POST['check']))
                                {
                                   $checks = $_POST['check'];
                                   while (list($key, $val) = each($checks))
                                         {
                                          $id = intval($key);
                                          $mc -> Delete($id, $UserInfoId);
                                         }
                                }

                                a_redirect();
                            }
                            catch (MCException $mce)
                            {
                                a_redirect($mce -> getCode());
                            }

                            break;

                        default:
                            $mess =& $mc -> GetAll($UserInfoId, $type, $pvstart, $order);

                            // Generate data for paginal viewing
                            if ($mc -> ResOnPage() > 0 && $pvstart >= -1)
                            {
                                $pages = ceil($mess_cnt / $mc -> ResOnPage());
                                $gSmarty -> assign_by_ref('pages', $pages);
                                $pgArr = array();
                                for ($i = 0; $i < $pages; $i++)
                                {
                                    $pgArr[] = $i * $mc -> ResOnPage();
                                }
                                $gSmarty -> assign_by_ref('pgArr', $pgArr);
                                $gSmarty -> assign('curPage'     , floor($pvstart / $mc -> ResOnPage()));
                                $gSmarty -> assign('ResOnPage'   , $mc -> ResOnPage());
                            }
                            else
                               $gSmarty -> assign('pages',1);

                            $gSmarty -> assign_by_ref('mess', $mess);
                            break;
                    }


                    $gSmarty -> assign_by_ref('mess_cnt', $mess_cnt);
                    break;
            }

            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/me/_mc.tpl'));
            break;

        #user registration
        case 'registration':
            include INC_PATH . 'includes/classes/BOpt.php';

            $UserOpt = new BOpt($gDb, TB . 'optcat', TB . 'optel', 'people');
            $UserOptions =& $UserOpt -> GetBlock();

            $gSmarty -> assign_by_ref('UserOptions', $UserOptions);

            function a_redirect($code = 0)
            {
                $code = intval($code);
                if ($code > 0)
                    uni_redirect(PATH_ROOT.'?mod=registration&action=mess&code='.$code);
                else
                    uni_redirect(PATH_ROOT);
            }

            $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
            $what   = (isset($_REQUEST['what']))   ? $_REQUEST['what']   : '';

            $gSmarty -> assign('action', $action);
            $gSmarty -> assign('what', $what);

            $gSmarty -> assign('step', @$_REQUEST['step']);

            switch ($action)
            {
                 case 'restore_password':

                    $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                    if (1 == $do)
                    {
                        try
                        {
                            if (!isset($_POST['email']))
                                $_POST['email'] = '';

                            $new_pass = $user -> RestorePassword($_POST['email']);

                            $gSmarty -> assign('email', $_POST['email']);
                            $gSmarty -> assign('password', $new_pass);
                            send_email2user($_POST['email'], SUPPORT_SITENAME .' '.$gSmarty -> get_config_vars('NewPass'), $gSmarty -> fetch('mails/_send_pass.tpl'));
                            a_redirect(2);
                        }
                        catch (UsersException $cexc)
                        {
                            $gSmarty -> assign('UserLastError', $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                        }
                    }

                    break;

                 case 'main':
                 case 'auth':
                    if (!empty($_POST['UserInfo']))
                       {
                        $res = $user -> Auth($_POST['UserInfo'], 'go');
                        if (!$res)
                           $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_8'));
                        else
                           uni_redirect(PATH_ROOT);
                       }
                    break;

                 case 'view':
                    if ($gAuthUser)
                    {
                        $bc[] = array('link' => PATH_ROOT,
                                      'name' => 'Me');

                        $bc[] = array('link' => '',
                                      'name' => 'My Profile');

                         $pic_id = @$_REQUEST['pic_id'];

                         try
                         {
                             if (!isset($_REQUEST['whom']))
                                $UserInfo =& $user->Get($UserInfoId);
                             else
                             {
                                $nickname = preg_replace('/[^a-z_0123456789-]/i', '', @$_REQUEST['whom']);

                                $UserInfo =& $user->Get($nickname, true);
                                $gSmarty -> assign('whom', $nickname);
                             }
                         }
                         catch (UsersException $cexc)
                         {
                             $user -> Logout();
                             a_redirect();
                         }

                         $UserInfo['age']     = floor((m_time()-$UserInfo['birthday']) / 31536000);
                         $UserInfo['photos'] = $user -> GetPhotos($UserInfo['uid']);
                         $cnt = count($UserInfo['photos']);

                         $temp = array();
                         for ($i = 0; $i < $cnt; $i++)
                         {
                            $temp[] = $UserInfo['photos'][$i]['name'];
                         }

                         $UserInfo['photos_list'] = join(',', $temp);

                         if (!$pic_id && $UserInfo['photos'])
                            $pic_id = $UserInfo['photos'][0]['pic_id'];

                         $pic_num = '';
                         for ($i = 0; $i < count($UserInfo['photos']); $i++)
                         {
                            if ($UserInfo['photos'][$i]['pic_id'] == $pic_id)
                               {
                                $pic_num = $UserInfo['photos'][$i];
                                break;
                               }
                         }

                         $gSmarty -> assign('pic_id', $pic_id);
                         $gSmarty -> assign('pic_num', $pic_num);

                         $gSmarty -> assign_by_ref('UserInfo', $UserInfo);
                    }
                    else
                        uni_redirect(PATH_ROOT);
                    break;
                 case 'change':
                    if ($gAuthUser)
                    {
                        $bc[] = array('link' => PATH_ROOT,
                                      'name' => 'Me');

                        $bc[] = array('link' => PATH_ROOT.'?mod=registration&action=view&what=profile',
                                      'name' => 'My Profile');

                        if ('profile' == $what)
                        {
                            $bc[] = array('link' => '',
                                          'name' => 'Edit My Profile');
                            $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                            if (1 == $do)
                            {
                                $UserInfo = $_POST['UserInfo'];
                                if (isset($_REQUEST['cancel']))
                                    a_redirect($ordercol, $orderdesc, $pvstart);
                                else
                                {
                                    try
                                    {
                                        $user->Change($UserInfoId, $UserInfo);
                                        $_SESSION['UserInfoEmail']    = $UserInfo['email'];
                                        $_SESSION['UserInfoCity']     = $UserInfo['abroad_city_id'];
                                        $arr = $geo->GetCityName($UserInfo['abroad_city_id']);
                                        $_SESSION['UserInfoCityName'] = $arr['city_name'];
                                        $_SESSION['UserInfoCntrName'] = $arr['country_name'];
                                        $_SESSION['UserInfoStatus']   = $UserInfo['abroad_status'];
                                        $_SESSION['UserInfoCountry']  = $UserInfo['iso2_cntr'];

                                        if ($_SESSION['UserAdmin'])
                                           $_SESSION['UserInfoNickname'] = ADMIN_LOGIN;
                                        else
                                           $_SESSION['UserInfoNickname'] = $UserInfo['nickname'];

                                        uni_redirect(PATH_ROOT.'?mod=registration&action=change&what=profile');
                                    }
                                    catch (UsersException $cexc)
                                    {
                                        $gSmarty -> assign('UserLastError', $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                                    }
                                }
                            }
                            else
                            {
                                try
                                {
                                    $UserInfo =& $user->Get($UserInfoId);
                                }
                                catch (UsersException $cexc)
                                {
                                    $user -> Logout();
                                    a_redirect();
                                }
                            }

                            $UserInfo['uid'] = $UserInfoId;

                            $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                            $cntr_ar =& $geo -> GetCountries();
                            $gSmarty -> assign_by_ref('cntr_ar', $cntr_ar);
                        }
                        elseif ('photos' == $what)
                        {
                            $bc[] = array('link' => '',
                                          'name' => 'Upload Photos');
                            $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';

                            if ($do == 1)
                            {
                                try
                                {
                                    $id = $user -> AddPhoto($UserInfoId);
                                }
                                catch (UsersException $cexc)
                                {
                                    $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                                }
                            }
                            elseif ($do == 2)
                            {
                                try
                                {
                                    $user -> DelPhoto(@$_GET['pic_id'],$UserInfoId);
                                }
                                catch (UsersException $cexc)
                                {
                                    $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                                }
                            }

                            $photos = $user -> GetPhotos($UserInfoId);

                            $cnt = count($photos);

                            $temp = array();
                            for ($i = 0; $i < $cnt; $i++)
                            {
                               $temp[] = $photos[$i]['name'];
                            }

                            $UserInfo['photos_list'] = join(',', $temp);
                            $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                            $gSmarty -> assign_by_ref('photos', $photos);
                            $gSmarty -> assign('photos_cnt', count($photos));
                        }
                    }
                    else
                        uni_redirect(PATH_ROOT);
                    break;
                 case 'logout':
                    $user -> Logout();
                    a_redirect();
                    break;
                 case 'delete':
                    $user -> Delete($UserInfoId);
                    $user -> Logout();
                    a_redirect(4);
                    break;
                 case 'cities_ajax':
                    require INC_PATH.'includes/classes/SubSys.php';
                    $JsHttpRequest =& new Subsys_JsHttpRequest_Php(DEF_CHARSET);
                    $iso2_cntr = (!empty($_REQUEST['iso2_cntr'])) ? $_REQUEST['iso2_cntr'] : '';

                    if ('' == $iso2_cntr)
                       exit();

                    try
                    {
                        $st_ar =& $geo -> GetCities($iso2_cntr);
                    }
                    catch (Exception $exc)
                    {
                        sc_error($exc);
                    }

                    $city_idx = (!empty($_REQUEST['city_idx'])) ? intval($_REQUEST['city_idx']) : 0;

                    $field   = (isset($_REQUEST['field'])) ? $_REQUEST['field'] : 'city_idx';

                    $gSmarty -> assign_by_ref('city_idx', $city_idx);
                    $gSmarty -> assign_by_ref('field'  , $field);
                    $gSmarty -> assign_by_ref('st_ar'  , $st_ar);
                    $gSmarty -> display('mods/me/_registration_cities.tpl');
                    exit();

                     break;

                 case 'reg':
                    if (empty($_REQUEST['step']) || $_REQUEST['step'] == 1)
                    {
                        $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';

                        if ($do == 1)
                        {
                            if (isset($_REQUEST['cancel']))
                                a_redirect();
                            else
                            {
                                $gSmarty -> assign('UserInfo' , $_POST['UserInfo']);

                                try
                                {
                                    $id = $user -> Add($_POST['UserInfo']);
                                    $_SESSION['reg_ok'] = $id;
                                    uni_redirect(PATH_ROOT.'?mod=registration&action=reg&step=2&user_id='.$id);
                                }
                                catch (UsersException $cexc)
                                {
                                    $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                                }
                            }
                        }
                        else
                        {
                            $UserInfo['iso2_cntr'] = 'ES';
                            $gSmarty -> assign_by_ref('UserInfo' , $UserInfo);
                        }

                        $cntr_ar =& $geo -> GetCountries();
                        $gSmarty -> assign_by_ref('cntr_ar', $cntr_ar);
                    }
                    elseif (isset($_SESSION['reg_ok']))
                    {
                        $user_id = intval($_SESSION['reg_ok']);
                        $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';

                        $gSmarty -> assign('user_id', $user_id);

                        if ($do == 1)
                        {
                            try
                            {
                                $id = $user -> AddPhoto($user_id);
                            }
                            catch (UsersException $cexc)
                            {
                                $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                            }
                        }
                        elseif ($do == 2)
                        {
                            try
                            {
                                $user -> DelPhoto(@$_GET['pic_id'],$user_id);
                            }
                            catch (UsersException $cexc)
                            {
                                $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                            }
                        }

                        $photos = $user -> GetPhotos($user_id);
                        $cnt = count($photos);

                        // added by Max 2
                        $temp = array();
                        for ($i = 0; $i < $cnt; $i++)
                        {
                           $temp[] = $photos[$i]['name'];
                        }

                        $UserInfo['photos_list'] = join(',', $temp);

                        $gSmarty -> assign_by_ref('UserInfo', $UserInfo);
                        // end

                        $gSmarty -> assign_by_ref('photos', $photos);
                        $cnt = count($photos);
                        $gSmarty -> assign('photos_cnt', $cnt);
                    }
                    break;

                case 'mess':
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    $gSmarty -> assign('Message', $gSmarty -> get_config_vars('UserMess_'.$code));
                    break;
            }

            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/me/_registration.tpl'));
            break;

        #index
        default:
            if ($gAuthUser)
            {
                $bc[] = array('link' => PATH_ROOT,
                              'name' => 'Me');

                $bc[] = array('link' => '',
                              'name' => 'Overview');

                include INC_PATH . 'includes/classes/BComment.php';
                // Photos module stat
                include INC_PATH . 'includes/classes/BPhoto.php';
                $photo  =  new BPhoto($gDb, TB.'photo', 'page.php?mod=photo&uid='.$UID);
                $photoc  =  new BComment($gDb, TB.'photo_comment', 'page.php?mod=photo&uid='.$UID);
                $photoList =& $photo -> GetList($UID, 1, '', 0, 3);
                $cnt = count($photoList);
                for ($i = 0; $i < $cnt; $i++)
                    $list[$i]['pcnt'] =& $photoc -> GetCommentCount($photoList[$i]['id']);

                $gSmarty -> assign_by_ref('photoList', $photoList);
                $gSmarty -> assign('photo_cnt', $photo -> GetCount($UID));

                // Blog module stat
                include INC_PATH . 'includes/classes/BText.php';
                $blog  =  new BText($gDb, TB.'blog', 'page.php?mod=blog&uid='.$UID);
                $blogc =  new BComment($gDb, TB.'blog_comment', 'page.php?mod=blog&uid='.$UID);
                $blogList =& $blog -> GetPageList($UID, 1, '', 0, 1);
                if (0 < count($blogList))
                {
                   $list[$i]['pcnt'] =& $blogc -> GetCommentCount($blogList[0]['id']);
                   $gSmarty -> assign('blogItem', $blogList[0]);
                }

                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_my_blog.tpl'));
                // People module stat
                $gSmarty -> assign('people_cnt', $user -> Count($UserInfoCity, 1, $UserInfoId, 7));

                // Other modules stat
                include INC_PATH . 'includes/classes/BInfo.php';
                $mods = array('nightlife', 'culture', 'food', 'lodging', 'necessities');
                $cnt = count($mods);
                for ($i = 0; $i < $cnt; $i++)
                {
                    $nl  = new BInfo($gDb, TB.$mods[$i], 'page.php?mod='.$mod, TB.$mods[$i].'_adi');
                    $gSmarty -> assign($mods[$i].'_cnt', $nl -> GetPageCountDt($UserInfoCity, 1, 604800));
                }

                // Inbox module stat
                require INC_PATH.'includes/classes/MC.php';
                $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, $geo, 20);
                $gSmarty -> assign('mc_inbox_cnt', $mc -> CountNotReaded($UserInfoId, 0));
                $mess =& $user -> GetFriendRequests($UserInfoId, 0, 0);
                $gSmarty -> assign('mc_friend_requests_cnt', $mess[1]);
                $mess =& $user -> GetFriendRequests($UserInfoId, 1, 0);
                $gSmarty -> assign('mc_pending_requests_cnt', $mess[1]);
                $gSmarty -> assign('mc_last_kiss', $mc -> GetLastKiss($UserInfoId));

                // Friends module stat
                $user -> SetFriendsOnPage(4);
                $users =& $user -> GetFriends($UserInfoId, 0, 'reg_date', 'desc');

                $gSmarty -> assign('users', $users[0]);
                $gSmarty -> assign('friends_cnt', $users[1]);

                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/_me_overview.tpl'));
            }
            break;
    }

    $gSmarty -> assign_by_ref('bc', $bc);
    #output templates
    if (!$gAuthUser)
    {
        if (empty($mod)
            || ($mod == 'registration'
                && $action == 'auth'))
        {
            require INC_PATH.'includes/classes/Spages.php';
            $spage = new Spages($gDb, TB.'spagescat', TB.'spages', 'index.php?mod=page');
            $gSmarty -> assign('pinf', $spage -> GetPageInfo(0, 'mainpage'));

            $usersMain =& $user -> GetOnMain();
            $gSmarty -> assign_by_ref('usersMain', $usersMain);

            require INC_PATH.'includes/classes/Mpimg.php';
            $mpi = new Mpimg($gDb, TB.'mpimg');
            $gSmarty -> assign('mpi', $mpi -> Get());
            $gSmarty -> display('main.tpl');
        }
        else
            $gSmarty -> display('index_not_registered.tpl');
    }
     else
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