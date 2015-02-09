<?
$xsl = new DOMDocument;
$xsl->load('3.xsl');
$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);

$xml = new DOMDocument;
$xml->load('2.xml');

if (false === $results = $xslt->transformToXML($xml)) {
echo "error";
}
//echo "done";
echo $results;
?>