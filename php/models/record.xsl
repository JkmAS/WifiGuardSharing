<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : record.xsl
    Version    : 1.0.0
    Author     : JkmAS
    Description: To transform XML with record to HTML view.        
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
    
    <xsl:output method="html" encoding="UTF-8"/>
    
    <xsl:template match="/">
        
        <table>
            <caption>
                <strong>Record: <xsl:value-of select="devices/time"/></strong>
            </caption>
            
            <tr>
                <th>No.</th>
                <th>IP address</th> 
                <th>MAC address</th>
                <th>Device name</th>
                <th>Information</th>
            </tr>        
                        
            <xsl:for-each select="devices/device">
                <tr>
                    <td><xsl:value-of select="@no."/>.</td>
                    <td><xsl:value-of select="ip_address"/></td>
                    <td><xsl:value-of select="mac_address"/></td>               
                    <xsl:choose>
                        <xsl:when test="device_name[text()]">
                            <td><xsl:value-of select="device_name"/></td>
                        </xsl:when>
                        <xsl:otherwise>
                            <td>Not set</td>
                        </xsl:otherwise>
                    </xsl:choose>
                    <xsl:choose>
                        <xsl:when test="information[contains(text(),'Unknown')]">
                            <td>Unknown</td>
                        </xsl:when>
                        <xsl:otherwise>
                            <td><xsl:value-of select="information"/></td>
                        </xsl:otherwise>
                    </xsl:choose>
                </tr>
            </xsl:for-each>
        </table>    
    </xsl:template>    
    
</xsl:stylesheet>