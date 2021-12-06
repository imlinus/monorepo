<img src="k3.gif" width="56" height="50" align="left"></div><div id="meny"><br></div><div id="rubrik">Bus 
</div><div id="mit"><br>

<script language="javascript">
<!-- 

var old_text = '';
var compressed = false;

function ereg(txt, search) {
	for(i = 0; i < txt.length; i++) {
		if (txt.substr(i,1) == search) return true;
	}
	return false;
}

function compressNoBlink() {
    document.getElementById("compress_undo").style.textDecoration = "none";
}

function compress () {
    var expr = /(.+)\s(.+)/;
    var txt = document.smsbox.nachricht.value;
    
    if(!compressed) {
        document.getElementById("compress_undo").style.textDecoration = "blink";
        setTimeout("compressNoBlink()", 5000);
    }

    old_text = txt;
    compressed = true;
 
    while (txt.search(expr) != -1){
        expr.exec(txt);
        txt = RegExp.$1 + RegExp.$2.charAt(0).toUpperCase() + RegExp.$2.substring(1, 1600);
    }

    document.smsbox.nachricht.value = txt;
    c_counter();
}

function compress_undo() {
    if(compressed) document.smsbox.nachricht.value = old_text;
}


compHelp = null;
document.onmousemove = updateCompHelp;

function updateCompHelp(e) {
    x = (document.all) ? window.event.x + document.body.scrollLeft : e.pageX;
    y = (document.all) ? window.event.y + document.body.scrollTop  : e.pageY;
    if (compHelp != null) {
        compHelp.style.left = (x - 70) + "px";
        compHelp.style.top  = (y + 15) + "px";
    }
}
                                
function showCompHelp(e) {
    compHelp = document.getElementById("compHelp");
    compHelp.style.display = "block";
}

function hideCompHelp() {
    compHelp.style.display = "none";
}

// -->
</script>