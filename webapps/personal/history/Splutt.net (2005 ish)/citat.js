
function visa_texten()
{
i=0;
text = new Array();
text[i++] = "<CENTER><B>Millhouse:</B><hr>My mom says I'm cool.</CENTER>";
text[i++] = "<CENTER><B>Pablo Roberto:</B><hr>Det är en helt annan sak att boxas med någon i \"ringen\", som egentligen är en fyrkant.</CENTER>";
text[i++] = "<CENTER><B>Anonym:</B><hr>Orgie, är inte det en såndär i Sagan om ringen?</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Gamla stjärnor minns man bättre än de som ännu inte blivit stjärnor...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>I en sånhär match är det till och med glädje att vara boll...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Båda lagen spelar i nummerärt underläge...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Jag tror på teorin att om motståndarna gör mål måste vi göra två mål för att vinna.</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Detta har varit en morot för oss alla, och nu har den släckts...</CENTER>";
text[i++] = "<CENTER><B>Sportcitat:</B><hr>Går den in så får Thorsvedt svårt att ta den...</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Patienten ligger på britsen, påverkad av ont.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Patienten har mått relativt bra i gipset...</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Poängterar att det är viktigt att patienten håller sig ren mellan fötterna.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Smärta i ryggen kommer när patienten ligger raklång med båda benen på rygg.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Patienten tycker att höger stortå hänger ner något jämfört med de andra fingrarna.</CENTER>";
text[i++] = "<CENTER><B>Spray support:</B><hr>Det blir bara stjärnor när jag skall skriva in lösenordet...</CENTER>";
text[i++] = "<CENTER><B>Bill Gates 1981:</B><hr>640 kilobyte borde räcka för vem som helst.</CENTER>";
text[i++] = "<CENTER><B>Sjukhuset:</B><hr>Liten knöl på höger sida om vänster skalle.</CENTER>";
text[i++] = "<CENTER><B>Homer:</B><hr>Heh Heh Heh! Lisa! Vampyrer är bara påhittade, precis som älvor, troll och eskimåer.</CENTER>";
document.write(text[Math.floor(Math.random()*text.length)]);
}

