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
<h2>{#NewPass#}</h2>
<p>
{#EMail#}:   <b>{$email}</b><br />
{#Password#}: <b>{$password}</b>
</p>
</body>
</html>