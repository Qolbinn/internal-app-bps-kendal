/*** Editor Script Wrapper ***/
var oScripts=document.getElementsByTagName("script"); 
var sEditorPath;
for(var i=0;i<oScripts.length;i++)
  {
  var sSrc=oScripts[i].src.toLowerCase();
  if(sSrc.indexOf("plugins/innovastudio/innovaeditor.js")!=-1) sEditorPath=oScripts[i].src.replace(/innovaeditor.js/,"");
}

document.write("<scr" + "ipt src='" + sEditorPath + "/nlslightbox.js' type='text/javascript'></scr" + "ipt>");
document.write("<scr" + "ipt src='" + sEditorPath + "/nlsanimation.js' type='text/javascript'></scr" + "ipt>");
document.write("<link href='" + sEditorPath + "/nlslightbox.css' rel='stylesheet' type='text/css' />");
document.write("<scr" + "ipt src='" + sEditorPath + "/dialog.js' type='text/javascript'></scr" + "ipt>");

document.write("<li"+"nk rel='stylesheet' href='"+sEditorPath+"/istoolbar.css' type='text/css' />");
document.write("<scr"+"ipt src='"+sEditorPath+"/istoolbar.js'></scr"+"ipt>");

if(navigator.appName.indexOf('Microsoft')!=-1) {
  document.write("<scr"+"ipt src='"+sEditorPath+"/editor.js'></scr"+"ipt>");
} else if(navigator.userAgent.indexOf('Safari')!=-1) {
  document.write("<scr"+"ipt src='"+sEditorPath+"saf/editor.js'></scr"+"ipt>");
} else {
  document.write("<scr"+"ipt src='"+sEditorPath+"moz/editor.js'></scr"+"ipt>");
}

/*
modelessDialogShow = function (a, b, c) { modalDialog(a, b, c) }; 
modalDialogShow = function (a, b, c) { modalDialog(a, b, c) }; 
try {
    $(document).ready(function () {
        modelessDialogShow = function (a, b, c) { modalDialog(a, b, c) };
        modalDialogShow = function (a, b, c) { modalDialog(a, b, c) };
    });
} catch (e) { }
*/
