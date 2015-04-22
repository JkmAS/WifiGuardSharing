<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : record.xsl
    Version    : 1.0.0
    Author     : JkmAS
    Description: To transform XML with record to HTML view.        
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0"
                xmlns:xp="http://www.wifiguard.cz">
    
    <xsl:output method="html" encoding="UTF-8"/>
    
    <xsl:template match="xp:devices">
        
        <table>
            <caption>
                <strong>Record: <xsl:value-of select="xp:time"/></strong>
            </caption>
            
            <tr>
                <th>No.</th>
                <th>IP address</th> 
                <th>MAC address</th>
                <th>Device name</th>
                <th>Information</th>
            </tr>        
                        
            <xsl:for-each select="xp:device">
                <tr>
                    <td><xsl:value-of select="@no."/>.</td>
                    <td><xsl:value-of select="xp:ip_address"/></td>
                    <td><xsl:value-of select="xp:mac_address"/></td>               
                    <xsl:choose>
                        <xsl:when test="xp:device_name[text()]">
                            <td><xsl:value-of select="xp:device_name"/></td>
                        </xsl:when>
                        <xsl:otherwise>
                            <td>Not set</td>
                        </xsl:otherwise>
                    </xsl:choose>
                    <xsl:choose>
                        <xsl:when test="xp:information[contains(text(),'Unknown')]">
                            <td>Unknown</td>
                        </xsl:when>
                        <xsl:otherwise>
                            <td><xsl:value-of select="xp:information"/></td>
                        </xsl:otherwise>
                    </xsl:choose>
                </tr>
            </xsl:for-each>
        </table>    
    </xsl:template>    
    
</xsl:stylesheet>