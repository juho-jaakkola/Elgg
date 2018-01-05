<?php

return array(
	'discussion' => 'Forum',
	'discussion:add' => 'Aggiungi argomento',
	'discussion:latest' => 'Ultimi argomenti',
	'discussion:group' => 'Forum di gruppo',
	'discussion:none' => 'Nessuna discussione',
	'discussion:updated' => "Ultima risposta di %s %s",

	'discussion:topic:created' => 'L\'argomento è stato creato.',
	'discussion:topic:updated' => 'L\'argomento è stato aggiornato.',
	'discussion:topic:deleted' => 'L\'argomento è stato eliminato.',

	'discussion:topic:notfound' => 'Argomento non trovato.',
	'discussion:error:notsaved' => 'Impossibile salvare questo argomento',
	'discussion:error:missing' => 'Sia il titolo sia il messaggio sono campi obbligatori',
	'discussion:error:permissions' => 'Permessi insufficienti per completare questa azione',
	'discussion:error:notdeleted' => 'Impossibile eliminare l\'argomento',

	/**
	 * River
	 */
	'river:object:discussion:create' => '%s ha aggiunto un nuovo argomento di discussione %s',
	'river:object:discussion:comment' => '%s ha commentato la discussione %s',
	
	/**
	 * Notifications
	 */
	'discussion:topic:notify:summary' => 'Nuovo argomento di discussione: %s',
	'discussion:topic:notify:subject' => 'Nuovo argomento di discussione: %s',
	'discussion:topic:notify:body' =>
'%s ha aggiunto un nuovo argomento di discussione: %s

%s

Visualizza e rispondi qui:

%s
',

	'discussion:comment:notify:summary' => 'Nuovo commento all\'argomento: %s',
	'discussion:comment:notify:subject' => 'Nuovo commento all\'argomento: %s',
	'discussion:comment:notify:body' =>
'%s ha commentato l\'argomento "%s";

%s

Guarda e commenta la discussione:
%s',

	'item:object:discussion' => "Argomenti di discussione",

	'groups:enableforum' => 'Abilita discussioni di gruppo',

	/**
	 * Discussion status
	 */
	'discussion:topic:status' => 'Stato dell\'argomento',
	'discussion:topic:closed:title' => 'Questa discussione è chiusa',
	'discussion:topic:closed:desc' => 'Questa discussione è chiusa e non accetta nuovi commenti',

	'discussion:addtopic' => 'Aggiungi un argomento',
	'discussion:topic:edit' => 'Modifica argomento',
	'discussion:topic:description' => 'Messaggio dell\'argomento',

	// upgrades
	'discussions:upgrade:2017112800:title' => "Converti le risposte alle discussioni in commenti",
	'discussions:upgrade:2017112800:description' => "Le risposte alle discussioni erano dei sottotipi a parte che ora sono stati uniformati ai commenti",
	'discussions:upgrade:2017112801:title' => "Migra le risposte alle discussioni sul river",
	'discussions:upgrade:2017112801:description' => "Le risposte alle discussioni erano dei sottotipi a parte che ora sono stati uniformati ai commenti",
);
