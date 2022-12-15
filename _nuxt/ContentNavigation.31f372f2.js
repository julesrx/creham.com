import{a as v,A as c,z as I,F as k,G as A,e as L,f as T,j as s,H as S,q as p,m as z,I as j,d as e,_ as r,p as $,J as x,K as M,r as N,h as F,L as B,M as C}from"./entry.4dd23f87.js";import{u as w}from"./asyncData.95f4e114.js";import{u as q,a as H,b as D}from"./nuxt-img.0459a8d2.js";import"./ContentDoc.92278b1b.js";import"./ContentList.4fc77829.js";import"./ContentQuery.7a0e3e53.js";import"./ContentRenderer.e8365361.js";import"./ContentRendererMarkdown.6313f1c5.js";import"./ContentSlot.85cc3782.js";import"./Markdown.cdf0102d.js";import"./ProseCode.9821d11f.js";import"./layout.37b81aa8.js";import"./head.01353360.js";import"./_commonjsHelpers.32e42f04.js";import"./_plugin-vue_export-helper.a1a6add7.js";const K=v({emits:{error(t){return!0}},setup(t,{slots:a,emit:i}){const _=c(null),n=I();return k(u=>{if(!n.isHydrating)return i("error",u),_.value=u,!1}),()=>{var u,l;return _.value?(u=a.error)==null?void 0:u.call(a,{error:_}):(l=a.default)==null?void 0:l.call(a)}}}),G=Object.freeze(Object.defineProperty({__proto__:null,default:K},Symbol.toStringTag,{value:"Module"})),J=v({name:"ClientOnly",inheritAttrs:!1,props:["fallback","placeholder","placeholderTag","fallbackTag"],setup(t,{slots:a,attrs:i}){const _=c(!1);return A(()=>{_.value=!0}),n=>{var o;if(_.value)return(o=a.default)==null?void 0:o.call(a);const u=a.fallback||a.placeholder;if(u)return u();const l=n.fallback||n.placeholder||"",d=n.fallbackTag||n.placeholderTag||"span";return L(d,i,l)}}}),O=new WeakMap;function U(t){if(O.has(t))return O.get(t);const a={...t};return a.render?a.render=(i,..._)=>{var n;if(i.mounted$){const u=t.render(i,..._);return u.children===null||typeof u.children=="string"?T(u.type,u.props,u.children,u.patchFlag,u.dynamicProps,u.shapeFlag):s(u)}else return s("div",(n=i.$attrs)!=null?n:i._.attrs)}:a.template&&(a.template=`
      <template v-if="mounted$">${t.template}</template>
      <template v-else><div></div></template>
    `),a.setup=(i,_)=>{var u;const n=c(!1);return A(()=>{n.value=!0}),Promise.resolve(((u=t.setup)==null?void 0:u.call(t,i,_))||{}).then(l=>typeof l!="function"?{...l,mounted$:n}:(...d)=>{if(n.value){const o=l(...d);return o.children===null||typeof o.children=="string"?T(o.type,o.props,o.children,o.patchFlag,o.dynamicProps,o.shapeFlag):s(o)}else return s("div",_.attrs)})},O.set(t,a),a}const W=Object.freeze(Object.defineProperty({__proto__:null,default:J,createClientOnly:U},Symbol.toStringTag,{value:"Module"})),Q=v({name:"DevOnly",setup(t,a){return()=>null}}),X=Object.freeze(Object.defineProperty({__proto__:null,default:Q},Symbol.toStringTag,{value:"Module"})),Y=v({name:"ServerPlaceholder",render(){return L("div")}}),Z=Object.freeze(Object.defineProperty({__proto__:null,default:Y},Symbol.toStringTag,{value:"Module"})),tt=v({name:"NuxtLoadingIndicator",props:{throttle:{type:Number,default:200},duration:{type:Number,default:2e3},height:{type:Number,default:3},color:{type:String,default:"repeating-linear-gradient(to right,#00dc82 0%,#34cdfe 50%,#0047e1 100%)"}},setup(t,{slots:a}){const i=et({duration:t.duration,throttle:t.throttle}),_=I();return _.hook("page:start",i.start),_.hook("page:finish",i.finish),S(()=>i.clear),()=>s("div",{class:"nuxt-loading-indicator",style:{position:"fixed",top:0,right:0,left:0,pointerEvents:"none",width:`${i.progress.value}%`,height:`${t.height}px`,opacity:i.isLoading.value?1:0,background:t.color,backgroundSize:`${100/i.progress.value*100}% auto`,transition:"width 0.1s, height 0.4s, opacity 0.4s",zIndex:999999}},a)}});function et(t){const a=c(0),i=c(!1),_=p(()=>1e4/t.duration);let n=null,u=null;function l(){o(),a.value=0,i.value=!0,t.throttle?u=setTimeout(h,t.throttle):h()}function d(){a.value=100,g()}function o(){clearInterval(n),clearTimeout(u),n=null,u=null}function f(P){a.value=Math.min(100,a.value+P)}function g(){o(),setTimeout(()=>{i.value=!1,setTimeout(()=>{a.value=0},400)},500)}function h(){n=setInterval(()=>{f(_.value)},100)}return{progress:a,isLoading:i,start:l,finish:d,clear:o}}const rt=Object.freeze(Object.defineProperty({__proto__:null,default:tt},Symbol.toStringTag,{value:"Module"})),y={...D,legacyFormat:{type:String,default:null},imgAttrs:{type:Object,default:null}},at=v({name:"NuxtPicture",props:y,setup:(t,a)=>{var g,h,P;const i=q(),_=H(t),n=p(()=>["png","webp","gif"].includes(u.value)),u=p(()=>j(t.src)),l=p(()=>t.format||u.value==="svg"?"svg":"webp"),d=p(()=>t.legacyFormat?t.legacyFormat:{webp:n.value?"png":"jpeg",svg:"png"}[l.value]||u.value),o=p(()=>l.value==="svg"?[{srcset:t.src}]:(d.value!==l.value?[d.value,l.value]:[l.value]).map(E=>{const{srcset:R,sizes:V,src:b}=i.getSizes(t.src,{..._.options.value,sizes:t.sizes||i.options.screens,modifiers:{..._.modifiers.value,format:E}});return{src:b,type:`image/${E}`,sizes:V,srcset:R}}));if(t.preload){const m=(g=o.value)!=null&&g[1]?1:0,E={rel:"preload",as:"image",imagesrcset:o.value[m].srcset};(P=(h=o.value)==null?void 0:h[m])!=null&&P.sizes&&(E.imagesizes=o.value[m].sizes),z({link:[E]})}const f={...t.imgAttrs};for(const m in a.attrs)m in D&&!(m in f)&&(f[m]=a.attrs[m]);return()=>{var m;return s("picture",{key:o.value[0].src},[...(m=o.value)!=null&&m[1]?[s("source",{type:o.value[1].type,sizes:o.value[1].sizes,srcset:o.value[1].srcset})]:[],s("img",{..._.attrs.value,...f,src:o.value[0].src,sizes:o.value[0].sizes,srcset:o.value[0].srcset})])}}}),ot=Object.freeze(Object.defineProperty({__proto__:null,pictureProps:y,default:at},Symbol.toStringTag,{value:"Module"}));e(()=>r(()=>import("./MailTo.6ae34459.js"),["./MailTo.6ae34459.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./SiteAddress.77d10c9e.js"),["./SiteAddress.77d10c9e.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./SiteEmail.67f28c6b.js"),["./SiteEmail.67f28c6b.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./SiteTel.bfd4ee4b.js"),["./SiteTel.bfd4ee4b.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./SiteTitle.1c34b986.js"),["./SiteTitle.1c34b986.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./DocumentDrivenEmpty.de12104e.js"),["./DocumentDrivenEmpty.de12104e.js","./DocumentDrivenNotFound.vue_vue_type_script_setup_true_lang.9999cb98.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./_plugin-vue_export-helper.a1a6add7.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./DocumentDrivenNotFound.f38b17aa.js"),["./DocumentDrivenNotFound.f38b17aa.js","./DocumentDrivenNotFound.vue_vue_type_script_setup_true_lang.9999cb98.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./Nav.fb38f627.js"),["./Nav.fb38f627.js","./nuxt-img.0459a8d2.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./_plugin-vue_export-helper.a1a6add7.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./Slider.2f1829c8.js"),["./Slider.2f1829c8.js","./Slider.vue_vue_type_script_setup_true_lang.6ef0ccfa.js","./nuxt-img.0459a8d2.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ContentDoc.92278b1b.js"),["./ContentDoc.92278b1b.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./head.01353360.js","./ContentRenderer.e8365361.js","./ContentRendererMarkdown.6313f1c5.js","./_commonjsHelpers.32e42f04.js","./ContentQuery.7a0e3e53.js","./asyncData.95f4e114.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ContentList.4fc77829.js"),["./ContentList.4fc77829.js","./ContentQuery.7a0e3e53.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./asyncData.95f4e114.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>ut),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ContentQuery.7a0e3e53.js"),["./ContentQuery.7a0e3e53.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./asyncData.95f4e114.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ContentRenderer.e8365361.js"),["./ContentRenderer.e8365361.js","./ContentRendererMarkdown.6313f1c5.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./_commonjsHelpers.32e42f04.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ContentRendererMarkdown.6313f1c5.js"),["./ContentRendererMarkdown.6313f1c5.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./_commonjsHelpers.32e42f04.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ContentSlot.85cc3782.js"),["./ContentSlot.85cc3782.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./Markdown.cdf0102d.js"),["./Markdown.cdf0102d.js","./ContentSlot.85cc3782.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseA.063fe141.js"),["./ProseA.063fe141.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseBlockquote.601b1df9.js"),["./ProseBlockquote.601b1df9.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseCode.9821d11f.js"),["./ProseCode.9821d11f.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./ProseCode.e63e49c6.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseCodeInline.22c54c2c.js"),["./ProseCodeInline.22c54c2c.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseEm.f90e4662.js"),["./ProseEm.f90e4662.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseH1.c480713f.js"),["./ProseH1.c480713f.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseH2.feb06ac7.js"),["./ProseH2.feb06ac7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseH3.50ff5b07.js"),["./ProseH3.50ff5b07.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseH4.256f6a44.js"),["./ProseH4.256f6a44.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseH5.da711fe4.js"),["./ProseH5.da711fe4.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseH6.faa42b0d.js"),["./ProseH6.faa42b0d.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseHr.a51d1907.js"),["./ProseHr.a51d1907.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseImg.e6a94ef2.js"),["./ProseImg.e6a94ef2.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseLi.f5d514a1.js"),["./ProseLi.f5d514a1.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseOl.38d7cd6b.js"),["./ProseOl.38d7cd6b.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseP.286df6e7.js"),["./ProseP.286df6e7.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseStrong.f3920616.js"),["./ProseStrong.f3920616.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseTable.ecf8981d.js"),["./ProseTable.ecf8981d.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseTbody.4190aea2.js"),["./ProseTbody.4190aea2.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseTd.30782871.js"),["./ProseTd.30782871.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseTh.a35953eb.js"),["./ProseTh.a35953eb.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseThead.1de8438f.js"),["./ProseThead.1de8438f.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseTr.2d05d769.js"),["./ProseTr.2d05d769.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./ProseUl.06614d2f.js"),["./ProseUl.06614d2f.js","./_plugin-vue_export-helper.a1a6add7.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./welcome.5aae7dea.js"),["./welcome.5aae7dea.js","./entry.4dd23f87.js","./entry.5cadc60e.css","./_plugin-vue_export-helper.a1a6add7.js","./asyncData.95f4e114.js","./nuxt-img.0459a8d2.js","./ContentDoc.92278b1b.js","./head.01353360.js","./ContentRenderer.e8365361.js","./ContentRendererMarkdown.6313f1c5.js","./_commonjsHelpers.32e42f04.js","./ContentQuery.7a0e3e53.js","./ContentList.4fc77829.js","./ContentSlot.85cc3782.js","./Markdown.cdf0102d.js","./ProseCode.9821d11f.js","./ProseCode.e63e49c6.css","./layout.37b81aa8.js"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./layout.37b81aa8.js"),["./layout.37b81aa8.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>G),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>W),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>X),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>Z),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.aj),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>rt),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./nuxt-img.0459a8d2.js").then(t=>t.n),["./nuxt-img.0459a8d2.js","./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>Promise.resolve().then(()=>ot),void 0,import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.al),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.default||t));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.NoScript));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Link));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Base));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Title));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Meta));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Style));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Head));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Html));e(()=>r(()=>import("./entry.4dd23f87.js").then(t=>t.ak),["./entry.4dd23f87.js","./entry.5cadc60e.css"],import.meta.url).then(t=>t.Body));const it=v({name:"ContentNavigation",props:{query:{type:Object,required:!1,default:void 0}},async setup(t){const{query:a}=$(t),i=p(()=>{var n;return typeof((n=a.value)==null?void 0:n.params)=="function"?a.value.params():a.value});if(!i.value&&x("dd-navigation").value){const{navigation:n}=M();return{navigation:n}}const{data:_}=await w(`content-navigation-${N(i.value)}`,()=>B(i.value));return{navigation:_}},render(t){const a=F(),{navigation:i}=t,_=l=>s(C,{to:l._path},()=>l.title),n=(l,d)=>s("ul",d?{"data-level":d}:null,l.map(o=>o.children?s("li",null,[_(o),n(o.children,d+1)]):s("li",null,_(o)))),u=l=>n(l,0);return a!=null&&a.default?a.default({navigation:i,...this.$attrs}):u(i)}}),ut=Object.freeze(Object.defineProperty({__proto__:null,default:it},Symbol.toStringTag,{value:"Module"}));export{it as default};
