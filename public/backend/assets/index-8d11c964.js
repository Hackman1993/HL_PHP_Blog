import{u as k,c as L,_ as v,l as M,a as O,P as G,t as I,d as W}from"./_getTag-85b9c924.js";import{u as q}from"./Col-f6a62d01.js";import{u as H,C as x}from"./Compact-d4023c59.js";import{d as J,a as i,r as j,w as K,c as p,x as Q}from"./index-b3aac28e.js";const U={small:8,middle:16,large:24},X=()=>({prefixCls:String,size:{type:[String,Number,Array]},direction:G.oneOf(I("horizontal","vertical")).def("horizontal"),align:G.oneOf(I("start","end","center","baseline")),wrap:W()});function Y(e){return typeof e=="string"?U[e]:e||0}const s=J({compatConfig:{MODE:3},name:"ASpace",inheritAttrs:!1,props:X(),slots:Object,setup(e,B){let{slots:r,attrs:d}=B;const{prefixCls:l,space:f,direction:$}=k("space",e),[F,P]=H(l),z=q(),n=i(()=>{var t,a,o;return(o=(t=e.size)!==null&&t!==void 0?t:(a=f==null?void 0:f.value)===null||a===void 0?void 0:a.size)!==null&&o!==void 0?o:"small"}),g=j(),c=j();K(n,()=>{[g.value,c.value]=(Array.isArray(n.value)?n.value:[n.value,n.value]).map(t=>Y(t))},{immediate:!0});const h=i(()=>e.align===void 0&&e.direction==="horizontal"?"center":e.align),D=i(()=>L(l.value,P.value,`${l.value}-${e.direction}`,{[`${l.value}-rtl`]:$.value==="rtl",[`${l.value}-align-${h.value}`]:h.value})),E=i(()=>$.value==="rtl"?"marginLeft":"marginRight"),R=i(()=>{const t={};return z.value&&(t.columnGap=`${g.value}px`,t.rowGap=`${c.value}px`),v(v({},t),e.wrap&&{flexWrap:"wrap",marginBottom:`${-c.value}px`})});return()=>{var t,a;const{wrap:o,direction:T="horizontal"}=e,C=(t=r.default)===null||t===void 0?void 0:t.call(r),b=M(C),w=b.length;if(w===0)return null;const u=(a=r.split)===null||a===void 0?void 0:a.call(r),_=`${l.value}-item`,A=g.value,S=w-1;return p("div",O(O({},d),{},{class:[D.value,d.class],style:[R.value,d.style]}),[b.map((N,y)=>{const V=C.indexOf(N);let m={};return z.value||(T==="vertical"?y<S&&(m={marginBottom:`${A/(u?2:1)}px`}):m=v(v({},y<S&&{[E.value]:`${A/(u?2:1)}px`}),o&&{paddingBottom:`${c.value}px`})),F(p(Q,{key:V},[p("div",{class:_,style:m},[N]),y<S&&u&&p("span",{class:`${_}-split`,style:m},[u])]))})])}}});s.Compact=x;s.install=function(e){return e.component(s.name,s),e.component(x.name,x),e};const le=s;export{le as S};
