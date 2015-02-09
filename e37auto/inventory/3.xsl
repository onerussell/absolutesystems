<?xml version="1.0" encoding="utf-8" ?>
<?xsl-test-case type="text/xml" href=".\2.xml"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="xml" encoding="utf-8" indent="yes"/>
	<xsl:template match="/">
		<fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
	<fo:layout-master-set>
		<fo:simple-page-master master-name="all-pages" page-width="8in" page-height="11in">
			<fo:region-body region-name="xsl-region-body" column-gap="0.25in" padding-top="6pt" padding-left="6pt" padding-right="6pt" padding-bottom="6pt" margin-top="0.7in" margin-left="0.7in" margin-right="0.7in" margin-bottom="0.7in"/>
			<fo:region-before region-name="xsl-region-before" display-align="after" extent="0.7in" padding-top="6pt" padding-left="0.7in" padding-right="0.7in" padding-bottom="6pt"/>
			<fo:region-after region-name="xsl-region-after" display-align="before" extent="0.7in" padding-top="6pt" padding-left="0.7in" padding-right="0.7in" padding-bottom="6pt"/>
		</fo:simple-page-master>
		<fo:page-sequence-master master-name="default-sequence">
			<fo:repeatable-page-master-reference master-reference="all-pages"/>
		</fo:page-sequence-master>
	</fo:layout-master-set>
	<fo:page-sequence master-reference="default-sequence">
		<fo:flow flow-name="xsl-region-body" font-size="12pt" font-family="Times New Roman">
			<fo:block><fo:table border-collapse="collapse">
					<fo:table-column column-width="14.2857%" column-number="1"/>
					<fo:table-column column-width="14.2857%" column-number="2"/>
					<fo:table-column column-width="14.2857%" column-number="3"/>
					<fo:table-column column-width="14.2857%" column-number="4"/>
					<fo:table-column column-width="14.2857%" column-number="5"/>
					<fo:table-column column-width="14.2857%" column-number="6"/>
					<fo:table-column column-width="14.2857%" column-number="7"/>
					<fo:table-header background-color="rgb(128,128,255)">
						<fo:table-row display-align="before">
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Photo</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Model</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Year</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Miles</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Description</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Status</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>Price</fo:block>
							</fo:table-cell>
						</fo:table-row>
					</fo:table-header>
					<fo:table-body>
					<xsl:for-each select="root/data">
						<fo:table-row display-align="before">
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block>xxxPhoto</fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block><xsl:value-of select="@model_name" /></fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block><xsl:value-of select="@model_name" /></fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block><xsl:value-of select="@modelsale_mile" /></fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block><xsl:value-of select="." /></fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block><xsl:value-of select="@modelsale_status" /></fo:block>
							</fo:table-cell>
							<fo:table-cell text-align="left" border-left-style="solid" border-left-width="1pt" border-left-color="rgb(0,0,0)" border-right-style="solid" border-right-width="1pt" border-right-color="rgb(0,0,0)" border-top-style="solid" border-top-width="1pt" border-top-color="rgb(0,0,0)" border-bottom-style="solid" border-bottom-width="1pt" border-bottom-color="rgb(0,0,0)" padding-top="2pt" padding-left="2pt" padding-right="2pt" padding-bottom="2pt">
								<fo:block><xsl:value-of select="@modelsale_price" /></fo:block>
							</fo:table-cell>
						</fo:table-row>
						</xsl:for-each>
					</fo:table-body>
				</fo:table></fo:block>
		</fo:flow>
	</fo:page-sequence>
</fo:root>
</xsl:template>
</xsl:stylesheet>