<SCRIPT LANGUAGE="javascript">
<!--This is one of many scripts which are available at:     *---
//--http://www.JavaScript.nu/javascript                     *---
//--This script is FREE, but you MUST let these lines       *---
//--remain if you use this script.                          *---

//***---Om du har frames: Om du vill att sidan man ska komma till ska öppnas i samma ram som sidan med scriptet så ska det stå "self" nedan. Ska sidan öppnas i helskärm ska det stå "top". Ska sidan däremot öppnas i en speciell frame så ska du skriva in framens namn i fältet. Har du inte frames (eller inte vet vad det är) så ska det stå "self" i här.
fonster="self"

//***---Ange vilka sidor man ska komma till beroende på vilken webbläsare man har
nn2="index.php?visa=ff";
nn3="index.php?visa=ff";
nn4="index.php?visa=ff";
nn6="index.php?visa=ff";
nn="index.php?visa=ff";
ie3="index.php?visa=spelIE";
ie4="index.php?visa=spelIE";
ie5="index.php?visa=spelIE";
ie6="index.php?visa=spelIE";
ie="index.php?visa=spelIE";
op3="index.php?visa=ff";
op5="index.php?visa=ff";
op="index.php?visa=ff";
annan="index.php?visa=ff";


if (fonster!="self" && fonster!="top")
{
fonster="parent."+fonster;
}
if (fonster=="")
{
fonster="self"
}

JSv=parseInt(navigator.appVersion)
JSw=navigator.appName
function geWebblasare()
{
	if (navigator.userAgent.indexOf("Opera") != -1)
	{
		if (navigator.userAgent.indexOf("Opera/3") != -1)
			return op3;
		else if (navigator.userAgent.indexOf("Opera 5") != -1)
			return op5;
		else
			return op;
	}
	if (JSw=="Netscape")
	{
		if (JSv==2)
			return nn2;
		else if (JSv==3)
			return nn3;
		else if (JSv==4)
			return nn4;
		else if (JSv==5)
			return nn6;
		else
			return nn;
	}
	else if (JSw=="Microsoft Internet Explorer")
	{
		if (JSv==2)
			return ie3;
		else if (navigator.appVersion.indexOf("MSIE 4") != -1)
			return ie4;
		else if (navigator.appVersion.indexOf("MSIE 5") != -1)
			return ie5;
		else if (navigator.appVersion.indexOf("MSIE 6") != -1)
			return ie6;
		else
			return ie;
	}
	else
		return annan;
}

eval(fonster+".location.href='"+geWebblasare()+"';");
//-->
</SCRIPT>