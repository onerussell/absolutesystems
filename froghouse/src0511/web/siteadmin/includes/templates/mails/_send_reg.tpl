<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$charset}" />
<style>
{literal}
body {
    font-size: 11px; font-family: verdana, arial, helvetica
}

p {
    font-size: 11px; font-family: verdana, arial, helvetica
}

br {
    font-size: 11px; font-family: verdana, arial, helvetica
}

td {
    font-size: 11px; font-family: verdana, arial, helvetica
}

nobr {
    font-size: 11px; font-family: verdana, arial, helvetica
}

a:link {
    color: steelblue; text-decoration: none
}

a:visited {
    color: steelblue; text-decoration: none
}

a:hover {
    color: #000066; text-decoration: underline
}

h1 {
    font-size: 18px; color: black
}

h2 {
    font-size: 16px; color: black
}

.pageheadercell {
     padding-left: 8px; font-weight: normal; font-size: 11px; padding-bottom: 2px; padding-top: 2px; border-bottom: slategray 1px solid;
     font-family: verdana, arial, helvetica; 
     background-color: 6ea6ce;
}

.head {color: gray;
       font-weight: bold;   
} 

input, textarea {
    color : #1d2f38;
    border : 1px solid #495879;
    background-color : #ffffff;
}
{/literal}
</style>
</head>
<body>
Thank you for registering at <a href="http://www.thefroghouse.net">thefroghouse.net</a>. Your account has been activated. Below is your login/password information. Don't lose it!
<br />
<table border="0" cellpadding="2" cellspacing="2">
<tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
<tr align="left" vAlign="middle"> <td><b>{#EMail#}</b></td>     <td> {$UserInfo.email} </td> </tr>
<tr align="left" vAlign="middle"> <td><b>{#Password#}</b></td>  <td> {$UserInfo.pass} </td> </tr>
<tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
<tr align="left" vAlign="middle"> <td><b>Your personal information</b></td> </tr>
<tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
<tr align="left" vAlign="middle"> <td>NickName</td>     <td> {$UserInfo.nickname}</td> </tr>
<tr align="left" vAlign="middle"> <td>{#City#}</td>      <td></td> </tr>
<tr align="left" vAlign="middle"> <td>Abroad Status</td> <td>{$UserInfo.abroad_status}</td> </tr>
<tr align="left" vAlign="middle"> <td>Birthday</td>  <td>{$UserInfo.birthday|date_format:"%d %B %Y"}  </td> </tr>

{*<tr align="left" vAlign="middle"> <td>{#LName#}</td>  <td> {$UserInfo.lname} </td> </tr>*}
<tr align="left" vAlign="middle"> <td>{#FName#}</td>  <td> {$UserInfo.fname} </td> </tr>
<tr align="left" vAlign="middle"> <td>{#MName#}</td>  <td> {$UserInfo.mname} </td> </tr>

<tr align="left" vAlign="middle"> <td>Originally from</td>  <td> {$UserInfo.originally_from}</td> </tr>
<tr align="left" vAlign="middle"> <td>Here for</td>         <td> {$UserInfo.here_for}</td> </tr>
<tr align="left" vAlign="middle"> <td>Home university</td>  <td> {$UserInfo.uni_home}</td> </tr>
<tr align="left" vAlign="middle"> <td>Host univercity</td>  <td> {$UserInfo.uni_host}</td> </tr>
<tr align="left" vAlign="middle"> <td>Languages</td>        <td> {$UserInfo.languages}</td> </tr>
<tr align="left" vAlign="middle"> <td>Cities visited</td>   <td> {$UserInfo.visited_cities}</td> </tr>
<tr align="left" vAlign="middle"> <td>Places I'd like to visit</td>  <td> {$UserInfo.like_visit} </td> </tr>

<tr align="left" vAlign="middle"> <td>Relationship status</td> <td>{$UserInfo.relation_status}</td> </tr>

<tr align="left" vAlign="middle"> <td>Sexual Orientation</td> <td>{$UserInfo.sexual_orientation}</td> </tr>

<tr align="left" vAlign="middle"> <td>Turn Ons</td> <td>{$UserInfo.turn_ons} </td> </tr>

<tr align="left" vAlign="middle"> <td>Turn Offs</td> <td>{$UserInfo.turn_offs} </td> </tr>

<tr align="left" vAlign="middle"> <td>Interested In</td> <td>{$UserInfo.interested_in} </td> </tr>

<tr align="left" vAlign="middle"> <td>Quote</td> <td>{$UserInfo.quote} </td> </tr>

<tr align="left" vAlign="middle"> <td>About me</td> <td>{$UserInfo.about_me} </td> </tr>

<tr align="left" vAlign="middle"> <td>Best Travel Story</td> <td>{$UserInfo.best_travel_story} </td> </tr>

<tr align="left" vAlign="middle"> <td>Travel Advice</td> <td>{$UserInfo.travel_advice} </td> </tr>
</table>
</body>
</html>