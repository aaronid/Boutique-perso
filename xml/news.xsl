<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method = "html" encoding="Windows-1252" />
	
	<xsl:template match="news">	
		<html>
			<title></title>
			<body>
  				<xsl:for-each select="item">
    				<xsl:value-of select="pubDate"/> : 
    				<strong><xsl:value-of select="title"/></strong><br />
    				<xsl:value-of select="description"/><br /><br />  
  				</xsl:for-each>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>