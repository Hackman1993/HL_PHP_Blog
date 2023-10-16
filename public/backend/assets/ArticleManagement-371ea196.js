import{u as K,r as f,A as D,D as I,e as g,h as C,j as n,m,f as w,x as U,E as V,q as x,B as A,c as u,a as W,C as R,d as N,t as B,F as S}from"./index-21df96f3.js";import{A as L,a as M,b as P,c as H,d as J,e as Q,f as X}from"./article-fbe54c2e.js";import{i as G,S as T,M as j,T as Y}from"./array-92a8b245.js";import{_ as Z}from"./TinymceEditor-82711a03.js";import{A as ee}from"./dictionary-1305017a.js";import{R as te,C as ae}from"./index-a9aa29ea.js";import{F as z,a as k,I as F,B as E}from"./index-dd0be179.js";import{_ as le}from"./_plugin-vue_export-helper-c27b6911.js";import"./request-a2427700.js";import"./_getTag-cb3a9032.js";import"./index-384f7243.js";import"./zoom-fa2480fe.js";import"./createContext-7f56f6d1.js";import"./Col-744c166f.js";import"./TextArea-070ff12e.js";import"./collapseMotion-551979cf.js";import"./LeftOutlined-5519a846.js";import"./index-5e00876c.js";import"./Compact-e6ea7b3c.js";import"./axios-05d0700c.js";import"./global-d6a70a19.js";const oe={__name:"DictionaryItemSelector",props:{value:{required:!0,type:Array,default:[]},dictKey:{required:!0,type:String},single:{type:Boolean,default:!1},buttonType:{type:Boolean,default:!0}},emits:["update:value","change"],setup(b,{emit:c}){const i=b,{t:d}=K(),r=f([]);let e=[];const a=D({value:i.value??[]}),s=_=>{let p=[];Array.isArray(a.value)?p=a.value:p=[a.value],minus(e,p),c("update:value",p),c("change")};let y=null;return I(()=>{i.dictKey!=y&&ee({dict_key:i.dictKey}).then(_=>{let p=[];_.data.items.forEach(v=>{v.label=v.translate?d(v.text):v.text,v.value=v.dict_item_id,v.onChange=s,p.push(v.value)}),e=p,r.value=_.data.items,y=i.dictKey}),i.single?a.value=Array.isArray(i.value)?i.value[0]:i.value:a.value=i.value}),(_,p)=>i.single?(g(),C(n(te),{key:0,value:a.value,"onUpdate:value":p[0]||(p[0]=v=>a.value=v),options:r.value,onChange:s,"option-type":i.buttonType?"button":"default"},null,8,["value","options","option-type"])):(g(),C(n(ae).Group,{key:1,value:a.value,"onUpdate:value":p[1]||(p[1]=v=>a.value=v),options:r.value,onChange:s},null,8,["value","options"]))}},ne={style:{width:"100%",display:"flex","column-gap":"10px","margin-top":"10px"}},O={__name:"DictionaryGroupFormItem",props:["value","options"],emits:["update:value","change"],setup(b,{emit:c}){const i=b,d=f(i.options??[]);f(i.value??[]);const r=f([]),e=()=>{c("update:value",[].concat(...r.value))};return I(()=>{d.value=i.options??[];let a=[];for(let s=0;s<d.value.length;s++)a[s]=G(d.value[s].items.map(y=>y.dict_item_id),i.value??[]);r.value=a}),(a,s)=>(g(),C(n(z).ItemRest,null,{default:m(()=>[(g(!0),w(U,null,V(d.value,(y,_)=>(g(),w("div",ne,[x("span",null,A(y.text)+" : ",1),u(oe,{"dict-key":y.dict_key,value:r.value[_],"onUpdate:value":p=>r.value[_]=p,onChange:e},null,8,["dict-key","value","onUpdate:value"])]))),256))]),_:1}))}};const ie={__name:"CategorySelector",props:["value","placeholder","except"],emits:["update:value","change"],setup(b,{emit:c}){const i=b,d=f([]),r=f(i.value);I(()=>{r.value=i.value}),L().then(a=>{a.data.forEach(s=>{s.value=s.art_category_id}),d.value=a.data});const e=a=>{c("update:value",a),c("change",a)};return(a,s)=>(g(),C(n(z).ItemRest,null,{default:m(()=>[u(n(T),{value:r.value,"onUpdate:value":s[0]||(s[0]=y=>r.value=y),options:d.value,"show-search":"",onChange:e},null,8,["value","options"]),u(O)]),_:1}))}},se=le(ie,[["__scopeId","data-v-a83c63ad"]]);const re={__name:"ArticleEditForm",props:["afterClose"],setup(b,{expose:c}){const i=b,{t:d}=K(),r=f({}),e=f({}),a=f(!1),s=f([]);c({show:(l={})=>{l.article_id?M({article_id:l.article_id}).then(t=>{var o,h;e.value=t.data,e.value.content=t.data.content_html,e.value.keywords=(h=(o=t.data)==null?void 0:o.keywords)==null?void 0:h.split(","),a.value=!0}):(a.value=!0,e.value=l)},close:()=>{a.value=!1}});const p=()=>{r.value.validate().then(()=>{Object.keys(e.value).forEach((l,t)=>{(e.value[l]===void 0||e.value[l]===null)&&delete e.value[l]}),Object.hasOwn(e.value,"article_id")?P(e.value).then((l,t)=>{a.value=!1,i.afterClose&&i.afterClose()}):H(e.value).then((l,t)=>{a.value=!1,i.afterClose&&i.afterClose()})})};I(()=>{e.value.fn_category_id?J({category_id:e.value.fn_category_id}).then(l=>{s.value=l.data.dictionaries}):s.value=[]});const v=W(()=>{var l;return(l=e.value)!=null&&l.article_id?d("article.update"):d("article.create")});return(l,t)=>(g(),C(n(j),{open:a.value,"onUpdate:open":t[9]||(t[9]=o=>a.value=o),title:v.value,modal:"",style:{width:"80vw"},onOk:p,"mask-closable":!1,keyboard:!1},{default:m(()=>[u(n(z),{model:e.value,layout:"vertical",ref_key:"form",ref:r},{default:m(()=>[u(n(k),{name:"username",hidden:!0},{default:m(()=>[u(n(F),{value:e.value.article_id,"onUpdate:value":t[0]||(t[0]=o=>e.value.article_id=o)},null,8,["value"])]),_:1}),u(n(k),{label:n(d)("article.title"),name:"title",rules:[{required:!0,message:"Please input your username!"}]},{default:m(()=>[u(n(F),{value:e.value.title,"onUpdate:value":t[1]||(t[1]=o=>e.value.title=o)},null,8,["value"])]),_:1},8,["label"]),u(n(k),{label:n(d)("article.category"),name:"fn_category_id"},{default:m(()=>[u(se,{value:e.value.fn_category_id,"onUpdate:value":t[2]||(t[2]=o=>e.value.fn_category_id=o)},null,8,["value"])]),_:1},8,["label"]),s.value.length>0?(g(),C(n(k),{key:0,label:n(d)("article.dict_data")},{default:m(()=>[u(O,{value:e.value.dict_item_ids,"onUpdate:value":t[3]||(t[3]=o=>e.value.dict_item_ids=o),options:s.value,onChange:t[4]||(t[4]=o=>console.log(e.value))},null,8,["value","options"])]),_:1},8,["label"])):R("",!0),u(n(k),{label:n(d)("article.keywords"),name:"keywords"},{default:m(()=>[u(n(T),{value:e.value.keywords,"onUpdate:value":t[5]||(t[5]=o=>e.value.keywords=o),"token-separators":[","," "],mode:"tags"},null,8,["value"])]),_:1},8,["label"]),u(n(k),{label:n(d)("article.content"),name:"content"},{default:m(()=>[u(Z,{abstract:e.value.abstract,"onUpdate:abstract":t[6]||(t[6]=o=>e.value.abstract=o),value:e.value.content,"onUpdate:value":t[7]||(t[7]=o=>e.value.content=o),attachments:e.value.attachments,"onUpdate:attachments":t[8]||(t[8]=o=>e.value.attachments=o)},null,8,["abstract","value","attachments"])]),_:1},8,["label"])]),_:1},8,["model"])]),_:1},8,["open","title"]))}},ue={style:{display:"flex"}},ce={style:{"flex-grow":"1",display:"flex","align-items":"center"}},de={style:{"font-size":"20px","font-weight":"bold"}},pe={key:0},Fe=N({__name:"ArticleManagement",setup(b){const{t:c}=K(),i=f(),d=f([{title:c("article.title"),dataIndex:"title",ellipsis:!0,resizable:!0,minWidth:100,width:200},{title:c("article.keywords"),dataIndex:"keywords",ellipsis:!0,resizable:!0,width:150,minWidth:150},{title:c("article.category"),dataIndex:"category",ellipsis:!0,resizable:!0,width:150,minWidth:150},{title:c("article.abstract"),dataIndex:"abstract",ellipsis:!0,resizable:!0,width:300,minWidth:150},{title:c("common.action"),dataIndex:"action",width:100,minWidth:100}]),r=f({hideOnSinglePage:!0,current:1,total:1,pageSize:10,position:["bottomCenter"]}),e=f([]),a=D({selectedRowKeys:[],loading:!1}),s=()=>{Q({page:r.value.current,limit:r.value.pageSize}).then(l=>{var t;if(r.value.total=l.data.total,r.value.current=l.data.current_page,Array.isArray((t=l==null?void 0:l.data)==null?void 0:t.data)){let o=[];l.data.data.forEach(h=>{h.key=h.article_id,o.push(h.key)}),a.selectedRowKeys=G(a.selectedRowKeys,o),e.value=l.data.data}})};s();const y=l=>{r.value.current=l.current,r.value.pageSize=l.pageSize,s()},_=l=>{j.confirm({title:c("common.delete_confirm"),content:c("article.delete_branch_confirmation",{count:l.length}),okText:c("common.confirm"),cancelText:c("common.cancel"),onOk(){X({article_ids:l}).then(()=>{s()})}})};function p(l,t){t.width=l}const v=l=>{a.selectedRowKeys=l};return(l,t)=>(g(),w(U,null,[u(n(Y),{columns:d.value,"data-source":e.value,pagination:r.value,"row-selection":{selectedRowKeys:a.selectedRowKeys,onChange:v},onChange:y,onResizeColumn:p},{title:m(()=>[x("div",ue,[x("div",ce,[x("div",de,A(n(c)("article.management")),1)]),u(n(E),{type:"primary",onClick:t[0]||(t[0]=o=>i.value.show())},{default:m(()=>[B(A(n(c)("article.create")),1)]),_:1})])]),footer:m(()=>[u(n(E),{type:"primary",danger:"",onClick:t[1]||(t[1]=o=>_(a.selectedRowKeys)),disabled:a.selectedRowKeys.length===0},{default:m(()=>[u(n(S),{icon:"fa-solid fa-trash"})]),_:1},8,["disabled"])]),bodyCell:m(o=>{var h,$;return[o.column.dataIndex==="action"?(g(),w("div",pe,[u(n(S),{class:"action-icon",icon:"fa-solid fa-pen-to-square",style:{color:"darkgreen"},onClick:q=>i.value.show(o.record)},null,8,["onClick"]),u(n(S),{class:"action-icon",icon:"fa-solid fa-trash",style:{color:"red"},onClick:q=>_([o.record.article_id])},null,8,["onClick"])])):R("",!0),o.column.dataIndex==="category"?(g(),w(U,{key:1},[B(A(($=(h=o.record)==null?void 0:h.category)==null?void 0:$.label),1)],64)):R("",!0)]}),_:1},8,["columns","data-source","pagination","row-selection"]),u(re,{ref_key:"dialog",ref:i,"after-close":s},null,512)],64))}});export{Fe as default};