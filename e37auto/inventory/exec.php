<?
echo exec('/usr/local/safe_mode/fop-0.20.5/fop.sh -xsl /usr/local/apache/htdocs/site06/e37auto/inventory/3.xsl -xml /usr/local/apache/htdocs/site06/e37auto/inventory/2.xml -pdf /tmp/myfile.pdf');
copy('/tmp/myfile.pdf','1.pdf');
header('Location: 1.pdf');
?>