(this.webpackJSONPwpmdb=this.webpackJSONPwpmdb||[]).push([[8],{805:function(e,t,a){"use strict";a.r(t);var n=a(0),c=a.n(n),i=a(1),l=a(6),s=a(57),o=a(13),r=a(124),p=a.n(r),u=a(42),d=a(21),m=a.n(d),b=a(12),_=a.n(b),f=Object(l.c)(function(e){return{theme_plugin_files:e.theme_plugin_files,panel_info:e.panels,local_version:e.migrations.local_site.theme_plugin_files_version}},{})(function(e){var t="",a=e.theme_plugin_files,n=e.panelsOpen;!m()(n,e.type)&&a[e.type].enabled&&(t=e.summary);return c.a.createElement(c.a.Fragment,null,_()(t))}),O=a(655),g=a(97),h=a(306),v=a(170),j=function(e){var t=e.ariaLabel,a=e.optionChoices,n=e.type,i=e.value,s=Object(l.d)(),o=a,r=function(t){s(e.updateOption(t.target.value,n))},p=Object.keys(o).map(function(e){var t=n+"-"+e,a=i===e;return c.a.createElement("div",{key:e},c.a.createElement("input",{id:t,type:"radio",value:e,checked:a,onChange:r,name:n}),c.a.createElement("label",{htmlFor:t},_()(o[e])))});return c.a.createElement("div",{className:"radiogroup",role:"radiogroup","aria-label":t},p)},E=a(98),y=a(16),x=function(e,t,a){var n=[];if("object"===typeof t){var c=Object.values(t).map(function(e){return e[0].path});"selected"===a["".concat(e,"_option")]&&a["".concat(e,"_selected")].forEach(function(e){c.includes(e)&&n.push(e)}),"except"===a["".concat(e,"_option")]&&a["".concat(e,"_excluded")].forEach(function(e){c.includes(e)&&n.push(e)}),"active"===a["".concat(e,"_option")]&&Object.values(t).forEach(function(e){e[0].active&&n.push(e[0].path)}),"all"===a["".concat(e,"_option")]&&(n=c)}return n};var P=function(e,t){var a=e.theme_plugin_files,r=e.panelsOpen,d=e.current_migration,m=e.remote_site,b=e.local_site,_=d.status,P=d.intent,w=Object(h.b)(e),S=Object(l.d)(),k=t.title,C=t.type,F=t.panel_name,N=t.items,T=N.map(function(e){return e.path}),L=!1,U=P.charAt(0).toUpperCase()+P.slice(1),D={all:Object(i.c)(Object(i.a)("%s all %s","wp-migrate-db"),U,C),active:Object(i.c)(Object(i.a)("%s only active %s","wp-migrate-db"),U,C),selected:Object(i.c)(Object(i.a)("%s only selected %s","wp-migrate-db"),U,C),except:Object(i.c)(Object(i.a)("%s all %s <b>except</b> those selected","wp-migrate-db"),U,C)},I=function(e,t,a,n,c){var i=c.site_details,l=x(n,"plugins"===n?i.plugins:i.themes,e);return{enabled:e["".concat(n.slice(0,-1),"_files")].enabled,isOpen:t.includes("".concat(n.slice(0,-1),"_files")),selected:l,selectionEmpty:p()(a,{name:"SELECTED_".concat(n.toUpperCase(),"_EMPTY")})}}(a,r,_,C,"pull"===P?m:b),J=I.enabled,M=I.isOpen,V=I.selected,A=I.selectionEmpty;Object(n.useEffect)(function(){"select"===a["".concat(C,"_option")]&&S(e.updateSelected(V,C)),"except"===a["".concat(C,"_option")]&&e.updateExcluded(V,C)},[]),J&&!M&&(L=!0);var Y=[],q="selected"===a["".concat(C,"_option")]||"except"===a["".concat(C,"_option")];return L&&Y.push("has-divider"),J&&Y.push("enabled"),c.a.createElement(u.a,{title:k,className:Y.join(" "),panelName:F,disabled:w,enabled:J,forceDivider:L,callback:function(t){return Object(v.b)(t,F,M,J,w,e.addOpenPanel,e.removeOpenPanel,function(){return S(Object(s.f)(F))})},toggle:Object(s.f)(F),hasInput:!0,bodyClass:"tpf-panel-body",panelSummary:c.a.createElement(f,Object(o.a)({},e,{disabled:w,items:N,selected:V,title:k,type:F,summary:D[a["".concat(C,"_option")]]}))},c.a.createElement("div",null,c.a.createElement(j,{ariaLabel:Object(i.a)("Plugin options","wp-migrate-db"),optionChoices:D,intent:"push",type:C,value:a["".concat(C,"_option")],updateOption:s.l}),c.a.createElement(E.a,{id:"".concat(C,"-multiselect"),options:N,extraLabels:"",stateManager:function(t){"except"===a["".concat(C,"_option")]&&e.updateExcluded(t,C),e.updateSelected(t,C)},selected:V,visible:!0,disabled:!q,updateSelected:function(t){var n=t.map(function(e){return e.path});"except"===a["".concat(C,"_option")]?e.updateExcluded(n,C):e.updateSelected(n,C)},selectInverse:function(){return"except"===a["".concat(C,"_option")]?Object(g.a)(e.updateExcluded,T,V,C):Object(g.a)(e.updateSelected,T,V,C)},showOptions:q,type:C,themePluginOption:a["".concat(C,"_option")]})),c.a.createElement("div",{className:"excludes-wrap"},c.a.createElement(O.a,Object(o.a)({},e,{excludes:a["".concat(C,"_excludes")],excludesUpdater:e.updateExcludes,type:C}))),A&&"selected"===a["".concat(C,"_option")]&&c.a.createElement(y.a,{type:"danger"},Object(i.c)(Object(i.a)("Please select at least one %s for migration","wp-migrate-db"),"themes"===C?"theme":"plugin")),A&&"except"===a["".concat(C,"_option")]&&c.a.createElement(y.a,{type:"danger"},Object(i.c)(Object(i.a)("Please select at least one %s to exclude from migration","wp-migrate-db"),"themes"===C?"theme":"plugin")))},w=a(4),S=(a(609),a(34)),k=a(23);function C(e,t){var a={};return["themes","plugins"].forEach(function(n,c){var i="pull"===t?e.remote_site.site_details[n]:e.local_site.site_details[n],l="pull"===t?e.local_site.site_details[n]:e.remote_site.site_details[n],s=i,o=[],r=function(e){var t=l[e];return t?t[0].version:null};for(var p in s){var u=s[p],d={name:u[0].name,active:u[0].active,path:u[0].path,sourceVersion:u[0].version,destinationVersion:r(p)};o.push(d)}return a[n]=o}),a}var F=function(e){var t=C(e,e.current_migration.intent).themes;return P(e,{title:Object(i.a)("Theme Files","wp-migrate-db"),type:"themes",panel_name:"theme_files",items:t})},N=function(e){var t=C(e,e.current_migration.intent).plugins;return P(e,{title:Object(i.a)("Plugin Files","wp-migrate-db"),type:"plugins",panel_name:"plugin_files",items:t})};t.default=Object(l.c)(function(e){var t=Object(w.f)("current_migration",e),a=Object(w.f)("local_site",e),n=Object(w.f)("remote_site",e),c=Object(S.a)("panelsOpen",e),i=Object(w.d)("stages",e),l=Object(w.g)("status",e);return{theme_plugin_files:e.theme_plugin_files,current_migration:t,local_site:a,remote_site:n,panelsOpen:c,stages:i,status:l}},{toggleThemePluginFiles:s.f,updateTPFOption:s.l,updateSelected:s.k,updateExcluded:s.i,togglePanelsOpen:k.l,addOpenPanel:k.c,removeOpenPanel:k.h,updateExcludes:s.j,kickOffTPFStage:s.d})(function(e){return c.a.createElement("div",{className:"theme-plugin-files"},c.a.createElement(F,e),c.a.createElement(N,e))})}}]);