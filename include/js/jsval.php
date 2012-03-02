<?php
ob_start ("ob_gzhandler");
header("Content-type: text/javascript; charset=utf-8");
header("Cache-Control: must-revalidate");
$offset = 600 * 60 ;
$ExpStr = "Expires:" .
gmdate("D, d M Y H:i:s",
time() + $offset) . "GMT";
header($ExpStr);

?>
function validateCompleteForm(b,a){if(typeof b!="object"){b=document.getElementById(b)}return _validateInternal(b,a,0)}function validateStandard(b,a){return _validateInternal(b,a,1)}function _validateInternal(f,h,b){var e="";var d=null;if(b==0){e=(f.err)?f.err:_getLanguageText("err_form")}var a=_GenerateFormFields(f);for(var c=0;c<a.length;++c){var g=a[c];if(!g.IsValid(a)){g.SetClass(h);if(b==1){_throwError(g);return false}else{if(d==null){d=g}e=_handleError(g,e);bError=true}}else{g.ResetClass()}}if(d!=null){alert(e);d.element.focus();return false}return true}function _getLanguageText(b){objTextsInternal=new _jsVal_Language();objTexts=null;try{objTexts=new jsVal_Language()}catch(a){}switch(b){case"err_form":strResult=(!objTexts||!objTexts.err_form)?objTextsInternal.err_form:objTexts.err_form;break;case"err_enter":strResult=(!objTexts||!objTexts.err_enter)?objTextsInternal.err_enter:objTexts.err_enter;break;case"err_select":strResult=(!objTexts||!objTexts.err_select)?objTextsInternal.err_select:objTexts.err_select;break}return strResult}function _GenerateFormFields(e){var a=new Array();for(var d=0;d<e.length;++d){var c=e.elements[d];var b=_getElementIndex(a,c);if(b==-1){a[a.length]=new Field(c,e)}else{a[b].Merge(c)}}return a}function _getElementIndex(b,d){if(d.name){var a=d.name.toLowerCase();for(var c=0;c<b.length;++c){if(b[c].element.name){if(b[c].element.name.toLowerCase()==a){return c}}}}return -1}function _jsVal_Language(){this.err_form="Please enter/select values for the following fields:\n\n";this.err_select='Please select a valid "%FIELDNAME%"';this.err_enter='Please enter a valid "%FIELDNAME%"'}function Field(b,c){this.type=b.type;this.element=b;this.exclude=b.exclude||b.getAttribute("exclude");this.err=b.err||b.getAttribute("err");this.required=_parseBoolean(b.required||b.getAttribute("required"));this.realname=b.realname||b.getAttribute("realname");this.elements=new Array();switch(this.type){case"textarea":case"password":case"text":case"file":this.value=b.value;this.minLength=b.minlength||b.getAttribute("minlength");this.maxLength=b.maxlength||b.getAttribute("maxlength");this.regexp=this._getRegEx(b);this.minValue=b.minvalue||b.getAttribute("minvalue");this.maxValue=b.maxvalue||b.getAttribute("maxvalue");this.equals=b.equals||b.getAttribute("equals");this.callback=b.callback||b.getAttribute("callback");break;case"select-one":case"select-multiple":this.values=new Array();for(var a=0;a<b.options.length;++a){if(b.options[a].selected&&(!this.exclude||b.options[a].value!=this.exclude)){this.values[this.values.length]=b.options[a].value}}this.min=b.min||b.getAttribute("min");this.max=b.max||b.getAttribute("max");this.equals=b.equals||b.getAttribute("equals");break;case"checkbox":this.min=b.min||b.getAttribute("min");this.max=b.max||b.getAttribute("max");case"radio":this.required=_parseBoolean(this.required||b.getAttribute("required"));this.values=new Array();if(b.checked){this.values[0]=b.value}this.elements[0]=b;break}}Field.prototype.Merge=function(a){var b=_parseBoolean(a.getAttribute("required"));if(b){this.required=true}if(!this.err){this.err=a.getAttribute("err")}if(!this.equals){this.equals=a.getAttribute("equals")}if(!this.callback){this.callback=a.getAttribute("callback")}if(!this.realname){this.realname=a.getAttribute("realname")}if(!this.max){this.max=a.getAttribute("max")}if(!this.min){this.min=a.getAttribute("min")}if(!this.regexp){this.regexp=this._getRegEx(a)}if(a.checked){this.values[this.values.length]=a.value}this.elements[this.elements.length]=a};Field.prototype.IsValid=function(a){switch(this.type){case"textarea":case"password":case"text":case"file":return this._ValidateText(a);case"select-one":case"select-multiple":case"radio":case"checkbox":return this._ValidateGroup(a);default:return true}};Field.prototype.SetClass=function(a){if((a)&&(a!="")){if((this.elements)&&(this.elements.length>0)){for(var b=0;b<this.elements.length;++b){if(this.elements[b].className!=a){this.elements[b].oldClassName=this.elements[b].className;this.elements[b].className=a}}}else{if(this.element.className!=a){this.element.oldClassName=this.element.className;this.element.className=a}}}};Field.prototype.ResetClass=function(){if((this.type!="button")&&(this.type!="submit")&&(this.type!="reset")){if((this.elements)&&(this.elements.length>0)){for(var a=0;a<this.elements.length;++a){if(this.elements[a].oldClassName){this.elements[a].className=this.elements[a].oldClassName}else{}}}else{if(this.elements.oldClassName){this.element.className=this.element.oldClassName}else{}}}};Field.prototype._getRegEx=function(a){regex=a.regexp||a.getAttribute("regexp");if(regex==null){return null}retype=typeof(regex);if(retype.toUpperCase()=="FUNCTION"){return regex}else{if((retype.toUpperCase()=="STRING")&&!(regex=="EMAIL")&&!(regex=="JSVAL_RX_TEL")&&!(regex=="JSVAL_RX_PC")&&!(regex=="JSVAL_RX_ZIP")&&!(regex=="JSVAL_RX_MONEY")&&!(regex=="JSVAL_RX_CREDITCARD")&&!(regex=="JSVAL_RX_POSTALZIP")){return new RegExp(regex)}else{return regex}}};Field.prototype._ValidateText=function(arrFields){if((this.required)&&(this.callback)){nCurId=this.element.id?this.element.id:"";nCurName=this.element.name?this.element.name:"";eval("bResult = "+this.callback+"('"+nCurId+"', '"+nCurName+"', '"+this.value+"');");if(bResult==false){return false}}else{if(this.required&&!this.value){return false}if(this.value&&(this.minLength&&this.value.length<this.minLength)){return false}if(this.value&&(this.maxLength&&this.value.length>this.maxLength)){return false}if(this.regexp){if(!_checkRegExp(this.regexp,this.value)){if(!this.required&&this.value){return false}if(this.required){return false}}else{return true}}if(this.equals){for(var i=0;i<arrFields.length;++i){var field=arrFields[i];if((field.element.name==this.equals)||(field.element.id==this.equals)){if(field.element.value!=this.value){return false}break}}}if(this.required){var fValue=parseFloat(this.value);if((this.minValue||this.maxValue)&&isNaN(fValue)){return false}if((this.minValue)&&(fValue<this.minValue)){return false}if((this.maxValue)&&(fValue>this.maxValue)){return false}}}return true};Field.prototype._ValidateGroup=function(a){if(this.required&&this.values.length==0){return false}if(this.required&&this.min&&this.min>this.values.length){return false}if(this.required&&this.max&&this.max<this.values.length){return false}return true};function _handleError(c,a){var b=c.element;strNewMessage=a+((c.realname)?c.realname:((b.id)?b.id:b.name))+"\n";return strNewMessage}function _throwError(b){var a=b.element;switch(b.type){case"text":case"password":case"textarea":case"file":alert(_getError(b,"err_enter"));try{a.focus()}catch(c){}break;case"select-one":case"select-multiple":case"radio":case"checkbox":alert(_getError(b,"err_select"));break}}function _getError(b,c){var a=b.element;strErrorTemp=(b.err)?b.err:_getLanguageText(c);idx=strErrorTemp.indexOf("\\n");while(idx>-1){strErrorTemp=strErrorTemp.replace("\\n","\n");idx=strErrorTemp.indexOf("\\n")}return strErrorTemp.replace("%FIELDNAME%",(b.realname)?b.realname:((a.id)?a.id:a.name))}function _parseBoolean(a){return !(!a||a==0||a=="0"||a=="false")}function _checkRegExp(b,a){switch(b){case"EMAIL":return((/^[\x21-\x39\x41-\x5a\x5e-\x7e]+@[\x21-\x39\x41-\x5a\x5e-\x7e]+(\.\w{2,5})+$/).test(a));case"JSVAL_RX_TEL":return((/^1?[\- ]?\(?\d{3}\)?[\- ]?\d{3}[\- ]?\d{4}$/).test(a));case"JSVAL_RX_PC":return((/^[a-z]\d[a-z] ?\d[a-z]\d$/i).test(a));case"JSVAL_RX_ZIP":return((/^\d{5}$/).test(a));case"JSVAL_RX_MONEY":return((/^\d+([\.]\d\d)?$/).test(a));case"JSVAL_RX_CREDITCARD":return(!isNaN(a));case"JSVAL_RX_POSTALZIP":if(a.length==6||a.length==7){return((/^[a-zA-Z]\d[a-zA-Z] ?\d[a-zA-Z]\d$/).test(a))}if(a.length==5||a.length==10){return((/^\d{5}(\-\d{4})?$/).test(a))}break;default:return(b.test(a))}};