import{_ as i}from"./MrV7coH1.js";import{o as r,a as _,b as n,e as o,i as c,_ as l,M as p,z as m}from"./BOVntX_I.js";import{_ as u}from"./DlAUqK2U.js";const d={},f={class:"link-nav"};function x(e,t){const s=i,a=l;return r(),_("span",f,[n(a,{to:"/contact",title:"Contactez-nous"},{default:o(()=>[n(s,{src:"/img/icons/contact.png",alt:"Contact",class:"icon"}),t[0]||(t[0]=c(" Contact "))]),_:1}),n(a,{to:"/acces",title:"Accès"},{default:o(()=>[n(s,{src:"/img/icons/acces.png",alt:"Accès",class:"icon"}),t[1]||(t[1]=c(" Accès "))]),_:1}),n(a,{to:"/espace-de-travail",title:"Espace de travail"},{default:o(()=>[n(s,{src:"/img/icons/espace.png",alt:"Espace",class:"icon"}),t[2]||(t[2]=c(" Espace de travail "))]),_:1})])}const C=u(d,[["render",x]]),N=async()=>{const{data:e}=await p("nav-links",()=>m("/").where({navigation:!0}).sort({order:1}).only(["_path","title"]).find());return e};export{C as _,N as u};