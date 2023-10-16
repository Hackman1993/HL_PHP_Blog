import{u as q,r as p,a as j,e as C,h as A,m as u,c as r,j as a,A as B,f as z,x as K,q as k,B as I,t as F,F as x,C as S}from"./index-21df96f3.js";import{M as T,i as O,T as P}from"./array-92a8b245.js";import{r as y}from"./request-a2427700.js";import{F as $,a as f,I as v,B as R}from"./index-dd0be179.js";import{_ as W}from"./_plugin-vue_export-helper-c27b6911.js";import"./_getTag-cb3a9032.js";import"./index-384f7243.js";import"./zoom-fa2480fe.js";import"./createContext-7f56f6d1.js";import"./Col-744c166f.js";import"./TextArea-070ff12e.js";import"./collapseMotion-551979cf.js";import"./LeftOutlined-5519a846.js";import"./index-5e00876c.js";import"./index-a9aa29ea.js";import"./Compact-e6ea7b3c.js";import"./axios-05d0700c.js";import"./global-d6a70a19.js";const E=d=>y("/user","get",d),N=d=>y("/user/create","post",d),V=d=>y(`/user/update/${d.user_id}`,"put",d),D=d=>y("/user/delete","delete",d),M={__name:"UserEditForm",props:["afterClose"],setup(d,{expose:n}){const m=d,{t:o}=q(),c=p({}),t=p({}),i=p(!1);n({show:(e={})=>{i.value=!0,t.value=e},close:()=>{i.value=!1}});const g=async(e,s)=>s===""?Promise.reject(o("user.password_confirmation_required")):s!==t.value.password?Promise.reject(o("user.password_not_match")):Promise.resolve(),b=()=>{c.value.validate().then(()=>{Object.keys(t.value).forEach((e,s)=>{(t.value[e]===void 0||t.value[e]===null||t.value[e]==="")&&delete t.value[e]}),Object.hasOwn(t.value,"user_id")?V(t.value).then((e,s)=>{i.value=!1,m.afterClose&&m.afterClose()}):N(t.value).then((e,s)=>{i.value=!1,m.afterClose&&m.afterClose()})})},h=j(()=>{var e;return(e=t.value)!=null&&e.user_id?o("user.update"):o("user.create")});return(e,s)=>(C(),A(a(T),{open:i.value,"onUpdate:open":s[6]||(s[6]=l=>i.value=l),title:h.value,modal:"",style:{width:"80vw"},okText:a(o)("common.confirm"),cancelText:a(o)("common.cancel"),onOk:b,"mask-closable":!1,afterClose:null,keyboard:!1},{default:u(()=>[r(a($),{model:t.value,layout:"vertical",ref_key:"form",ref:c},{default:u(()=>[r(a(f),{name:"user_id",hidden:!0},{default:u(()=>[r(a(v),{value:t.value.user_id,"onUpdate:value":s[0]||(s[0]=l=>t.value.user_id=l)},null,8,["value"])]),_:1}),r(a(f),{label:a(o)("user.username"),name:"username",rules:[{required:!0,message:a(o)("user.username_required")}]},{default:u(()=>[r(a(v),{value:t.value.username,"onUpdate:value":s[1]||(s[1]=l=>t.value.username=l),disabled:!!t.value.user_id},null,8,["value","disabled"])]),_:1},8,["label","rules"]),r(a(f),{label:a(o)("user.password"),name:"password","has-feedback":"",rules:[{required:!t.value.user_id,message:a(o)("user.password_required"),trigger:"change"}]},{default:u(()=>[r(a(v).Password,{value:t.value.password,"onUpdate:value":s[2]||(s[2]=l=>t.value.password=l)},null,8,["value"])]),_:1},8,["label","rules"]),r(a(f),{label:a(o)("user.password_confirmation"),name:"password_confirmation","has-feedback":"",rules:[{required:!t.value.user_id,validator:g,trigger:"change"}]},{default:u(()=>[r(a(v).Password,{value:t.value.password_confirmation,"onUpdate:value":s[3]||(s[3]=l=>t.value.password_confirmation=l)},null,8,["value"])]),_:1},8,["label","rules"]),r(a(f),{label:a(o)("user.nickname"),name:"nickname"},{default:u(()=>[r(a(v),{value:t.value.nickname,"onUpdate:value":s[4]||(s[4]=l=>t.value.nickname=l)},null,8,["value"])]),_:1},8,["label"]),r(a(f),{label:a(o)("user.email"),name:"email",rules:[{type:"email",message:a(o)("user.email_invalid")}]},{default:u(()=>[r(a(v),{value:t.value.email,"onUpdate:value":s[5]||(s[5]=l=>t.value.email=l)},null,8,["value"])]),_:1},8,["label","rules"])]),_:1},8,["model"])]),_:1},8,["open","title","okText","cancelText"]))}};const G={style:{display:"flex"}},H={style:{"flex-grow":"1",display:"flex","align-items":"center"}},L={style:{"font-size":"20px","font-weight":"bold"}},J={key:0},Q={__name:"user",setup(d){const{t:n}=q(),m=p(),o=p([{title:n("user.id"),dataIndex:"user_id",ellipsis:!0,resizable:!0,width:150,minWidth:150},{title:n("user.username"),dataIndex:"username",ellipsis:!0,resizable:!0,width:150,minWidth:150},{title:n("user.email"),dataIndex:"email",ellipsis:!0,resizable:!0,width:150,minWidth:150},{title:n("user.nickname"),dataIndex:"nickname",ellipsis:!0,resizable:!0,width:150,minWidth:150},{title:n("common.action"),dataIndex:"action",ellipsis:!0,resizable:!0,width:150,minWidth:150}]),c=p({hideOnSinglePage:!0,current:1,total:1,pageSize:10,position:["bottomCenter"]}),t=p([]),i=B({selectedRowKeys:[],loading:!1}),_=()=>{E({page:c.value.current,limit:c.value.pageSize}).then(e=>{var s;if(c.value.total=e.data.total,c.value.current=e.data.current_page,Array.isArray((s=e==null?void 0:e.data)==null?void 0:s.data)){let l=[];e.data.data.forEach(w=>{w.key=w.user_id,l.push(w.key)}),i.selectedRowKeys=O(i.selectedRowKeys,l),t.value=e.data.data}})};_();const U=e=>{c.value.current=e.current,c.value.pageSize=e.pageSize,_()},g=e=>{T.confirm({title:n("common.delete_confirm"),content:n("user.delete_branch_confirmation",{count:e.length}),okText:n("common.confirm"),cancelText:n("common.cancel"),onOk(){D({user_ids:e}).then(()=>{_()})}})};function b(e,s){s.width=e}const h=e=>{i.selectedRowKeys=e};return(e,s)=>(C(),z(K,null,[r(a(P),{columns:o.value,"data-source":t.value,pagination:c.value,"row-selection":{selectedRowKeys:i.selectedRowKeys,onChange:h},onChange:U,onResizeColumn:b},{title:u(()=>[k("div",G,[k("div",H,[k("div",L,I(a(n)("user.management")),1)]),r(a(R),{type:"primary",onClick:s[0]||(s[0]=l=>m.value.show())},{default:u(()=>[F(I(a(n)("user.create")),1)]),_:1})])]),footer:u(()=>[r(a(R),{type:"primary",danger:"",onClick:s[1]||(s[1]=l=>g(i.selectedRowKeys)),disabled:i.selectedRowKeys.length===0},{default:u(()=>[r(a(x),{icon:"fa-solid fa-trash"})]),_:1},8,["disabled"])]),bodyCell:u(l=>[l.column.dataIndex==="action"?(C(),z("div",J,[r(a(x),{class:"action-icon",icon:"fa-solid fa-pen-to-square",style:{color:"darkgreen"},onClick:w=>m.value.show(l.record)},null,8,["onClick"]),r(a(x),{class:"action-icon",icon:"fa-solid fa-trash",style:{color:"red"},onClick:w=>g([l.record.user_id])},null,8,["onClick"])])):S("",!0)]),_:1},8,["columns","data-source","pagination","row-selection"]),r(M,{ref_key:"dialog",ref:m,"after-close":_},null,512)],64))}},ve=W(Q,[["__scopeId","data-v-d7a7eea0"]]);export{ve as default};