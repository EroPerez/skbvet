var HideDevelBar=function(){var a=document.getElementById("develbar-container"),b=document.getElementById("develbar-off");a.style.display="none",b.style.display="block"},ShowDevelBar=function(){var a=document.getElementById("develbar-container"),b=document.getElementById("develbar-off");b.style.display="none",a.style.display="block"},HideDevelBarSection=function(){for(var a=document.getElementById("develbar-container"),b=a.getElementsByTagName("li"),c=0;c<b.length;c++)b[c].className=""},ShowViewVars=function(a){for(var b=a.parentElement.parentElement.nextSibling,c=document.getElementsByClassName("develbar-detail-vars"),d=0;d<c.length;d++)if(b!=c[d]){c[d].style.display="none";for(var e=document.getElementsByClassName("develbar-open-icon"),d=0;d<e.length;d++)e[d].innerHTML="+"}var f=b.style.display;"block"==f?b.style.display="none":(b.style.display="block",a.getElementsByClassName("develbar-open-icon")[0].innerHTML="-")};