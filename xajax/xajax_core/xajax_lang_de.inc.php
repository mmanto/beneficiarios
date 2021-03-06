<?php
/*
	File: xajax_lang_de.inc.php

	Contains the debug and error messages output by xajax translated to German.

	Title: xajax class

	Please see <copyright.inc.php> for a detailed description, copyright
	and license information.
	
	Translations provided by: (Thank you!)
	- mic <info@joomx.com>
	- q_no
*/

/*
	@package xajax
	@version $Id: xajax_lang_de.inc.php 362 2007-05-29 15:32:24Z calltoconstruct $
	@copyright Copyright (c) 2005-2007 by Jared White & J. Max Wilson
	@copyright Copyright (c) 2008-2009 by Joseph Woolley, Steffen Konerow, Jared White  & J. Max Wilson
	@license http://www.xajaxproject.org/bsd_license.txt BSD License
*/

//SkipAIO

$objLanguageManager =& xajaxLanguageManager::getInstance();
$objLanguageManager->register('de', array(
	'LOGHDR:01' => '** xajax Fehler Protokoll - ',
	'LOGHDR:02' => " **\n",
	'LOGHDR:03' => "\n\n\n",
	'LOGERR:01' => "** Protokolliere Fehler **\n\nxajax konnte den Fehler nicht in die Protokolldatei schreiben:\n",
	'LOGMSG:01' => "** PHP Fehlermeldungen: **",
	'CMPRSJS:RDERR:01' => 'Die unkomprimierte JavaScript-Datei konnte nicht gefunden werden im Verzeichnis: <b>',
	'CMPRSJS:RDERR:02' => '</b>.  Fehler ',
	'CMPRSJS:WTERR:01' => 'Die komprimierte xajax JavaScript-Datei konnte nicht in das Verzeichnis <b>',
	'CMPRSJS:WTERR:02' => '</b> geschrieben werden.  Fehler ',
	'CMPRSPHP:WTERR:01' => 'Die komprimierte xajax Datei <b>',
	'CMPRSPHP:WTERR:02' => '</b> konnte nicht geschrieben werden.  Fehler ',
	'CMPRSAIO:WTERR:01' => 'Die komprimierte xajax Datei <b>',
	'CMPRSAIO:WTERR:02' => '/xajaxAIO.inc.php</b> konnte nicht geschrieben werden.  Fehler ',
	'DTCTURI:01' => 'xajax Fehler: xajax konnte die Request URI nicht automatisch identifizieren.',
	'DTCTURI:02' => 'Bitte setzen sie die Request URI explizit wenn sie die xajax Klasse instanziieren.',
	'ARGMGR:ERR:01' => 'Fehlerhaftes Objekt erhalten: ',
	'ARGMGR:ERR:02' => ' <==> ',
	'ARGMGR:ERR:03' => 'Die erhaltenen xajax Daten konnte nicht aus UTF8 konvertiert werden.',
	'XJXCTL:IAERR:01' => 'Ung??ltiges Attribut [',
	'XJXCTL:IAERR:02' => '] f??r Element [',
	'XJXCTL:IAERR:03' => '].',
	'XJXCTL:IRERR:01' => 'Ung??ltiges Request-Objekt ??bergeben an xajaxControl::setEvent',
	'XJXCTL:IEERR:01' => 'Ung??ltiges Attribut (event name) [',
	'XJXCTL:IEERR:02' => '] f??r Element [',
	'XJXCTL:IEERR:03' => '].',
	'XJXCTL:MAERR:01' => 'Erforderliches Attribut fehlt [',
	'XJXCTL:MAERR:02' => '] f??r Element [',
	'XJXCTL:MAERR:03' => '].',
	'XJXCTL:IETERR:01' => "Ung??ltiges End-Tag; Sollte 'forbidden' oder 'optional' sein.\n",
	'XJXCTL:ICERR:01' => "Ung??ltige Klasse f??r html control angegeben.; Sollte %inline, %block oder %flow sein.\n",
	'XJXCTL:ICLERR:01' => 'Ung??ltige Klasse (control) an addChild ??bergeben; Sollte abgeleitet sein von xajaxControl.',
	'XJXCTL:ICLERR:02' => 'Ung??ltige Klasse (control) an addChild ??bergeben [',
	'XJXCTL:ICLERR:03' => '] f??r Element [',
	'XJXCTL:ICLERR:04' => "].\n",
	'XJXCTL:ICHERR:01' => 'Ung??ltiger Parameter ??bergeben f??r xajaxControl::addChildren; Array aus xajaxControl Objekten erwartet.',
	'XJXCTL:MRAERR:01' => 'Erforderliches Attribut fehlt [',
	'XJXCTL:MRAERR:02' => '] f??r Element [',
	'XJXCTL:MRAERR:03' => '].',
	'XJXPLG:GNERR:01' => 'Response plugin sollte die Funktion getName ??berschreiben.',
	'XJXPLG:PERR:01' => 'Response plugin sollte die process Funktion ??berschreiben.',
	'XJXPM:IPLGERR:01' => 'Versuch ung??ltiges Plugin zu registrieren: : ',
	'XJXPM:IPLGERR:02' => ' Ableitung von xajaxRequestPlugin oder xajaxResponsePlugin erwartet.',
	'XJXPM:MRMERR:01' => 'Konnte die Registrierungsmethode nicht finden f??r: : ',
	'XJXRSP:EDERR:01' => 'Die Angabe der Zeichensatzkodierung in der xajaxResponse ist veraltet. Die neue Funktion lautet: $xajax->configure("characterEncoding", ...);',
	'XJXRSP:MPERR:01' => 'Ung??ltiger oder fehlender Pluginname festgestellt im Aufruf von xajaxResponse::plugin',
	'XJXRSP:CPERR:01' => "Der Parameter \$sType in addCreate ist veraltet.  Die neue Funktion lautet addCreateInput()",
	'XJXRSP:LCERR:01' => "Das xajax response Objeckt konnte die Befehler nich verarbeiten, da kein g??ltiges Array ??bergeben wurde.",
	'XJXRSP:AKERR:01' => 'Ung??ltiger Tag-Name im Array.',
	'XJXRSP:IEAERR:01' => 'Ungeeignet kodiertes Array.',
	'XJXRSP:NEAERR:01' => 'Nicht kodiertes Array festgestellt.',
	'XJXRSP:MBEERR:01' => 'Die Ausgabe vonn xajax response konnte nicht in htmlentities umgewandelt werden, da die Funktion mb_convert_encoding nicht verf??gbar ist.',
	'XJXRSP:MXRTERR' => 'Fehler: Kann keine verschiedenen Typen in einer einzelnen Antwort verarbeiten.',
	'XJXRSP:MXCTERR' => 'Fehler: Kann keine verschiedenen Content-Types in einer einzelnen Antwort verarbeiten.',
	'XJXRSP:MXCEERR' => 'Fehler: Kann keine verschiedenen Zeichensatzkodierungen in einer einzelnen Antwort verarbeiten.',
	'XJXRSP:MXOEERR' => 'Fehler: Kann keine output entities (true/false) in ener einzelnen Antwort verarbeiten.',
	'XJXRM:IRERR' => 'Ung??ltige Antwort erhalten w??hrend der Ausf??hrung der Anfrage.',
	'XJXRM:MXRTERR' => 'Fehler: Kann kkeine verschiedenen reponse types benutzen w??hrend der Ausf??hrung einer Anfrage: '
	));

//EndSkipAIO