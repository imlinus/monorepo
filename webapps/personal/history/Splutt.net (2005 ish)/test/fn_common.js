if (document.all){
	document.onmousedown = fixUglyIE;
}

function fixUglyIE(){
	for (a in document.links) document.links[a].onfocus = document.links[a].blur;
}


function visatid(){
	var nu = new Date();
	timme = nu.getHours();
	minut = nu.getMinutes();
	sekund = nu.getSeconds();
	ar = nu.getYear();
	
	if (timme < 10){timme = "0"+timme;}
	if (minut < 10){minut = "0"+minut;}
	if (sekund < 10){sekund = "0"+sekund;}
	if (ar < 1900){ar += 1900;}
	
	var veckodag = new Array("S&ouml;n","M&aring;n","Tis","Ons","Tors","Fre","L&ouml;r");
	var mannamn=new Array("Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December");

	str=(veckodag[nu.getDay()]+"dagen den ");
	str+=(nu.getDate()+" ");
	str+=(mannamn[nu.getMonth()]+" ");
	str+=(ar+", ");
		
	str += (timme+":"+minut+":"+sekund);

	if (!document.all){
	  document.write(str);
	}

	else{
		 klockan.innerHTML=str;
	}
}	

function ConfirmDelete(DeleteThis){
	return confirm("Vill du ta bort "+DeleteThis+"?");
}


function OpenWin(openURL,WinWidth,WinHeight,strTargetName){
	var toppen,vanster,NewWin;
	toppen=(screen.height-450)/2;
	vanster=(screen.width-540)/2;
	if(!WinWidth){WinWidth=540;}
	if(!WinHeight){WinHeight=410;}
	if(!strTargetName){strTargetName='NewWin'}
	
	NewWin=window.open (openURL,strTargetName,'location=no,menubar=no,directories=no,scrollbars=auto,resizable=no,status=no,width='+WinWidth+',height='+WinHeight+',left='+vanster+',top='+toppen);
}

function FaqSvar(qid){
	var toppen,vanster,NewWin;
	toppen=(screen.height-250)/2;
	vanster=(screen.width-300)/2;
	
	NewWin=window.open ('faq-svar.asp?qid='+qid,'NewWin','location=no,menubar=no,directories=no,scrollbars=yes,resizable=no,status=no,width=300,height=250,left='+vanster+',top='+toppen);
}

function verifycontact(form,req){
	if(!verifyname(form)){return false;};
	if(!verifyemail(form,req)){return false;};
	if(form.subject.value==""){
		alert("Skriv in ett passande ämne.");
		form.subject.focus();
		return false;
	}
	
	if(form.body.value.length<10){
		alert("Skriv in ett meddelande\n innan du skickar!");
		form.body.focus();
		return false;
	}
	return true;
}


function verifygb(form){
	
	if(!verifyemail(form)){return false;};  // Calls for email validation
	if(!verifyname(form)){return false;};

	
	if (form.city.value=="")
	{
		alert("Var bor du?");
		form.city.focus();
		return false;
	}

	if (form.message.value.length<10)
	{
		alert("Du måste skriva in ett meddelande!");
		form.message.focus();
		return false;
	}
	return true;
}




function verifyforumpost(form){
	if(form.subject.value.length<5){
		alert("Ange ett mer beskrivande ämne!");
		form.subject.focus();
		return false;
	}

	if(form.message.value.length<10){
		alert("Hmm... Försök att skriva\nen mening i alla fall!");
		form.message.focus();
		return false;
	}

	return true;
}



	
function verifyname(form){
	if (form.name.value.length<3){
		alert("Ange ditt namn.");
		form.name.focus();
		return false;
	}
	return true;
}


function verifyemail(form,req){
	email=form.email.value;
	 if (email!="")
	{

		if (email.indexOf("@")==-1 || email.indexOf("@")<1 || email.lastIndexOf(".")>email.length-3 || email.lastIndexOf(".")<email.length-5)
		{
			alert("Felaktig e-postadress!");
			form.email.focus();
			return false;
		}
		
		if (email=="din@epost.se")
		{
			alert("Skriv in din egen e-postadress!");
			form.email.focus();
			return false;
		}
	}
		if(req==1&&email.length<7){
			alert("Du måste ange din e-postadress!");
			form.email.focus();
			return false;
		}
	
	return true;
}



function verifyregistration(form){
	if(!verifylogin(form)){return false;};

	if(form.password.value!=form.confirmpassword.value){
		alert("Lösenorden du angav är inte desamma!");
		form.password.value="";
		form.confirmpassword.value="";
		form.password.focus();
		return false;
	}
	if(form.password.value==form.username.value){
		alert("Lösenordet får inte vara\ndetsamma som användarnamnet!");
		form.password.focus();
		return false;
	}
	if(form.firstname.value==""){
		alert("Skriv in ditt förnamn.");
		form.firstname.focus();
		return false;
	}
	if(form.lastname.value==""){
		alert("Skriv in ditt efternamn.");
		form.lastname.focus();
		return false;
	}
	if(!verifyemail(form,1)){return false;};
	return true;
}

function verifylogin(form){
	if(form.username.value.length<3){
		alert("Användarnamnet måste\nbestå av minst 3 tecken.");
		form.username.focus();
		return false;
	}
	if(form.password.value.length<3){
		alert("Ditt lösenord måste vara\nminst 3 tecken långt.")
		form.password.focus();
		form.password.select();
		return false;
	}
	
	return true;
}


FadeObjects = new Object();
FadeTimers = new Object();

function Fade(object, destOp, rate, delta){
if (!document.all)
return
    if (object != "[object]"){
        setTimeout("Fade("+object+","+destOp+","+rate+","+delta+")",0);
        return;
    }

    clearTimeout(FadeTimers[object.sourceIndex]);

    diff = destOp-object.filters.alpha.opacity;
    direction = 1;
    if (object.filters.alpha.opacity > destOp){
        direction = -1;
    }
    delta=Math.min(direction*diff,delta);
    object.filters.alpha.opacity+=direction*delta;

    if (object.filters.alpha.opacity != destOp){
        FadeObjects[object.sourceIndex]=object;
        FadeTimers[object.sourceIndex]=setTimeout("Fade(FadeObjects["+object.sourceIndex+"],"+destOp+","+rate+","+delta+")",rate);
    }
}

