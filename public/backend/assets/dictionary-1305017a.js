import{r as i}from"./request-a2427700.js";const e=t=>i("/dictionary/create","post",t),a=t=>i(`/dictionary/update/${t.dictionary_id}`,"post",t),n=t=>i("/dictionary/delete","delete",t),o=t=>i("/dictionary","get",t),c=t=>i("/dictionary/by_key","get",t),s=t=>i("/dictionary/all_parent","get",t);export{c as A,s as a,e as b,a as c,o as d,n as e};