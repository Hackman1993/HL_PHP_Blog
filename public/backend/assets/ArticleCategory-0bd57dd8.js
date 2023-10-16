import{d as E,r as y,E as F,e as v,h as b,m as u,c as n,j as t,f as k,x as T,H as B,F as w,z,u as j,a as V,v as D,q as A,y as I,t as N}from"./index-1a1a41e3.js";import{S as q,M as K,i as L,T as P}from"./array-afb2febe.js";import{g as W,h as H,i as M,j as G}from"./article-b6154b7d.js";import{a as J}from"./dictionary-77303096.js";import{C as Q,R as X,B as x,F as O,a as R,I as S}from"./request-3404f2b5.js";import{w as U}from"./global-cdbf2ca7.js";import{S as Y}from"./StopOutlined-40b24d55.js";import{_ as Z}from"./_plugin-vue_export-helper-c27b6911.js";import"./LeftOutlined-93c8ff1b.js";const $=U(Q),ee=U(X),te=E({__name:"DictionarySelector",props:{limit:{default:1,type:Number},value:{default:[],type:Array},ids:{default:[],type:Array}},emits:["update:value","update:ids"],setup(h,{emit:d}){const p=h,m=y([]),l=y([]),a=()=>{d("update:ids",l.value)};F(()=>{let c=[];Array.isArray(p.value)&&p.value.forEach(s=>{s&&s.hasOwnProperty("dictionary_id")&&c.push(s.dictionary_id)}),l.value=c}),J().then(c=>{c.data.forEach(s=>{s.key=s.dictionary_id,s.label=s.text,s.value=s.dictionary_id}),m.value=c.data});const r=c=>{l.value=l.value.filter((s,_)=>c!==_),a()};return(c,s)=>(v(),b(t(O).ItemRest,null,{default:u(()=>[n(t(ee),{style:{width:"100%",gap:"10px"}},{default:u(()=>[(v(!0),k(T,null,B(l.value,(_,g)=>(v(),b(t($),{span:24,style:{display:"flex","align-items":"center","column-gap":"10px"}},{default:u(()=>[n(t(q),{options:m.value,value:l.value[g],"onUpdate:value":i=>l.value[g]=i,style:{flex:"1"},onChange:a},null,8,["options","value","onUpdate:value"]),n(t(x),{type:"primary",style:{display:"flex","justify-content":"center","align-items":"center"},danger:"",shape:"circle",size:"small",icon:c.h(t(Y)),onClick:i=>r(g)},null,8,["icon","onClick"])]),_:2},1024))),256)),l.value.length<h.limit?(v(),b(t($),{key:0,span:24},{default:u(()=>[n(t(x),{onClick:s[0]||(s[0]=_=>l.value.push(null)),style:{width:"100%"}},{default:u(()=>[n(t(w),{icon:"fa-solid fa-add"})]),_:1})]),_:1})):z("",!0)]),_:1})]),_:1}))}}),ae={__name:"ArticleCategoryForm",props:["afterClose"],setup(h,{expose:d}){const p=h,{t:m}=j(),l=y({}),a=y({}),r=y(!1);d({show:(i={})=>{var e;r.value=!0,a.value=i,(e=l.value)!=null&&e.clearValidate&&l.value.clearValidate()},close:()=>{r.value=!1}});const _=()=>{l.value.validate().then(()=>{Object.keys(a.value).forEach((i,e)=>{(a.value[i]===void 0||a.value[i]===null||a.value[i]==="")&&delete a.value[i]}),Object.hasOwn(a.value,"art_category_id")?H(a.value).then((i,e)=>{r.value=!1,p.afterClose&&p.afterClose()}):W(a.value).then((i,e)=>{r.value=!1,p.afterClose&&p.afterClose()})})},g=V(()=>{var i;return(i=a.value)!=null&&i.art_category_id?m("art_category.update"):m("art_category.create")});return(i,e)=>(v(),b(t(K),{open:r.value,"onUpdate:open":e[4]||(e[4]=o=>r.value=o),title:g.value,modal:"",style:{width:"80vw"},okText:t(m)("common.confirm"),cancelText:t(m)("common.cancel"),onOk:_,"mask-closable":!1,afterClose:null,keyboard:!1},{default:u(()=>[n(t(O),{model:a.value,layout:"vertical",ref_key:"form",ref:l},{default:u(()=>[n(t(R),{name:"art_category_id",hidden:!0},{default:u(()=>[n(t(S),{value:a.value.art_category_id,"onUpdate:value":e[0]||(e[0]=o=>a.value.art_category_id=o)},null,8,["value"])]),_:1}),n(t(R),{name:"label",label:t(m)("art_category.name"),rules:[{required:!0,message:t(m)("art_category.name_required")}]},{default:u(()=>[n(t(S),{value:a.value.label,"onUpdate:value":e[1]||(e[1]=o=>a.value.label=o)},null,8,["value"])]),_:1},8,["label","rules"]),n(t(R),{name:"dictionaries",label:t(m)("art_category.dictionary")},{default:u(()=>[n(te,{value:a.value.dictionaries,"onUpdate:value":e[2]||(e[2]=o=>a.value.dictionaries=o),ids:a.value.dict_ids,"onUpdate:ids":e[3]||(e[3]=o=>a.value.dict_ids=o),limit:10},null,8,["value","ids"])]),_:1},8,["label"])]),_:1},8,["model"])]),_:1},8,["open","title","okText","cancelText"]))}};const le={style:{display:"flex"}},oe={style:{"flex-grow":"1",display:"flex","align-items":"center"}},ne={style:{"font-size":"20px","font-weight":"bold"}},se={key:0},ie={key:1},re={__name:"ArticleCategory",setup(h){const{t:d}=j(),p=y(),m=y([{title:d("art_category.name"),dataIndex:"label",ellipsis:!0,resizable:!0,width:300,minWidth:150},{title:d("art_category.article_count"),dataIndex:"article_count",ellipsis:!0,resizable:!0,width:300,minWidth:150},{title:d("common.action"),dataIndex:"action",ellipsis:!0,resizable:!0,width:100,minWidth:100}]),l=y({hideOnSinglePage:!0,current:1,total:1,pageSize:10,position:["bottomCenter"]}),a=y([]),r=D({selectedRowKeys:[],loading:!1}),c=()=>{M({page:l.value.current,limit:l.value.pageSize}).then(e=>{var o;if(l.value.total=e.data.total,l.value.current=e.data.current_page,Array.isArray((o=e==null?void 0:e.data)==null?void 0:o.data)){let f=[];e.data.data.forEach(C=>{C.key=C.art_category_id,f.push(C.key)}),r.selectedRowKeys=L(r.selectedRowKeys,f),a.value=e.data.data}})};c();const s=e=>{l.value.current=e.current,l.value.pageSize=e.pageSize,c()},_=e=>{K.confirm({title:d("common.delete_confirm"),content:d("art_category.delete_branch_confirmation",{count:e.length}),okText:d("common.confirm"),cancelText:d("common.cancel"),onOk(){G({ids:e}).then(()=>{c()})}})};function g(e,o){o.width=e}const i=e=>{r.selectedRowKeys=e};return(e,o)=>(v(),k(T,null,[n(t(P),{columns:m.value,"data-source":a.value,pagination:l.value,"row-selection":{selectedRowKeys:r.selectedRowKeys,onChange:i},onChange:s,onResizeColumn:g},{title:u(()=>[A("div",le,[A("div",oe,[A("div",ne,I(t(d)("art_category.management")),1)]),n(t(x),{type:"primary",onClick:o[0]||(o[0]=f=>p.value.show())},{default:u(()=>[N(I(t(d)("art_category.create")),1)]),_:1})])]),footer:u(()=>[n(t(x),{type:"primary",danger:"",onClick:o[1]||(o[1]=f=>_(r.selectedRowKeys)),disabled:r.selectedRowKeys.length===0},{default:u(()=>[n(t(w),{icon:"fa-solid fa-trash"})]),_:1},8,["disabled"])]),bodyCell:u(f=>[f.column.dataIndex==="article_count"?(v(),k("span",se,I(f.record.articles_count),1)):z("",!0),f.column.dataIndex==="action"?(v(),k("div",ie,[n(t(w),{class:"action-icon",icon:"fa-solid fa-pen-to-square",style:{color:"darkgreen"},onClick:C=>p.value.show(f.record)},null,8,["onClick"]),n(t(w),{class:"action-icon",icon:"fa-solid fa-trash",style:{color:"red"},onClick:C=>_([f.record.art_category_id])},null,8,["onClick"])])):z("",!0)]),_:1},8,["columns","data-source","pagination","row-selection"]),n(ae,{ref_key:"dialog",ref:p,"after-close":c},null,512)],64))}},ge=Z(re,[["__scopeId","data-v-3db962be"]]);export{ge as default};
