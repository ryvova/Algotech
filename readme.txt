Poznámky:
1. Algoritmus pro převod desetinného čísla na zlomek by měl dle Binga jít napsat i pomocí největšího společného
   dělitele, ale to mi nefunguje a nemám chuť hledat, kde je problém, když to dělám zadarmo. Patrně by to bylo i
   efektivnější než cykly.
2. Co se týče coding standardu, tak dle Vaší ukázky to vypadá, že komentáře, typehinty apod. jsou nežádoucí.
   Jestli mají být závorky na stejném řádku nebo na novém, odsazení apod. se dá v PHPStormu řešit snadno nadefinováním
   pravidel. Ve Sportisimu jsme měli nějaká nadefinovaná nějaká pravidla a kromě toho jsme si mohli klidně nadefinovat
   svoje, aby člověk kód viděl tak jak mu to vyhovuje a před pushnutím do gitu zmáčknout nějakou klávesovou kombinaci,
   která to přeformátovala podle firemního coding standardu, aby byl spokojen šéf. Vlk (šéf) se nažral (v gitu to měl
   dle svého standardu) a koza zůstala celá (programátor si mohl pracovat na lokále podle svého standardu, který si
   nadefinoval). Fungovalo to zcela bez problémů. Považuji za nesmysl tohle testovat u pohovoru - předpokládám,
   že máte pro PHPStorm definovaný nějaký standard, který si programátor do něj nahraje a pak to stisknutím nějaké
   klávesové kombinace přeformátuje.
3. Otázka je, co je základní tvar u Smíšeného zlomku (předpokládám, že zápis 1 1/3) a co se má stát, když do Zlomku
   pošlu třeba 4/3) a jestli čísla, která lezou do operací mohou být i desetinná nebo jen celá. Jelikož jsem nedostala
   odpovědi ani na ty předchozí dotazy, které jsem psala, tak jsem usoudila, že bych asi nedostala odpověď ani na tyto,
   proto jsem si nadefinovala, že Zlomek musí mít čitatele menšího než jmenovatele, jinak to vyhodí exceptionu,
   že se má použít smíšený zlomek a do operací mohou lézt i desetinná čísla (ta se převedou na zlomek).
4. Vše je projeto pomocí PHPStanu level 9.
5. Z návrhových vzorů je použit Singleton v Operation a Factory ve FractionFactory.
   Factory pozná podle vstupních parametrů, zda má vytvořit instanci třídy Zlomek nebo Smíšený zlomek.
   Singleton nemám ráda, protože pokud se má důsledně ošetřit, aby fakt nešla vytvořit druhá instance ani při spuštění
   více vláken, tak je to dost pracné a časově náročné a z původního jednoduchoučkého návrhového vzoru se stává
   podstatně složitější a méně efektivní. Použila jsem ho jen proto, abyste viděli, že vím, že něco takového existuje.
6. Jelikož jsem se nedočkala odpovědi na dotaz, zda "neveřejné" = privátní nebo to může být i protected, tak jsem
   zvolila tu horší variantu privátní, což znemožňuje dědičnost :-(. A abych se nemusela psát 2x s metodou reduce(),
   která má být privátní a ve Smíšeném zlomku je jen upravená reduce() ze Zlomku, tak jsem ji hodila do traity, i
   když dědičnost by dle mne byla mnohem lepší řešení (traity jsme ve Sportisimu měli dokonce výslovně zakázané
   používat).