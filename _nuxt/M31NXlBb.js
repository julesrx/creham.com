import{_ as o}from"./MrV7coH1.js";import{d as m,m as i,K as h,Z as u,q as l,$ as d,o as g,c as f,g as r,a8 as p}from"./BOVntX_I.js";const b=m({__name:"ProseImg",props:{src:{type:String,default:""},alt:{type:String,default:""},width:{type:[String,Number],default:void 0},height:{type:[String,Number],default:void 0}},setup(e){const n=i().public.mdc.useNuxtImage?o:"img",t=e,c=h(()=>{var a;if((a=t.src)!=null&&a.startsWith("/")&&!t.src.startsWith("//")){const s=u(l(i().app.baseURL));if(s!=="/"&&!t.src.startsWith(s))return d(s,t.src)}return t.src});return(a,s)=>(g(),f(p(r(n)),{src:r(c),alt:e.alt,width:e.width,height:e.height},null,8,["src","alt","width","height"]))}});export{b as default};
