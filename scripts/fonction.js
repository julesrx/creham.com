function openModalPopup(href,title, h, w) {
	if (h == 'undefined') h = 400;
	if (w == 'undefined') w = 400;
	
	$('#modal-popup').load(href,function(){ 
		$(this).dialog({ width: w, height: h, modal: true, title:title }); 
		
	}); 
}

function checkConfirmUrl(url, action) {
    var a = false;
    a= confirm ('Confirmez-vous '+action+' ?');
    if (a) {
        document.location.href = url;
    }
}

//Limit scope pollution from any deprecated API
(function() {

    var matched, browser;

// Use of jQuery.browser is frowned upon.
// More details: http://api.jquery.com/jQuery.browser
// jQuery.uaMatch maintained for back-compat
    jQuery.uaMatch = function( ua ) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
            /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
            /(msie) ([\w.]+)/.exec( ua ) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
            [];

        return {
            browser: match[ 1 ] || "",
            version: match[ 2 ] || "0"
        };
    };

    matched = jQuery.uaMatch( navigator.userAgent );
    browser = {};

    if ( matched.browser ) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
    }

// Chrome is Webkit, but Webkit is also Safari.
    if ( browser.chrome ) {
        browser.webkit = true;
    } else if ( browser.webkit ) {
        browser.safari = true;
    }

    jQuery.browser = browser;

    jQuery.sub = function() {
        function jQuerySub( selector, context ) {
            return new jQuerySub.fn.init( selector, context );
        }
        jQuery.extend( true, jQuerySub, this );
        jQuerySub.superclass = this;
        jQuerySub.fn = jQuerySub.prototype = this();
        jQuerySub.fn.constructor = jQuerySub;
        jQuerySub.sub = this.sub;
        jQuerySub.fn.init = function init( selector, context ) {
            if ( context && context instanceof jQuery && !(context instanceof jQuerySub) ) {
                context = jQuerySub( context );
            }

            return jQuery.fn.init.call( this, selector, context, rootjQuerySub );
        };
        jQuerySub.fn.init.prototype = jQuerySub.fn;
        var rootjQuerySub = jQuerySub(document);
        return jQuerySub;
    };

})();



//Truncator.js v1.0
//
// © 2011 Malcolm Poindexter
// E-mail: contact@malcolmp.com
// This is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation, version 3.
// This software is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
// without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU General Public License for more details. http://www.gnu.org/copyleft/gpl.html
//
// ------------------------------------------------------------------------------------------------------------------
// This class impliments multiline html truncation and wordwrapping through javascript using the jQuery library.
// It follows a binary tree split algorighm along DOM textnodes & html nodes. On page load the Truncator will
// automatically wrap & truncate containers with the .truncate class
//
var Truncator = {
    wrapClass: '.truncate',
    truncChar: '&hellip;',
	expandChar: '&hellip; <u>lire la suite</u>',
	collapseChar: ' <u>masquer</u>',
    wrapWidth: 1, // minimum # of characters to try & fit on a line; may be increased to improve performance.
    breakSpaces: true, //set to false to use non-breaking spaces for a tighter wrap; force a word-break for long words instead of a new line
    hyphenate: true, //use &shy; as default word-break
	saveOriginal: true, //save the original html content
	savedContent: [],//{id:,text:, truncated:, height:, maxHeight:}
	wrapChar: function(safe, truncate, expand, eltId) {
        if (truncate && expand)
            return Truncator.wrapTruncChar(Truncator.expandChar, expand, eltId);
		else if(truncate)
			return Truncator.wrapTruncChar(Truncator.truncChar, expand, eltId);
        if (!safe && Truncator.hyphenate)//default word-break; can cause overflow in which case another default is used.
            return "&shy;";
        if ($.browser.webkit || $.browser.opera) {
            return "&#8203;";
        } else {
            return "&#8203;"//"<wbr>";
        }
    },
	wrapTruncChar: function(trunc, expand, eltId){
		if(expand)
			return "<a href='#' onclick='javascript:Truncator.toggleTruncation(\""+eltId+"\");return false;' >"+trunc+"</a>";
		else
		return trunc;
	},
    getEltWidth: function(tgtElt) {
        if ($.browser.msie) {
            return tgtElt.scrollWidth;
        } else {
            return tgtElt.offsetWidth;
        }
    },
	checkOverflow: function(tgtElt, truncate, origDisplay) {
        var overscroll = false;
        if (truncate) { //check for y-overflow
            if (!$.browser.msie)
                tgtElt.style.display = origDisplay;
            if (tgtElt.scrollHeight > tgtElt.offsetHeight) {// the content is overflowing
                overscroll = true;
                oldHeight = tgtElt.offsetHeight;
            }
            if (!$.browser.msie)
                tgtElt.style.display = "table";
        }
        return overscroll;
    },
    // Split String for a bTree search
    bSplit: function(sStr) {
        var b = { left: sStr.substr(0, sStr.length / 2), right: sStr.substr(sStr.length / 2) }
        if (b.left == "") {
            b.left = b.right;
            b.right = null;
        }
        return b;
    },
    toNBSP: function(str) { return str.replace(/ /g, '\240'); },
    isTextNode: function(n) {
        if (n == undefined || n == null) return false;
        return n.nodeType == 3; //text
    },
    //Required b/c of IE.  Build a tree of nodes w/ textnodes as leaves
    buildTree: function(nodes) {
        var tree = [];
        for (var i = 0; i < nodes.length; i++) {
            if (Truncator.isTextNode(nodes[i]))
                tree[i] = { inner: Truncator.getTextContent(nodes[i]), type: "text" };
            else //inner contains another node object to drill down to the inner text, outer contains the node tags
                tree[i] = { inner: Truncator.buildTree(nodes[i].childNodes), outer: Truncator.getOuterHTML(nodes[i]), type: "node" };
        }
        return tree;
    },
    getTextContent: function(node) {
        if (!$.browser.msie)
            return (Truncator.breakSpaces) ? node.textContent : Truncator.toNBSP(node.textContent);
        else
            return (Truncator.breakSpaces) ? node.nodeValue : Truncator.toNBSP(node.nodeValue);
    },
    getOuterHTML: function(node) {
        if (!$.browser.msie)
            return node;
        else {//tag html content
            var outer = node.outerHTML;
            var o1, o2;
            o1 = outer.substring(0, outer.indexOf(">") + 1);
            o2 = outer.substring(outer.lastIndexOf("<"));
            if (o1 != o2) // handle <img> tags for ie
                return o1 + o2;
            else
                return o1;
        }
    },
    // Add the tags of the child node to the parent
	insNode: function(parent, node) {
        if (!$.browser.msie) {
            parent.appendChild(node.outer);
            node.outer.innerHTML = "";
        } else {
            parent.innerHTML += node.outer;
        }
    },
	// Get/Set the content of a text or html node
	setNodeContent: function(node, content){
		if (node.nodeType == 1)
			node.innerHTML = content;
		else
			node.nodeValue = content;
	},
	getNodeContent: function(node){
		if (node.nodeType == 1)
			return node.innerHTML;
		else
			return node.nodeValue;
	},
	// This function handles the expand/collapse of the container & html content
	toggleTruncation: function(eltId){
		var elt = $("#"+eltId);
		var t, h, mh;
		var text;
		if(elt != undefined && elt != null){
			t = elt.attr("truncId");//the index in the stored array
			h = elt[0].style.height;
			mh = elt[0].style.maxHeight;
			if(h == undefined)
				h = "auto";
			if(mh == null || mh == "")
				mh = "none";
			if(t != undefined && t != null){
				elt = elt[0];
				//switch the saved text w/ the innerHTML
				text = Truncator.savedContent[t].text;
				Truncator.savedContent[t].text = elt.innerHTML;
				elt.innerHTML = text;
				elt.style.height = Truncator.savedContent[t].height;
				if(Truncator.savedContent[t].maxHeight != null)
					elt.style.maxHeight = Truncator.savedContent[t].maxHeight;
				Truncator.savedContent[t].height = h;
				Truncator.savedContent[t].maxHeight = mh;
				if(!Truncator.savedContent[t].truncated){//if the stored text has not been wrapped, wrap it
					Truncator.wrap(elt,false, true);
					elt.innerHTML += Truncator.wrapTruncChar(Truncator.collapseChar, true, eltId);
					Truncator.savedContent[t].truncated = true;
				}
			}
		}
	},
    init: function(index, tgtElt) {
        Truncator.wrap(tgtElt);
    },
	//truncate by applying height & width passed in
	truncate: function(tgtElt, width, height, maxHeight, truncateStr) {
	var tgt = $("#"+tgtElt.id);
		tgt.css("overflow", "hidden");
		if(width != undefined && width != null)
			tgt.css("width",width);
		if(height != undefined && height != null)
			tgt.css("height", height);
		if(maxHeight != undefined && maxHeight != null)
			tgt.css("max-height", maxHeight);
        Truncator.wrap(tgtElt,true,truncateStr);
    },
    //Main function. Breaks long words, walks text node tree, counts # of lines, truncates text
    //tgtElt: the container to truncate text within
    //truncate: if not passed as a parameter, will check 'truncate' attribute of container
	//expand: implement expand / collapse links for truncation
    //truncateStr: the string to use to truncate the text. Default - elipsis
    wrap: function(tgtElt, truncate, expand, truncateStr) {
        if (tgtElt == undefined || tgtElt == null) return;
        if (truncate == undefined || truncate == null) {
            var tempTrunc = $("#" + tgtElt.id).attr("truncate");// a value set to the truncate attribute triggers truncation
            if (tempTrunc == undefined || tempTrunc == null)
                truncate = false;
            else
                truncate = true;
        }
		if (expand == undefined || expand == null) {
            var texpand = $("#" + tgtElt.id).attr("expand");// a value set to the expand attribut treiggers expand/collpase links
			if(texpand != undefined)
				expand = true;
			else
				expand = false;
        }
        if (truncateStr == undefined || truncateStr == null) { truncateStr = Truncator.truncChar; }
        if (Truncator.saveOriginal && truncate){
            $("#" + tgtElt.id).attr("truncId", Truncator.savedContent.length);
			Truncator.savedContent.push({id: tgtElt.id, text: $("#" + tgtElt.id)[0].innerHTML, truncated: false, height: "auto", maxHeight: "none"});
		}
        var insElt = tgtElt;
        var undoTxt, insHTML, wwrapChar, tinsElt;
        var initialWidth = tgtElt.offsetWidth;
        var childOffsetHeight, currentWidth, oHeight = oldHeight = 0;
        var origDisplay = tgtElt.style.display;
        var overscroll = false;
		var truncated = false; 
        if (!$.browser.msie)
            tgtElt.style.display = "table";
        var bElt, bArr, bStack;
        var nodeStack = [], nStack = [];
        //Build Node Tree
        var nodeTree = Truncator.buildTree(insElt.childNodes);
        insElt.innerHTML = "";
        for (n = 0; !(n >= nodeTree.length && insElt == tgtElt) && !truncated && n < 100; n++) {//loop through textnodes & html nodes
            if (nodeTree.length == n) {
                //Branch complete, pop back up to parent node
                if (insElt == tgtElt) break;
                insElt = insElt.parentNode;
                n = nStack.pop();
                nodeTree = nodeStack.pop();
                continue;
            }
            //Check nesting conditions. If HTML insert tags & drill down to TextNode to insert text
            if (nodeTree[n].type == "text") {
                //Text Node, Split our string up & try insertion
                bArr = Truncator.bSplit(nodeTree[n].inner);
                bStack = [bArr];
                if (n == 0)
                    Truncator.setNodeContent(insElt,"");
                for (var b = 0; bStack.length > 0 && b < 1000; b++) {
                    undoTxt = Truncator.getNodeContent(insElt);
                    bElt = bStack[bStack.length - 1];
                    //Try and add the next chunk from the bTree
                    Truncator.setNodeContent(insElt, undoTxt + bElt.left);
                    currentWidth = Truncator.getEltWidth(tgtElt);
                    overscroll = Truncator.checkOverflow(tgtElt, truncate, origDisplay);
                    if ((bElt.left.length > 0 && currentWidth > initialWidth) || overscroll) {
                        // Undo insertion attempt & split left
						Truncator.setNodeContent(insElt,undoTxt);
						insHTML = Truncator.getNodeContent(insElt);
						if (bElt.left.length <= Truncator.wrapWidth) {
                            //Some break characters such as the &shy; will overflow themselves, this checks for that case.							
                            wwrapChar = Truncator.wrapChar(false, overscroll, expand, tgtElt.id);
                            if (insHTML.length - insHTML.lastIndexOf(wwrapChar) == wwrapChar.length + 1) {
                                //turn shy into wbr.
                                Truncator.setNodeContent(insElt, insHTML.substring(0, insHTML.lastIndexOf(wwrapChar)) + Truncator.wrapChar(true, overscroll, expand, tgtElt.id) + insHTML.substring(insHTML.lastIndexOf(wwrapChar) + wwrapChar.length));
                                continue;
                            }
                            Truncator.setNodeContent(insElt, undoTxt + wwrapChar + (!(overscroll) ? bElt.left : ""));
                            currentWidth = Truncator.getEltWidth(tgtElt);
                            overscroll = Truncator.checkOverflow(tgtElt, truncate, origDisplay);
                            if (currentWidth > initialWidth || overscroll) {
                                if (overscroll && truncate) {
                                    truncated = true;
                                    wwrapChar = Truncator.wrapChar(false, overscroll, expand, tgtElt.id);
                                }
                                //move the &shy; left
								tinsElt = insElt;
                                for (var u = 1; u < 50 && (overscroll || currentWidth > initialWidth); u++) {
                                    if (u > undoTxt.length || undoTxt.substr(undoTxt.length - u,1) == ">") {//remove overflowing nodes
                                        //Enter last child element &  continue truncation.
                                        if (u == 1 && insElt.lastChild.nodeType == 1) {
                                            Truncator.setNodeContent(insElt, undoTxt);
                                            if(insElt.lastChild != null){
												insElt = insElt.lastChild;
											}else{
												insElt = insElt.parentNode;
												insElt.removeChild(insElt.lastChild);
											}
                                        }else if (insElt.childNodes != null && insElt.childNodes.length > 1) {
                                            Truncator.setNodeContent(insElt, undoTxt.substr(0, undoTxt.length - u + 2));
                                            insElt = insElt.childNodes[insElt.childNodes.length - 1];
										}else if (truncated && insElt.parentNode != null){
											insElt = insElt.parentNode;
											insElt.removeChild(insElt.lastChild);
                                        } else {
											Truncator.setNodeContent(insElt, undoTxt + Truncator.wrapChar(true, overscroll, expand, tgtElt.id));
                                            break;
                                        }
                                        u = 0;
                                        undoTxt = Truncator.getNodeContent(insElt);
                                    }
									Truncator.setNodeContent(insElt, undoTxt.substr(0, undoTxt.length - u) + wwrapChar + (!(overscroll || truncated) ? undoTxt.substr(undoTxt.length - u) : ""));
                                    currentWidth = Truncator.getEltWidth(tgtElt);
                                    overscroll = Truncator.checkOverflow(tgtElt, truncate, origDisplay);
                                }
                                if (u >= 50)
                                    Truncator.setNodeContent(insElt, undoTxt + Truncator.wrapChar(true, overscroll, expand, tgtElt.id));
                                if (truncated) {
                                    break;
                                }else if(insElt != tinsElt)
									insElt = tinsElt;
                            } else {
                                Truncator.setNodeContent(insElt, undoTxt + wwrapChar);
                            }
                        } else {
                            bStack.push(Truncator.bSplit(bElt.left));
                        }
                    } else { //Continue Right down binary search tree
                        if (bElt.left != "") {
                            if (tgtElt.offsetHeight > oHeight) { //New line
                                oldHeight = oHeight;
                                oHeight = tgtElt.offsetHeight;
                            }
                        }
                        bStack.pop();
                        if (bElt.right != null && bElt.right != "") {//Advance to right child
                            bStack.push({ left: bElt.right, right: "" });
                        } else {
                            if (bStack.length > 0) {//Advance to sibling
                                bStack.push(Truncator.bSplit(bStack.pop().right))
                            }
                        }
                    }
                }
            } else {
                //HTML Node, insert tags & process node's children
                Truncator.insNode(insElt, nodeTree[n]);
                insElt = insElt.lastChild;
                nStack.push(n);
                nodeStack.push(nodeTree);
                nodeTree = nodeTree[n].inner;
                n = -1;
            }
        }
        tgtElt.style.display = origDisplay;
    }
};
$(window).load(function(){$.each($(Truncator.wrapClass),Truncator.init)});//auto-wrap & truncate all class elements



/* French initialisation for the jQuery UI date picker plugin. */
/* Written by Keith Wood (kbwood{at}iinet.com.au),
			  Stéphane Nahmani (sholby@sholby.net),
			  Stéphane Raimbault <stephane.raimbault@gmail.com> */
jQuery(function($){
	$.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: 'Précédent',
		nextText: 'Suivant',
		currentText: 'Aujourd\'hui',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin',
		'Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
		dayNamesMin: ['D','L','M','M','J','V','S'],
		weekHeader: 'Sem.',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
});