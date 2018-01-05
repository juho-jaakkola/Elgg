<?php
return array(

	/**
	 * Menu items and titles
	 */
	'groups' => "Gruppi",
	'groups:owned' => "Gruppi creati da te",
	'groups:owned:user' => 'Gruppi di %s',
	'groups:yours' => "I gruppi a cui partecipi",
	'groups:user' => "Gruppi di %s",
	'groups:all' => "Tutti i gruppi",
	'groups:add' => "Crea un nuovo gruppo",
	'groups:edit' => "Modifica gruppo",
	'groups:delete' => 'Cancella gruppo',
	'groups:membershiprequests' => 'Gestisci richieste di adesione',
	'groups:membershiprequests:pending' => 'Gestisci richieste di adesione (%s)',
	'groups:invitations' => 'Gruppi a cui sei invitato',
	'groups:invitations:pending' => 'Inviti al gruppo (%s)',

	'groups:icon' => 'Icona del gruppo (lascia vuoto per tenerla invariata)',
	'groups:name' => 'Nome del gruppo',
	'groups:description' => 'Descrizione',
	'groups:briefdescription' => 'Breve descrizione',
	'groups:interests' => 'Tag',
	'groups:website' => 'Sito web',
	'groups:members' => 'Membri del gruppo',

	'groups:members:title' => 'Membri di %s',
	'groups:members:more' => "Visualizza tutti i membri",
	'groups:membership' => "Autorizzazioni dei membri del gruppo",
	'groups:content_access_mode' => "Accessibilità dei contenuti del gruppo",
	'groups:content_access_mode:warning' => "Attenzione: cambiando questa impostazione non cambierà i permessi di accesso dei contenuti del gruppo esistenti ma solo dei nuovi",
	'groups:content_access_mode:unrestricted' => "Liberi - L'accesso dipenderà dalle impostazioni di accesso del singolo contenuto",
	'groups:content_access_mode:membersonly' => "Solo membri - I non membri del gruppo non potranno mai accedere ai suoi contenuti",
	'groups:access' => "Autorizzazioni di accesso",
	'groups:owner' => "Coordinatore",
	'groups:owner:warning' => "Attenzione: con questa modifica non sarai più il moderatore del gruppo",
	'groups:widget:num_display' => 'Numero di gruppi da visualizzare',
	'groups:widget:membership' => 'Gruppi cui aderisci',
	'groups:widgets:description' => 'Visualizza alcuni dei gruppi di cui sei membro',

	'groups:noaccess' => 'Nessun accesso al gruppo',
	'groups:cantcreate' => 'Non puoi creare un gruppo. Funzione riservata agli amministratori',
	'groups:cantedit' => 'Non puoi modificare questo gruppo',
	'groups:saved' => 'Gruppo salvato',
	'groups:save_error' => 'Non è stato possibile salvare il gruppo',
	'groups:featured' => 'Gruppi in primo piano',
	'groups:makeunfeatured' => 'Non in primo piano',
	'groups:makefeatured' => 'Porta in primo piano',
	'groups:featuredon' => '%s ora è un gruppo in evidenza',
	'groups:unfeatured' => '%s è stato rimosso dai gruppi in evidenza',
	'groups:featured_error' => 'Gruppo non valido',
	'groups:nofeatured' => 'Nessun gruppo in evidenza',
	'groups:joinrequest' => 'Richiedi adesione',
	'groups:join' => 'Partecipa al gruppo',
	'groups:leave' => 'Abbandona il gruppo',
	'groups:invite' => 'Invita i tuoi amici',
	'groups:invite:title' => 'Invita amici a questo gruppo',
	'groups:invite:friends:help' => 'Cerca un amico usando il nome o il nome utente e selezionalo dall\'elenco',
	'groups:invite:resend' => 'Reinvia gli inviti agli utenti già invitati',

	'groups:nofriendsatall' => 'Non hai amici da invitare',
	'groups:group' => "Gruppo",
	'groups:search:tags' => "tag",
	'groups:search:title' => "Cerca gruppi taggati con '%s'",
	'groups:search:none' => "Nessun gruppo corrispondente trovato",
	'groups:search_in_group' => "Cerca in questo gruppo",
	'groups:acl' => "Gruppo: %s",
	'groups:acl:in_context' => 'Membri del gruppo',

	'groups:activity' => "Attività del gruppo",
	'groups:enableactivity' => 'Abilita attività del gruppo',
	'groups:activity:none' => "Non ci sono ancora attività del gruppo",

	'groups:notfound' => "Gruppo non trovato",
	
	'groups:requests:none' => 'Non ci sono richieste di iscrizione in sospeso in questo momento.',

	'groups:invitations:none' => 'Non ci sono inviti in sospeso in questo momento.',

	'groups:open' => "gruppo aperto",
	'groups:closed' => "gruppo chiuso",
	'groups:member' => "membri",
	'groups:search' => "Cerca gruppi",

	'groups:more' => 'Altri gruppi',
	'groups:none' => 'Nessun gruppo',

	/**
	 * Access
	 */
	'groups:access:private' => 'Chiuso - Gli utenti devono essere invitati',
	'groups:access:public' => 'Aperto - Tutti gli utenti possono partecipare',
	'groups:access:group' => 'Solo membri del gruppo',
	'groups:closedgroup' => "Questo è un gruppo privato. Per chiedere di partecipare, clicca su \"Richiedi adesione\".",
	'groups:closedgroup:request' => 'Per chiedere di aderire al gruppo clicca sul relativo link',
	'groups:closedgroup:membersonly' => "L'adesione a questo gruppo è possibile su invito ed i suoi contenuti sono accessibili solo dai membri.",
	'groups:opengroup:membersonly' => "I contenuti di questo gruppo sono accessibili solo dai suoi membri",
	'groups:opengroup:membersonly:join' => 'Per partecipare al gruppo clicca su "Aderisci al gruppo"',
	'groups:visibility' => 'Chi può vedere questo gruppo?',

	/**
	 * Group tools
	 */

	'admin:groups' => 'Groups',

	'groups:notitle' => 'Il gruppo deve avere un titolo',
	'groups:cantjoin' => 'Non puoi partecipare al gruppo',
	'groups:cantleave' => 'Non puoi abbandonare il gruppo',
	'groups:removeuser' => 'Rimuovi dal gruppo',
	'groups:cantremove' => 'Non è stato possibile rimuovere il membro dal gruppo',
	'groups:removed' => '%s rimosso dal gruppo',
	'groups:addedtogroup' => 'L\'utente è stato aggiunto al gruppo con successo',
	'groups:joinrequestnotmade' => 'La richiesta di partecipazione non può essere effettuata',
	'groups:joinrequestmade' => 'La richiesta di partecipazione al gruppo è avvenuta con successo',
	'groups:joinrequest:exists' => 'Hai già richiesto l\'adesione a questo gruppo',
	'groups:button:joined' => 'Hai aderito',
	'groups:button:owned' => 'Di tua proprietà',
	'groups:joined' => 'Hai aderito al gruppo con successo!',
	'groups:left' => 'Hai abbandonato il gruppo con successo!',
	'groups:userinvited' => 'L\'utente è stato invitato.',
	'groups:usernotinvited' => 'L\'utente non può essere invitato.',
	'groups:useralreadyinvited' => 'L\'utente è già stato invitato',
	'groups:invite:subject' => "%s sei stato invitato a unirti a %s!",
	'groups:joinrequest:remove:check' => 'Sei sicuro di voler annullare questa richiesta di adesione?',
	'groups:invite:remove:check' => 'Sei sicuro di voler annullare questo invito?',
	'groups:invite:body' => "Ciao %s,

%s ti ha invitato a partecipare al gruppo '%s'. Clicca sotto per vedere il tuo invito:

%s",

	'groups:welcome:subject' => "Benvenuto/a nel gruppo %s!",
	'groups:welcome:body' => "Ciao %s!

Sei ora un membro del gruppo  '%s'! Clicca qui sotto per iniziare a pubblicare!

%s",

	'groups:request:subject' => "%s ha richiesto di unirsi a %s",
	'groups:request:body' => "Ciao %s,

%s ha richiesto di unirsi al gruppo '%s', clicca qui sotto per vedere il suo profilo:

%s

o clicca qui sotto per vedere le richieste di adesione al gruppo:

%s",

	'river:group:create' => '%s ha creato il gruppo %s',
	'river:group:join' => '%s ha aderito al gruppo %s',

	'groups:allowhiddengroups' => 'Vuoi permettere gruppi privati (invisibili)?',
	'groups:whocancreate' => 'Chi può creare nuovi gruppi?',
	'groups:allow_activity' => 'Abilitare le pagine attività nei gruppi?',

	/**
	 * Action messages
	 */
	'groups:deleted' => 'Gruppo e contenuti del gruppo eliminati',
	'groups:notdeleted' => 'Non è stato possibile eliminare il gruppo',
	'groups:deletewarning' => "Sei sicuro di voler eliminare questo gruppo? Questa azione non può essere annullata!",

	'groups:invitekilled' => 'L\'invito è stato cancellato.',
	'groups:joinrequestkilled' => 'La richiesta di adesione è stata cancellata.',
	'groups:error:addedtogroup' => "Non è stato possibile aggiungere %s al gruppo",
	'groups:add:alreadymember' => "%s è già membro di questo gruppo",

	/**
	 * ecml
	 */
	'groups:ecml:groupprofile' => 'Profili del gruppo',

	/**
	 * Upgrades
	 */
	'groups:upgrade:2016101900:title' => 'Trasferisci le icone del gruppo in una nuova posizione',
	'groups:upgrade:2016101900:description' => '
		La nuova API per l\'icona delle entità salva le icone in posizioni prevedibili nel filestore
		relativa alla cartella filestore dell\'entità. Questo aggiornamento allinea
		allineerà il plugin gruppi con le specifiche della nuova API
',
);
