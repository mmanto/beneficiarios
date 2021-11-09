<? if ($familia["Familia_matricula"] != '0') {?><img src="imagen/escrit-ico.jpg" /><? }else{ ?>
        <? if ($familia["Expte_esc_condicion"] == '3') {?><img src="imagen/escrit-anul-ico.jpg" /><? }else{ ?>
		<? if ($familia["Expte_esc_nro"] != '0') {?>&nbsp;<img src="imagen/tramitesc-ico.jpg" /><? } ?>
		<? if ($familia["Familia_cond_escrit"] == '1') {?>&nbsp;<img src="imagen/gescrit-ico.jpg" /><? } ?>
        <? if ($familia["blnBoleto"] == '1') {?>&nbsp;<img src="imagen/boleto-ico.jpg" /><? } ?>
        <? if ($familia["Familia_censo_ausente"] != '0') {?>&nbsp;<img src="imagen/ausente-ico.jpg" /> <? } ?>
        <? if ($familia["Familia_tarjeta_solicitar"] != '0') {?>&nbsp;<img src="imagen/tarjeta-solic-ico.jpg" /> <? } ?>
		<? if ($familia["Familia_ocupacion_verificar"] != '0') {?>&nbsp;<img src="imagen/verif.png" /> <? } ?>
		<? if ($familia["Adjudicacion_pendiente"] == '1') {?>&nbsp;<img src="imagen/adj-pendiente-ico.jpg" /><? } ?>
        <? if ($familia["Familia_conflicto"] == '1') {?>&nbsp;<img src="imagen/conflicto-ico.jpg" /><? } ?>
        <? if ($familia["Familia_pagocancelado"] == '1') {?>&nbsp;<img src="imagen/pagoscancelados.jpg" width="16" height="16" /><? } ?>
		<? if ($familia["Familia_doc_completa"] != '1') {?>&nbsp;<img src="imagen/faltadoc-ico.jpg" /><? } ?><? }} ?>