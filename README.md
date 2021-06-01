# Progetto_PHP
Creazione social network "Cesiogram"

Angelica Della Vecchia 1746294

Simone Orelli 1749732

PHP Rappresentativo 

Indirizzo del repository su Github: https://github.com/Cesio-organizzazione-di/Progetto_PHP

Indirizzo server Simone Orelli: http://lweb.dis.uniroma1.it/~lweb9/simone.orelli.PHP2/

Indirizzo server Angelica Della Vecchia: http://lweb.dis.uniroma1.it/~lweb18/angelica.dellavecchia.PHP2/

Il presente esercizio è una variante dell'esercizio carrello.della.spesa3.php, sulla slide 6, quindi è del tipo PHP-MySQL.
In particolare, esso rappresenta un social network (Cesiogram) nel quale è anche possibile effettuare acquisti.

Il database è composto da 3 tabelle:
-Users: contiene gli utenti iscritti a Cesiogram. Ogni record contiene i seguenti attributi: username (chiave primaria), password, nome, cognome, dataNascita, email, sesso, professione, 	sommeSpese, bio. 
-Posts: contiene i post e le recensioni pubblicati dagli utenti sulla home di Cesiogram. Ogni record contiene i seguenti attributi: postId (interno autoincrementativo-chiave primaria), 		user(chiave esterna), testo.
-Prodotti: contiene i prodotti presenti all'interno dello shop. I suoi attributi sono: prodottiID(interno autoincrementativo-chiave primaria), nome, costo.

Le tabelle Posts e Users sono legate dalla relazione: 
Users 1:n Posts -> Ad ogni utente possono essere associati più post e un post è associato ad un solo utente.


Esso è composto da 17 file php: 

- origine.php: (primo file da aprire) adibito alla creazione delle tabelle e alla loro popolazione con due account: username: xrushofblood password: 1234,username: simonemessi password: 5678 e un post per ogni account, visibile nella homepage. Inoltre vi è l'inserimento di 9 prodotti visibili nello shop.
									                                        
- connessione.php: effettua la connessione a due tabelle del db (Users e Prodotti)
- connessione1.php: effettua la connessione a tutte e 3 le tabelle del db. 
 Tali script vengono chiamati in altri script tramite require_once().

- signup.php: documento utile per inserire manualmente un nuovo record nella tabella users, ossia rappresenta la pagina di iscrizione a Cesiogram. 
             Dopo aver effettuato la connessione al db, viene eseguita una query di inserimento (INSERT INTO) dove i valori degli attributi vengono presi tramite input. 
- login.php: pagina in cui si effettua la query di tipo SELECT che restituisce la riga della tabella Users che ha per username e password quelli inseriti in input. Tale riga sarà unica 	    	    poichè username è chiave primaria.
	    Se c'è corrispondenza viene aperta una sessione nella quale vengono inizializzati i dati dell'utente mediante la variabile d'ambiente $_SESSION[] e si viene reindirizzati alla 		    pagina iniziale del sito; altrimenti, viene stampato un messaggio d'errore;

- inizio.php: Rappresenta la home del sito. Per la pagina è stato scelto un layout a tre colonne (holy grail): a sinistra compare il menu fisso, al centro compare una text area per inserire 	     	     il proprio post e i post inseriti da tutti gli utenti, a destra compaiono le informazioni personali dell'utente. In particolare, compare anche l'importo totale speso sulla 	    	     piattaforma salvato nella variabile $_SESSION['spesaFinora'].
	     La stampa dei post avviene tramite una query SELECT * dalla tabella Posts, in ordine decrescente. Tramite la funzione mysqli_fetch_array(), chiamata all'interno di un ciclo 	   	     while, è possibile scandire ogni singola riga per stamparla. Se il post è stato pubblicato dall'utente la cui sessione è attualmente attiva, esso viene stampato insieme ad una 	    	     'x' rossa in alto a destra. Ciò vuol dire che ogni utente può eliminare i propri post dal db e quindi dalla home(ma non quelli degli altri). L'eliminazione corrisponde alla 	     	     action elimina_post.php all'interno di una form. Il caricamento del post all'interno del db avviene in modo analogo all'eliminazione, ma la action attivata nella form è 	     	     	     carica_post.php;
	     
- shop.php: Dal menù sulla sinistra è possibile accedere allo shop mediante l'omonimo link. Il menu visualizzato nello shop contiene anche la voce "Il tuo carrello". In questa pagina, si ha 	   	   la possibilità di inserire all'interno del proprio carrello ($_SESSION	  	   ['carrello']) i prodotti presenti. Ogni prodotto viene stampato effettuando una query di		   tipo SELECT * dalla tabella Prodotti. Tramite la funzione mysqli_fetch_array(), chiamata 	           all'interno di un ciclo while, è possibile scandire ogni singola riga per 	           stamparla. 
	   La form viene attivata tramite il bottone "Aggiungi al carrello" con action $_SERVER['PHP_SELF']. Sono presenti anche i bottoni di reindirizzamento "Vai al carrello" e "Vai al 		   pagamento"; 

- carrello.php: Vengono visualizzati i prodotti presenti nella variabile $_SESSION['carrello'] sottoforma di input di tipo checkbox. I prodotti selezionati possono essere eliminati tramite 	               il bottone che attiva la action della form. Inoltre, è possibile svuotare completamente il carrello, inizializzando la fariabile &_SESSION['carrello'] = array().
	       Sono presenti i pulsanti di indirizzamento "Continua gli acquisti" e "Vai al pagamento". 
	       Si noti che in questa pagina non vengono apportate modifiche al database, ma solo alle variabili di sessione;

- riepilogo.php: Vengono mostrati i prodotti presenti nel carrello e che si vuole acquistare, con il rispettivo prezzo e il totale da pagare. In questa pagina non è possibile effettuare 		modifiche sul carrello. Se si arriva in questa pagina col carrello vuoto, viene mostrato solo il bottone "Continua gli acquisti"; altrimenti è presente anche il bottone 		"Procedi con il pagamento";

- pagamento.php: Vengono aggiornate le variabili di sessione $_SESSION['carrello'] (viene svuotata), $_SESSION['da pagare'] (viene riportata a 0) e $_SESSION['spesaFinora'] (viene 		incrementata del totale pagato ad ogni acquisto effettuato). Con una variabile d'appoggio $tot, viene aggiornata la voce sommeSpese nel database, impostandola a 
		$_SESSION['daPagare']+ $_SESSION['spesaFinora']. Questa pagina rappresenta l'acquisto effettuato e vi è la possibilità di lasciare una recensione sui prodotti acquistati, la 		quale verrà stampata in inizio.php.

- carica_post.php: Permette di inserire un nuovo record all'interno della tabella Posts tramite la query INSERT INTO. Questo script viene invocato ogni volta che c'è una textarea all'interno 			 di una form con action carica_post. Alla fine dello script, tramite header(Location:inizio.php) si viene reindirizzati alla home;

- elimina_post.php: Funzionamento analogo a carica_post.php, solo che viene effettuata l'eliminazione di un record dalla tabella post tramite la query DELETE FROM;

- logout.php: viene effettuata la chiusura dell'attuale sessione. Da qui è possibile tornare alla pagina login.php tramite un link;

- menu_home.php: Menu visibile in inizio.php e in carrello.php;
- menu_shop.php: Menu visibile in tutti gli altri script;
- style.php: Script che inizializza una variabile $stile con le regole CSS da applicare a origine.php, login.php e logout.php;
- stile_interno.php: Script in cui si definisce una variabile $stileInterno con le regole CSS da applicare agli altri documenti.

Questi ultimi 4 file vengono richiamati all'interno dei diversi documenti tramite la funzione require_once(). Gli stili vengono applicati stampando nella head la variabile definita nell'apposito script.
