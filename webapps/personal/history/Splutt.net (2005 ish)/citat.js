
function visa_texten()
{
i=0;
text = new Array();
text[i++] = "<CENTER><B>Millhouse:</B><hr>My mom says I'm cool.</CENTER>";
text[i++] = "<CENTER><B>Pablo Roberto:</B><hr>Det �r en helt annan sak att boxas med n�gon i \"ringen\", som egentligen �r en fyrkant.</CENTER>";
text[i++] = "<CENTER><B>Anonym:</B><hr>Orgie, �r inte det en s�nd�r i Sagan om ringen?</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Gamla stj�rnor minns man b�ttre �n de som �nnu inte blivit stj�rnor...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>I en s�nh�r match �r det till och med gl�dje att vara boll...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>B�da lagen spelar i nummer�rt underl�ge...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Jag tror p� teorin att om motst�ndarna g�r m�l m�ste vi g�ra tv� m�l f�r att vinna.</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Detta har varit en morot f�r oss alla, och nu har den sl�ckts...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>G�r den in s� f�r Thorsvedt sv�rt att ta den...</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Patienten ligger p� britsen, p�verkad av ont.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Patienten har m�tt relativt bra i gipset...</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Po�ngterar att det �r viktigt att patienten h�ller sig ren mellan f�tterna.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Sm�rta i ryggen kommer n�r patienten ligger rakl�ng med b�da benen p� rygg.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Patienten tycker att h�ger stort� h�nger ner n�got j�mf�rt med de andra fingrarna.</CENTER>";
text[i++] = "<CENTER><B>Spray support:</B><hr>Det blir bara stj�rnor n�r jag skall skriva in l�senordet...</CENTER>";
text[i++] = "<CENTER><B>Bill Gates 1981:</B><hr>640 kilobyte borde r�cka f�r vem som helst.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Liten kn�l p� h�ger sida om v�nster skalle.</CENTER>";
text[i++] = "<CENTER><B>Homer:</B><hr>Heh Heh Heh! Lisa! Vampyrer �r bara p�hittade, precis som �lvor, troll och eskim�er.</CENTER>";
document.write(text[Math.floor(Math.random()*text.length)]);
}

