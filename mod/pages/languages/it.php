<?php
return array(

	/**
	 * Menu items and titles
	 */

	'pages' => "Pagine",
	'pages:owner' => "Pagine di %s",
	'pages:friends' => "Pagine degli amici",
	'pages:all' => "Tutte le pagine",
	'pages:add' => "Aggiungi pagina",

	'pages:group' => "Pagine del gruppo",
	'groups:enablepages' => 'Abilita pagine del gruppo',

	'pages:new' => "Nuova pagina",
	'pages:edit' => "Modifica questa pagina",
	'pages:delete' => "Cancella questa pagina",
	'pages:history' => "Cronologia della pagina",
	'pages:view' => "Visualizza pagina",
	'pages:revision' => "Revisione",

	'pages:navigation' => "Navigazione della pagina",

	'pages:notify:summary' => 'Nuova pagina %s',
	'pages:notify:subject' => "Nuova pagina: %s",
	'pages:notify:body' =>
'%s ha aggiunto una nuova pagina: %s

%s

Visualizza e commenta questa pagina:
%s',
	'item:object:page' => 'Pagine',
	'pages:more' => 'Tutte le pagine',
	'pages:none' => 'Ancora nessuna pagina creata',

	/**
	* River
	**/

	'river:object:page:create' => '%s ha creato la pagina %s',
	'river:object:page:update' => '%s ha aggiornato la pagina %s',
	'river:object:page:comment' => '%s ha commentato la pagina dal titolo %s',
	
	/**
	 * Form fields
	 */

	'pages:title' => 'Titolo della pagina',
	'pages:description' => 'Testo della tua pagina',
	'pages:tags' => 'Tag',
	'pages:parent_guid' => 'Pagina madre',
	'pages:access_id' => 'Accesso',
	'pages:write_access_id' => 'Diritto di scrittura',

	/**
	 * Status and error messages
	 */
	'pages:cantedit' => 'Non puoi modificare questa pagina',
	'pages:saved' => 'Pagina salvata',
	'pages:notsaved' => 'La pagina non può essare salvata',
	'pages:error:no_title' => 'Devi specificare un titolo per questa pagina',
	'pages:delete:success' => 'La tua pagina è stata cancellata con successo.',
	'pages:delete:failure' => 'La pagina non può rimossa.',
	'pages:revision:delete:success' => 'Revisione pagina cancellata con successo',
	'pages:revision:delete:failure' => 'La revisione della pagina non è stata cancellata',

	/**
	 * History
	 */
	'pages:revision:subtitle' => 'Revisione creata %s da %s',

	/**
	 * Widget
	 **/

	'pages:num' => 'Numero di pagine da visualizzare',
	'pages:widget:description' => "Visualizza alcunde delle tue pagine.",

	/**
	 * Submenu items
	 */
	'pages:label:view' => "Vedi pagina",
	'pages:label:edit' => "Modifica pagina",
	'pages:label:history' => "Cronologia della pagina",

	'pages:newchild' => "Crea una sotto-pagina",
	
	/**
	 * Upgrades
	 */
	'pages:upgrade:2017110700:title' => "Migra page_top a page entities",
	'pages:upgrade:2017110700:description' => "Cambia il sottotipo di tutte le 'pagine top' in 'pagina' e imposta i metadati per assicurare un'elencazione corretta.",
	
	'pages:upgrade:2017110701:title' => "Migra gli inserimenti sul river delle page_top",
	'pages:upgrade:2017110701:description' => "Cambia il sottotipo di tutti gli elementi del river per le 'Pagine top' in 'pagina'",
);
